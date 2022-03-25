<?php

class Connexion{

	protected static $bdd;

	public function __construct(){}

	public static function initConnexion(){
		$user="u7_UMQKmLgVQb";
		$password="Bw+t=7QIIr3c!0VYGesxi3a0";
		$db_host = "game.hyarotech.com";
		$db_name = "s7_MontGE";
		$dns = "mysql:host=".$db_host."; dbname=".$db_name.";charset=utf8";
		try{
			self::$bdd = new PDO($dns,$user,$password);
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}

