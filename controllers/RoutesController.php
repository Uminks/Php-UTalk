<?php

//require_once "models/Route.php";
require_once "models/Route.php";

class RouteController {

    #ENLACES
	#-------------------------------------
	public function linkPagesController(){

		if(isset( $_GET['action'])){		
			$link = $_GET['action'];	
		}

		else{
			$link = "login";
		}

		$response = Route::linksPagesModel($link);
			/*Esto es igual a:
				$respuesta = new Paginas();
				include $respuesta->enlacesPaginasModel($enlace);*/
		include $response;
	}

}