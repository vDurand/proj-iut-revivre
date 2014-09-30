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
// Rm accents - http://www.weirdog.com/blog/php/supprimer-les-accents-des-caracteres-accentues.html
function noAccents($str, $charset='utf-8')
{
    $str = htmlentities($str, ENT_NOQUOTES, $charset);

    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

    return $str;
}

// Retire les accents des premieres lettre de chaque mot
function firstNoAccent($a)
{
    $b = explode (" ", $a);
    $d=" ";
    $i=0;
    foreach($b as $key => $val){
        $d = $d.noAccents(mb_substr($val, 0, 1, 'UTF-8')).mb_substr($val, 1, mb_strlen($val), 'UTF-8');
        $d = $d." ";
    }
    $b = explode ("-", trim($d));
    $d=" ";
    $i=0;
    foreach($b as $key => $val){
        $d = $d.noAccents(mb_substr($val, 0, 1, 'UTF-8')).mb_substr($val, 1, mb_strlen($val), 'UTF-8');
        $d = $d."-";
    }
    return trim($d, "- ");
}

// formatage du nom
function allCap($nom)
{
    return strtoupper(noAccents(trim($nom)));
}

// formatage du prenom
function firstMaj($prenom)
{
    return mb_convert_case(trim(firstNoAccent($prenom)), MB_CASE_TITLE, "UTF-8");
}

// getter-setter
function postGetter($name)
{
    if(isset($_POST[$name])&&!empty($_POST[$name]))
        return $_POST[$name];
    else
        return null;
}

function getGetter($name)
{
    if(isset($_GET[$name])&&!empty($_GET[$name]))
        return $_GET[$name];
    else
        return null;
}
?>