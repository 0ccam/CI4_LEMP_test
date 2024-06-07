<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InitDB extends Migration
{
    public function up()
    {
		//SharedDate::PHPToExcel

		/* Создание таблиц */
		$this->db->query('
			CREATE TABLE IF NOT EXISTS smp (
				id INT PRIMARY KEY AUTO_INCREMENT,
				title VARCHAR(100) UNIQUE
			);
		');

		$this->db->query('
			CREATE TABLE IF NOT EXISTS inspector (
				id INT PRIMARY KEY AUTO_INCREMENT,
				title VARCHAR(100) UNIQUE
			);
		');

		$this->db->query('
			CREATE TABLE IF NOT EXISTS revise (
				id INT PRIMARY KEY AUTO_INCREMENT,
				smp_id INT,
				inspector_id INT,
				duration INT,
				revise_start Date,
				revise_stop Date,
				FOREIGN KEY (smp_id) REFERENCES smp (id),
				FOREIGN KEY (inspector_id) REFERENCES inspector (id)
			);
		');
    }

    public function down()
    {
		/* Удаление таблиц */
		$this->db->query('
			DROP TABLE IF EXISTS smp, inspector, revise;
		');
    }
}