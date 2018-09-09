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


		$this->templateEngine->addFilter(new \Twig_SimpleFilter('tiempo', function($datetime){
			$time = time() - 	$datetime; 
			$timeAgo = '';
		  $units = [
		    '31536000' => ['Año', 'Años'],
		    '2592000' => ['Mes', 'Meses'],
		    '86400' => ['Día', 'Días'],
		  ];
		  foreach ($units as $unit => $val) {
		    if ($time > $unit){
		    	$res = floor($time / $unit);
		    	$time = $time-($res * $unit);
		    	if($res > 1){
		    		$timeAgo = $timeAgo.$res.' '.$units[$unit][1].' ';
		    	}else{
		    		$timeAgo = $timeAgo.$res.' '.$units[$unit][0].' ';
		    	}
		    }
		  }
		  return $timeAgo;
		}));
	}

	


	public function render($fileName, $data = [])
	{
			return $this->templateEngine->render($fileName,$data);
	}

}


?>