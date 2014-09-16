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
// Rm accents	
	function wd_remove_accents($str, $charset='utf-8')
	{
		$str = htmlentities($str, ENT_NOQUOTES, $charset);
	
		$str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
		$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
		$str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
	
		return $str;
	}
?>