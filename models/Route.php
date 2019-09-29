<?php 

class Route{
	
	public static function linksPagesModel ( $link ){


		if( $link == "chat"){
			$module =  "views/".$link.".php";	
        }
        
		else{
			$module =  "views/login.php";
		}
		
		return $module;

	}

}