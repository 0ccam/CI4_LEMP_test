<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FillingDB extends Migration
{
    public function up()
    {
		/* Создание таблиц */
		$this->db->query("
			INSERT smp (`title`) 
			VALUES
			('ООО Колосок'),
			('ООО Васильев и Ко');
		");

		$this->db->query("
			INSERT inspector (`title`) 
			VALUES
			('Налоговая'),
			('Природнадзор'),
			('Роспотребнадзор');
		");

		$this->db->query("
			INSERT revise
			(
				`smp_id`,
				`inspector_id`,
				`duration`,
				`revise_start`,
				`revise_stop`
			) 
			VALUES
			(
				(SELECT id FROM smp WHERE title='ООО Колосок'),
				(SELECT id FROM inspector WHERE title='Роспотребнадзор'),
				4,
				'2009-12-20',
				'2009-12-31'
			),
			(
				(SELECT id FROM smp WHERE title='ООО Колосок'),
				(SELECT id FROM inspector WHERE title='Налоговая'),
				5,
				'2010-03-01',
				'2009-04-01'
			),
			(
				(SELECT id FROM smp WHERE title='ООО Колосок'),
				(SELECT id FROM inspector WHERE title='Природнадзор'),
				3,
				'2009-03-02',
				'2010-02-02'
			),
			(
				(SELECT id FROM smp WHERE title='ООО Васильев и Ко'),
				(SELECT id FROM inspector WHERE title='Роспотребнадзор'),
				2,
				'2009-03-02',
				'2010-06-02'
			);
		");
    }

    public function down()
    {
		/* Удаление таблиц */
		$this->db->query('
			DROP TABLE IF EXISTS smp, inspector, revise;
		');
    }
}