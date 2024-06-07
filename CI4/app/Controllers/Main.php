<?php

namespace App\Controllers;

class Main extends BaseController
{
    public function index(): string
    {
	$html = '<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/style.css">';
	$html .= view('site/header');
	$html .= view('site/topnav');
	$html .= view('site/search_form');
	//$html .= view('site/row', ['title_heading' => 'Титульный заголовок', 'title_description' => 'Титульное описание', 'text' => 'Текстовая строка...']);
	$html .= view('site/footer');
        return $html;
    }
}
