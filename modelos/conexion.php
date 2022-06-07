<?php

class Conexion{

	public static function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=relcarsem",
			            "root",
			            "");

		$link->exec("set names utf8");

		return $link;

	}

}



