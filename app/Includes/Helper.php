<?php
	namespace App\Includes;
	use Route;
	
	class Helper{

		static function is_active($route){
			$route_name = Route::currentRouteName();

			if(is_array($route)){
					foreach ($route as $key => $single_route) {
						if(strpos($route_name, $single_route) === 0){
							return 'active';
						}
					}
					
			}else{
					return (strpos($route_name, $route) === 0) ? 'active' : '';
			}
		}
	}
	
?>