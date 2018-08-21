<?php
	namespace App\Includes;
	
	/** PK-Tool for PHP
	 * @file: pktool-v1.0.php
	 * @version: 1.5
	 * @author: Bryan Philip Buenavides, Moira Kelly Del Mundo, Gaberielle Espino, 
	 *			Marc Joseph Fuellas, Bryan James Ilaga.
	 * @license: GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007
	 * @copyright: 2016 - 2017 (c) All Rights Reserved
	*/
	
	/** How to use:
	 * There are two ways you can use smart counter.
	 * (1) Using SmartCounter class
	 * 		Benefits: You can save and store the data on a local intance.
	 *					Changeable local data.
	 * 					Automatically Cleaning Data.
	 *		Sample Code:
	 *			$smart_counter = new SmartCounter("2015-25486-MN-0");
	 *			echo $smart_counter -> smart_next( SmartMove::$NUMBER, SmartSave::$NO_SAVE ) . "<br>"; 
	 *			// The above statement will print out: 2015-25486-MN-1
	 *		
	 *		You can choose which factor to increment:
	 *			SmartMove::$NUMBER -> increments number (default setting)
	 *			SmartMove::$LETTER -> increments letter
	 *			SmartMove::$SMART -> Smartly increments the string
	 *		
	 *		If you want to save the incremented value to the local instance you may want to use:
	 *			SmartSave::$SAVE
	 *		Or use:
	 *			SmartSave::$NO_SAVE (default)
	 *		to discard changes.
	 *		
	 *		If you really want to use Smart Counter that quick using the Object method, you can go on
	 *		and call '$smart_counter -> smart_next( )' without any paramenters. By default it will 
	 *		increment the smart last number and WILL NOT save changes to the local instance.
	 *	
	 *	(2) Using StaticCounter class
	 *		Benefits: Faster calling of static functions.
	 *		
	 *		Sample Code:
	 *			StaticCounter::smart_next( "2015-25486-MN-0", SmartMove::$NUMBER );
	 *		
	 *		Again, if you really want to use Static Counter, you go and just pass the data that you need 
	 *		to increment 'StaticCounter::smart_next( "2015-25486-MN-0" )'. By default it will increment 
	 *		the smart last number.
	*/
	
	/** Class for Smart Movements
	 *		$NUMBER -> Shifts Number (Default)
	 * 		$LETTER -> Shifts Letter
	 * 		$SMART -> Shifts Smart Method
	*/
	class SmartMove {
		public static $NUMBER = 1;
		public static $LETTER = 2;
		public static $SMART = 3;
	}
	
	/** Class for Smart Save
	 * 		$NO_SAVE -> Do not save resulting data (default)
	 * 		$SAVE -> Saves the resulting data
	*/
	class SmartSave {
		public static $NO_SAVE = false;
		public static $SAVE = true;
	}
	
	/** Class for the Smart Counter
	 *		Contains data processing and functions for creating a smart counter
	*/
	class SmartCounter {
		/* Class Variables */
		private $data_proc;
		
		/* Class Constructor */
		function __construct( $init_data ) {
		   $this -> data_proc = strip_tags( $init_data );
		} // constructor( $initial_data )
		
		/* Clean Up Tags */
		function clean_data( ) {
			$this -> data_proc = strip_tags( $this -> data_proc );
			return ( $this -> get_data() );
		} // function clean_data( $data )
		
		/* Sets the data to be processed */
		function set_data( $set_value ) {
			$this -> data_proc = strip_tags( $set_value );
		} // function set_data( $set_value )
		
		/* Gets the processed or unprocessed data */
		function get_data( ) {
			return ( $this -> data_proc );
		} // function get_data( )
		
		/* Gets the next smart move from the raw data */
		/* Parameter Values:  
		 * 		$this -> number = Smart increase the next number
		 * 		$this -> letter = Smart increase the next letter
		 * 		$this -> smart = Smart increase the string
		*/
		function smart_next( $move = 1, $save_type = false ) {
			/* Variable Declarations */
			$original = $this -> data_proc;
			$chop = array( );
			$int_index = array();
			$char_index = array();
			$last_type = "";
			$builder = "";
			$supported_sym = '/[\'^£$%&*()}{@#~?><>,|=_+¬-]/';
			
			/* Dissect The String */
			for( $count = 0; $count < strlen( $original ) + 1; $count++ ) {
				
				/* If the loop reached the end, stop chopping */
				if ($count == strlen( $original )) {
					if ($builder != "") {
						array_push($chop, $builder);
						$builder = "";
					}
					
					break;
				}
				
				/* Tests of the character is a recognized alphabet, number, or symbol */
				if( (ctype_alpha( $original[$count] ) && $last_type == "alpha") ||
					(ctype_digit( $original[$count] ) && $last_type == "digit") || 
					(preg_match($supported_sym, $original[$count] ) && $last_type == "sym") ) 
				{
					$builder .= (string)substr( $original, $count, 1 );
				} 
				else 
				{
					/* Push string builder to array */
					if( $builder != "" ) {
						array_push( $chop, $builder );
						$builder = "";
					}
					
					/* Checks and re-assign types */
					if( ctype_alpha( $original[$count] ) ) {
						$last_type = "alpha";
					} else if( ctype_digit( $original[$count] ) ) {
						$last_type = "digit";
					} else if( preg_match($supported_sym, $original[$count] ) ) {
						$last_type = "sym";
					} else {
						// Unrecognized Character
					}
					
					/* Re-iterate with the current count */
					$count--;
					
				}
			}
			
			/* Analyze array and record indexes of integers and characters */
			for( $count = 0; $count < count($chop); $count++ ) {
				if( is_numeric( $chop[$count] ) ) {
					array_push( $int_index, $count );
				} else if( ctype_alpha( $chop[$count]) ) {
					array_push( $char_index, $count );
				} else {
					// No arrays are assigned to push symbol index
					// Proceed	
				}
			}
			
			/* Checks if the movement is number, letter, or smart */
			if( $move == SmartMove::$NUMBER ) {
				for( $count = count( $int_index ); $count > 0; $count-- ) {
					$place_value = (int)$chop[$int_index[$count - 1]];
					$place_value++;
					$new_value = "$place_value";
					
					if( strlen( str_pad( $new_value, strlen( $chop[$int_index[$count - 1]] ), '0', STR_PAD_LEFT ) ) > 
						strlen( (string)$chop[$int_index[$count - 1]] ) ) {
						$chop[$int_index[$count - 1]] = substr( $new_value, 1, strlen( $new_value ) -  1);
						
						if($count == 1) {
							$chop[$int_index[$count - 1]] = $new_value;
							break;
						}
					} else if( strlen( 
									str_pad( $new_value, 
												strlen( $chop[$int_index[$count - 1]] ), 
												'0', 
												STR_PAD_LEFT ) 
											) == strlen( (string)$chop[$int_index[$count - 1]] ) ) {
						$chop[$int_index[$count - 1]] = str_pad( $new_value, 
																strlen( $chop[$int_index[$count - 1]] ), 
																'0', 
																STR_PAD_LEFT );
						break;
					} else {
						// Impossible. Error Occured
					}
				}
			} else if( $move == SmartMove::$LETTER ) {
				
				$break_flag = false;
				
				for( $count = count( $char_index ); $count > 0; $count-- ) {
					$traversed_string = $chop[$char_index[$count - 1]];
					
					for( $count2 = strlen( $traversed_string ); $count2 > 0; $count2-- ) {
						$last_character = ord( $traversed_string[$count2 - 1] );
						
						if( (($last_character != ord( "Z" )) && ($last_character != ord( "z" ))) && 
							(($last_character < ord( "Z" )) || ($last_character < ord( "z" ))) ) {
							$last_character++;
							$chop[$char_index[$count - 1]][$count2 - 1] = chr( $last_character );
							$break_flag = true;
							break;
						} else {
							if( $last_character == ord( "Z" ) ) {
								$traversed_string[$count2 - 1] = "A";
								$chop[$char_index[$count - 1]] = $traversed_string;
							} else if( $last_character == ord( "z" ) ) {
								$traversed_string[$count2 - 1] = "a";
								$chop[$char_index[$count - 1]] = $traversed_string;
							} else {
								// Impossible! Error Occured.	
							}
							
							if( ($count == 1) && ($count2 == 1) ) {
								$latest_string = "A";
								$latest_string .= $traversed_string;
								$chop[$char_index[$count - 1]] = $latest_string;
								$break_flag = true;
								break;
							}
						}
					}
					
					if( $break_flag ) {
						break;
					}
				}
			} else if( $move == SmartMove::$SMART ) {
				for( $count = count( $chop ); $count > 0; $count-- ) {
					if( is_numeric( $chop[$count - 1] ) ) {
						$place_value = (int)$chop[$count - 1];
						$place_value++;
						$new_value = "$place_value";
						
						if( strlen( str_pad( $new_value, strlen( $chop[$count - 1] ), '0', STR_PAD_LEFT ) ) > 
							strlen( (string)$chop[$count - 1] ) ) {
							$chop[$count - 1] = substr( $new_value, 1, strlen( $new_value ) -  1);
							
							if($count == 1) {
								$chop[$count - 1] = $new_value;
								break;
							}
						} else if( strlen( 
										str_pad( $new_value, 
													strlen( $chop[$count - 1] ), 
													'0', 
													STR_PAD_LEFT ) 
												) == strlen( (string)$chop[$count - 1] ) ) {
							$chop[$count - 1] = str_pad( $new_value, 
																	strlen( $chop[$count - 1] ), 
																	'0', 
																	STR_PAD_LEFT );
							break;
						} else {
							// Impossible. Error Occured
						}
					} else if( ctype_alpha( $chop[$count - 1] ) ) {
						$traversed_string = $chop[$count - 1];
						$break_flag = false;
						
						for( $count2 = strlen($traversed_string); $count2 > 0; $count2-- ) {
							$last_character = ord( $traversed_string[$count2 - 1] );
							
							if( (($last_character != ord( "Z" )) && ($last_character != ord( "z" ))) && 
								(($last_character < ord( "Z" )) || ($last_character < ord( "z" ))) ) {
								$last_character++;
								$traversed_string[$count2 - 1] = chr( $last_character );
								$chop[$count - 1] = $traversed_string;
								$break_flag = true;
								break;
							} else {
								if( $last_character == ord( "Z" ) ) {
									$traversed_string[$count2 - 1] = "A";
									$chop[$count - 1] = $traversed_string;
								} else if( $last_character == ord( "z" ) ) {
									$traversed_string[$count2 - 1] = "a";
									$chop[$count - 1] = $traversed_string;
								} else {
									// Impossible! Error Occured.	
								}
								
								if( ($count == 1) && ($count2 == 1) ) {
									$latest_string = "A";
									$latest_string .= $traversed_string;
									$chop[$char_index[$count - 1]] = $latest_string;
									$break_flag = true;
									break;
								}
							}
						}
						
						if( $break_flag ) {
							break;
						}
					} else if( preg_match( $supported_sym, $chop[$count - 1] ) ) {
						// Do nothing
						continue;
					} else {
						
					}
				}
			} else {
				// Invalid Movement! Error Occured.
			}
			
			if( $save_type == SmartSave::$SAVE ) {
				$this -> data_proc = implode( $chop );
			}
			
			return ( (string)implode( $chop ) );
		} // function smart_next( $move = 1, $save_type = false )
	} // class SmartCounter
	
	/** Class for static counter
	 *		This class contains only 2 static functions
	 */
	class StaticCounter {
		static function clean_data( $data ) {
			$data = strip_tags( $data );
			return ( $data );
		} // function clean_data( $data )
		
		static function smart_next( $data = "NULL", $move = 1 ) {
			$original = $data;
			$chop = array( );
			$int_index = array();
			$char_index = array();
			$last_type = "";
			$builder = "";
			$supported_sym = '/[\'^£$%&*()}{@#~?><>,|=_+¬-]/';
			
			/* Dissect The String */
			for( $count = 0; $count < strlen( $original ) + 1; $count++ ) {
				
				/* If the loop reached the end, stop chopping */
				if ($count == strlen( $original )) {
					if ($builder != "") {
						array_push($chop, $builder);
						$builder = "";
					}
					
					break;
				}
				
				/* Tests of the character is a recognized alphabet, number, or symbol */
				if( (ctype_alpha( $original[$count] ) && $last_type == "alpha") ||
					(ctype_digit( $original[$count] ) && $last_type == "digit") || 
					(preg_match($supported_sym, $original[$count] ) && $last_type == "sym") ) 
				{
					$builder .= (string)substr( $original, $count, 1 );
				} 
				else 
				{
					/* Push string builder to array */
					if( $builder != "" ) {
						array_push( $chop, $builder );
						$builder = "";
					}
					
					/* Checks and re-assign types */
					if( ctype_alpha( $original[$count] ) ) {
						$last_type = "alpha";
					} else if( ctype_digit( $original[$count] ) ) {
						$last_type = "digit";
					} else if( preg_match($supported_sym, $original[$count] ) ) {
						$last_type = "sym";
					} else {
						// Unrecognized Character
					}
					
					/* Re-iterate with the current count */
					$count--;
					
				}
			}
			
			/* Analyze array and record indexes of integers and characters */
			for( $count = 0; $count < count($chop); $count++ ) {
				if( is_numeric( $chop[$count] ) ) {
					array_push( $int_index, $count );
				} else if( ctype_alpha( $chop[$count]) ) {
					array_push( $char_index, $count );
				} else {
					// No arrays are assigned to push symbol index
					// Proceed	
				}
			}
			
			/* Checks if the movement is number, letter, or smart */
			if( $move == SmartMove::$NUMBER ) {
				for( $count = count( $int_index ); $count > 0; $count-- ) {
					$place_value = (int)$chop[$int_index[$count - 1]];
					$place_value++;
					$new_value = "$place_value";
					
					if( strlen( str_pad( $new_value, strlen( $chop[$int_index[$count - 1]] ), '0', STR_PAD_LEFT ) ) > 
						strlen( (string)$chop[$int_index[$count - 1]] ) ) {
						$chop[$int_index[$count - 1]] = substr( $new_value, 1, strlen( $new_value ) -  1);
						
						if($count == 1) {
							$chop[$int_index[$count - 1]] = $new_value;
							break;
						}
					} else if( strlen( 
									str_pad( $new_value, 
												strlen( $chop[$int_index[$count - 1]] ), 
												'0', 
												STR_PAD_LEFT ) 
											) == strlen( (string)$chop[$int_index[$count - 1]] ) ) {
						$chop[$int_index[$count - 1]] = str_pad( $new_value, 
																strlen( $chop[$int_index[$count - 1]] ), 
																'0', 
																STR_PAD_LEFT );
						break;
					} else {
						// Impossible. Error Occured
					}
				}
			} else if( $move == SmartMove::$LETTER ) {
				
				$break_flag = false;
				
				for( $count = count( $char_index ); $count > 0; $count-- ) {
					$traversed_string = $chop[$char_index[$count - 1]];
					
					for( $count2 = strlen( $traversed_string ); $count2 > 0; $count2-- ) {
						$last_character = ord( $traversed_string[$count2 - 1] );
						
						if( (($last_character != ord( "Z" )) && ($last_character != ord( "z" ))) && 
							(($last_character < ord( "Z" )) || ($last_character < ord( "z" ))) ) {
							$last_character++;
							$chop[$char_index[$count - 1]][$count2 - 1] = chr( $last_character );
							$break_flag = true;
							break;
						} else {
							if( $last_character == ord( "Z" ) ) {
								$traversed_string[$count2 - 1] = "A";
								$chop[$char_index[$count - 1]] = $traversed_string;
							} else if( $last_character == ord( "z" ) ) {
								$traversed_string[$count2 - 1] = "a";
								$chop[$char_index[$count - 1]] = $traversed_string;
							} else {
								// Impossible! Error Occured.	
							}
							
							if( ($count == 1) && ($count2 == 1) ) {
								$latest_string = "A";
								$latest_string .= $traversed_string;
								$chop[$char_index[$count - 1]] = $latest_string;
								$break_flag = true;
								break;
							}
						}
					}
					
					if( $break_flag ) {
						break;
					}
				}
			} else if( $move == SmartMove::$SMART ) {
				for( $count = count( $chop ); $count > 0; $count-- ) {
					if( is_numeric( $chop[$count - 1] ) ) {
						$place_value = (int)$chop[$count - 1];
						$place_value++;
						$new_value = "$place_value";
						
						if( strlen( str_pad( $new_value, strlen( $chop[$count - 1] ), '0', STR_PAD_LEFT ) ) > 
							strlen( (string)$chop[$count - 1] ) ) {
							$chop[$count - 1] = substr( $new_value, 1, strlen( $new_value ) -  1);
							
							if($count == 1) {
								$chop[$count - 1] = $new_value;
								break;
							}
						} else if( strlen( 
										str_pad( $new_value, 
													strlen( $chop[$count - 1] ), 
													'0', 
													STR_PAD_LEFT ) 
												) == strlen( (string)$chop[$count - 1] ) ) {
							$chop[$count - 1] = str_pad( $new_value, 
																	strlen( $chop[$count - 1] ), 
																	'0', 
																	STR_PAD_LEFT );
							break;
						} else {
							// Impossible. Error Occured
						}
					} else if( ctype_alpha( $chop[$count - 1] ) ) {
						$traversed_string = $chop[$count - 1];
						$break_flag = false;
						
						for( $count2 = strlen($traversed_string); $count2 > 0; $count2-- ) {
							$last_character = ord( $traversed_string[$count2 - 1] );
							
							if( (($last_character != ord( "Z" )) && ($last_character != ord( "z" ))) && 
								(($last_character < ord( "Z" )) || ($last_character < ord( "z" ))) ) {
								$last_character++;
								$traversed_string[$count2 - 1] = chr( $last_character );
								$chop[$count - 1] = $traversed_string;
								$break_flag = true;
								break;
							} else {
								if( $last_character == ord( "Z" ) ) {
									$traversed_string[$count2 - 1] = "A";
									$chop[$count - 1] = $traversed_string;
								} else if( $last_character == ord( "z" ) ) {
									$traversed_string[$count2 - 1] = "a";
									$chop[$count - 1] = $traversed_string;
								} else {
									// Impossible! Error Occured.	
								}
								
								if( ($count == 1) && ($count2 == 1) ) {
									$latest_string = "A";
									$latest_string .= $traversed_string;
									$chop[$char_index[$count - 1]] = $latest_string;
									$break_flag = true;
									break;
								}
							}
						}
						
						if( $break_flag ) {
							break;
						}
					} else if( preg_match( $supported_sym, $chop[$count - 1] ) ) {
						// Do nothing
						continue;
					} else {
						
					}
				}
			} else {
				// Invalid Movement! Error Occured.
			}
			
			return ( (string)implode( $chop ) );
		} // static function smart_next( $data = "NULL", $move = 1 )
	} // class StaticCounter
	
	/** Class for generating primary key
     *  This class generates primary key based on time
	 */
	class PrimaryKey
	{
		static function generatePK() {
			$year = date("Y");
			$day = date("m");
			$month = date("d");
			$hour = date("h");
			$minute = date("i");
			$second = date("s");
			$millisecond = round(microtime(true) * 1000);
			
			return ($year . $day . $month . $hour . $minute . $second . $millisecond);
		}
		
		static function prependPK($primary, $prepend) {
			return ($prepend . $primary);
		}
		
		static function appendPK($primary, $append) {
			return ($primary . $append);
		}
	}
?>