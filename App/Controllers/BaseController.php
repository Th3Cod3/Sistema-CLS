<?php 

namespace App\Controllers;


class BaseController {

	protected $templateEngine;

	public function __construct()
	{
		$loader = new \Twig_Loader_Filesystem('views');
		$this->templateEngine = new \Twig_Environment($loader,[
			'debug' => true, 
			'cache' => false
		]);
$this->templateEngine->addExtension(new \Twig_Extension_Debug());


		$this->templateEngine->addFilter(new \Twig_SimpleFilter('url', function($path){
				return BASE_URL.$path;
		}));

		$this->templateEngine->addFilter(new \Twig_SimpleFilter('html', function($text){
				return html_entity_decode($text);
		}));

		$this->templateEngine->addFilter(new \Twig_SimpleFilter('bbcode', function($text){
			$bbcode = new \ChrisKonnertz\BBCode\BBCode();
			$bbcode->ignoreTag('size');
			return html_entity_decode($bbcode->render($text));
		}));
	}

	public function render($fileName, $data = [])
	{
			return $this->templateEngine->render($fileName,$data);
	}

}


?>