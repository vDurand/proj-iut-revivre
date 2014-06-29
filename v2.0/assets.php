<?php
// Formatage de date en type FR
	function dater($str)
	{
		$formatDate = "d / m / Y";
		$result = "";
		if($str!="")
			$result = date($formatDate, strtotime($str));
		return $result;
	}
	
// Connexion a la base Revivre
	function revivre()
	{
		if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'Revivre', 0, '/media/fd0b1/alx22/private/mysql/socket'))
			return $db;
		else
			echo 'Erreur';
	}
?>