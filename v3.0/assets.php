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
		if($db = MySQLi_connect("localhost","Kepha",'pfudor', 'revivre', 0, '/media/fd0b1/alx22/private/mysql/socket'))
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

// http://godefroy.me/php-enlever-tous-les-accents-d-une-chaine-a192614
function removeAccents($txt){
    $txt = str_replace('œ', 'oe', $txt);
    $txt = str_replace('Œ', 'Oe', $txt);
    $txt = str_replace('æ', 'ae', $txt);
    $txt = str_replace('Æ', 'Ae', $txt);
    mb_regex_encoding('UTF-8');
    $txt = mb_ereg_replace('[ÀÁÂÃÄÅĀĂǍẠẢẤẦẨẪẬẮẰẲẴẶǺĄ]', 'A', $txt);
    $txt = mb_ereg_replace('[ãäåāăǎạảấầẩẫậắằẳẵặǻą]', 'a', $txt);
    $txt = mb_ereg_replace('[ÇĆĈĊČ]', 'C', $txt);
    $txt = mb_ereg_replace('[ćĉċč]', 'c', $txt);
    $txt = mb_ereg_replace('[ÐĎĐ]', 'D', $txt);
    $txt = mb_ereg_replace('[ďđ]', 'd', $txt);
    $txt = mb_ereg_replace('[ÈÉÊËĒĔĖĘĚẸẺẼẾỀỂỄỆ]', 'E', $txt);
    $txt = mb_ereg_replace('[ēĕėęěẹẻẽếềểễệ]', 'e', $txt);
    $txt = mb_ereg_replace('[ĜĞĠĢ]', 'G', $txt);
    $txt = mb_ereg_replace('[ĝğġģ]', 'g', $txt);
    $txt = mb_ereg_replace('[ĤĦ]', 'H', $txt);
    $txt = mb_ereg_replace('[ĥħ]', 'h', $txt);
    $txt = mb_ereg_replace('[ÌÍÎÏĨĪĬĮİǏỈỊ]', 'I', $txt);
    $txt = mb_ereg_replace('[ìíîïĩīĭįıǐỉị]', 'i', $txt);
    $txt = str_replace('Ĵ', 'J', $txt);
    $txt = str_replace('ĵ', 'j', $txt);
    $txt = str_replace('Ķ', 'K', $txt);
    $txt = str_replace('ķ', 'k', $txt);
    $txt = mb_ereg_replace('[ĹĻĽĿŁ]', 'L', $txt);
    $txt = mb_ereg_replace('[ĺļľŀł]', 'l', $txt);
    $txt = mb_ereg_replace('[ÑŃŅŇ]', 'N', $txt);
    $txt = mb_ereg_replace('[ñńņňŉ]', 'n', $txt);
    $txt = mb_ereg_replace('[ÒÓÔÕÖØŌŎŐƠǑǾỌỎỐỒỔỖỘỚỜỞỠỢ]', 'O', $txt);
    $txt = mb_ereg_replace('[òóõöøōŏőơǒǿọỏốồổỗộớờởỡợð]', 'o', $txt);
    $txt = mb_ereg_replace('[ŔŖŘ]', 'R', $txt);
    $txt = mb_ereg_replace('[ŕŗř]', 'r', $txt);
    $txt = mb_ereg_replace('[ŚŜŞŠ]', 'S', $txt);
    $txt = mb_ereg_replace('[śŝşš]', 's', $txt);
    $txt = mb_ereg_replace('[ŢŤŦ]', 'T', $txt);
    $txt = mb_ereg_replace('[ţťŧ]', 't', $txt);
    $txt = mb_ereg_replace('[ÙÚÛÜŨŪŬŮŰŲƯǓǕǗǙǛỤỦỨỪỬỮỰ]', 'U', $txt);
    $txt = mb_ereg_replace('[üũūŭůűųưǔǖǘǚǜụủứừửữự]', 'u', $txt);
    $txt = mb_ereg_replace('[ŴẀẂẄ]', 'W', $txt);
    $txt = mb_ereg_replace('[ŵẁẃẅ]', 'w', $txt);
    $txt = mb_ereg_replace('[ÝŶŸỲỸỶỴ]', 'Y', $txt);
    $txt = mb_ereg_replace('[ýÿŷỹỵỷỳ]', 'y', $txt);
    $txt = mb_ereg_replace('[ŹŻŽ]', 'Z', $txt);
    $txt = mb_ereg_replace('[źżž]', 'z', $txt);
    return $txt;
}

function in_assoc_array_by_key($value, $array, $key){
    for($x=0; $x<sizeof($array); $x++){
        if($array[$x][$key] == $value){
            return true;
        }
    }
    return false;
}

// Retire les caracteres spéciaux
function removeWeirdChar($txt){
    mb_regex_encoding('UTF-8');
    $txt = mb_ereg_replace('[€&$%£#@§!.|,:/]', '', $txt);
    return $txt;
}

// Retire les nombres
function removeNumber($txt){
    mb_regex_encoding('UTF-8');
    $txt = mb_ereg_replace('[0-9]', '', $txt);
    return $txt;
}

// Retire les accents des premieres lettre de chaque mot
function firstNoAccent($a)
{
    $b = explode (" ", $a);
    $d=" ";
    $i=0;
    foreach($b as $key => $val){
        $d = $d.strtoupper(noAccents(mb_substr($val, 0, 1, 'UTF-8'))).mb_substr($val, 1, mb_strlen($val), 'UTF-8');
        $d = trim($d)." ";
    }
    $b = explode ("-", trim($d));
    $d=" ";
    $i=0;
    foreach($b as $key => $val){
        $d = $d.strtoupper(noAccents(mb_substr($val, 0, 1, 'UTF-8'))).mb_substr($val, 1, mb_strlen($val), 'UTF-8');
        $d = trim($d, "-")."-";
    }
    $b = explode ("'", trim($d));
    $d=" ";
    $i=0;
    foreach($b as $key => $val){
        $d = $d.strtoupper(noAccents(mb_substr($val, 0, 1, 'UTF-8'))).mb_substr($val, 1, mb_strlen($val), 'UTF-8');
        $d = trim($d, "'")."'";
    }
    return trim($d, "'- ");
}

// formatage du nom
function formatUPnoNb($nom)
{
    return strtoupper(noAccents(trim(firstNoAccent(removeAccents(removeWeirdChar(removeNumber($nom)))), " -")));
}

// formatage du prenom
function formatLOWnoNb($prenom)
{
    return trim(firstNoAccent(removeAccents(mb_convert_case(removeWeirdChar(removeNumber(stripslashes($prenom))), MB_CASE_TITLE, "UTF-8"))), " -");
}

// formatage d'epreuve
function formatUP($nom)
{
    return strtoupper(noAccents(trim(firstNoAccent(removeAccents(removeWeirdChar(stripslashes($nom)))), " -")));
}

// formatage du prenom
function formatLOW($prenom)
{
    return trim(firstNoAccent(removeAccents(mb_convert_case(removeWeirdChar(stripslashes($prenom)), MB_CASE_TITLE, "UTF-8"))), " -");
}

// getter POST
function postGetter($name)
{
    if(isset($_POST[$name])&&!empty($_POST[$name]))
        return $_POST[$name];
    else
        return null;
}
 // getter GET
function getGetter($name)
{
    if(isset($_GET[$name])&&!empty($_GET[$name]))
        return $_GET[$name];
    else
        return null;
}

function isJourFerie($date)
{

    if($date === null)
    {
        return false;
    }
    else
    {
        $date = DateTime::createFromFormat('d/m/Y', $date)->format('m/d/Y');
        $year = DateTime::createFromFormat('m/d/Y', $date)->format('Y');

        $easterDate  = easter_date($year);
        $easterDay   = date('j', $easterDate);
        $easterMonth = date('n', $easterDate);
        $easterYear   = date('Y', $easterDate);

        $holidays = array(
            mktime(0, 0, 0, 1,  1,  $year),  // 1er janvier
            mktime(0, 0, 0, 5,  1,  $year),  // Fête du travail
            mktime(0, 0, 0, 5,  8,  $year),  // Victoire des alliés
            mktime(0, 0, 0, 7,  14, $year),  // Fête nationale
            mktime(0, 0, 0, 8,  15, $year),  // Assomption
            mktime(0, 0, 0, 11, 1,  $year),  // Toussaint
            mktime(0, 0, 0, 11, 11, $year),  // Armistice
            mktime(0, 0, 0, 12, 25, $year),  // Noel
            mktime(0, 0, 0, $easterMonth, $easterDay + 1,  $easterYear),  // Lundi de paques
            mktime(0, 0, 0, $easterMonth, $easterDay + 39, $easterYear),  // Ascension
            mktime(0, 0, 0, $easterMonth, $easterDay + 50, $easterYear),  // Pentecote
        );
        
        return in_array(strtotime($date), $holidays, true);
    }
}

function highestDate($tabDate, $tabDateArchi)
{
    if(sizeof($tabDate) > 1)
    {
        if(sizeof($tabDateArchi) > 1)
        {
            $date = DateTime::createFromFormat('d/m/Y', $tabDate[1])->format('Y-m-d');
            $dateArchi = DateTime::createFromFormat('d/m/Y', $tabDateArchi[1])->format('Y-m-d');
            if($date > $dateArchi)
            {
                return date('Y-m-d', strtotime($date.'+ 7 day'));
            }
            else
            {
                return date('Y-m-d', strtotime($dateArchi.'+ 7 day'));
            }
        }
        else
            return date('Y-m-d', strtotime(DateTime::createFromFormat('d/m/Y', $tabDate[1])->format('Y-m-d').'+ 7 day'));
    }
    else
        return date('Y-m-d', strtotime("next monday"));
}

/////////////////////////////////////////////////////////////////
// FONCTIONS DE MISE EN FORME DE CHAINE DE CARACTERES #projetphp
/////////////////////////////////////////////////////////////////

// enleve les liguatures
function suppr_lig_nom($str)
{
    $A_remplacer = array("/æ/","/Æ/","/œ/","/Œ/");
    $Remplacement = array("ae","AE","oe","OE");
    $str = preg_replace($A_remplacer,$Remplacement, $str);
  
    return $str;
}

// remplace les caractères non francais
function suppr_carac($txt){

    $A_remplacer =  array("/Á/","/á/","/Ä/","/ä/","/Ą/","/ą/","/Ⱥ/","/ⱥ/","/Ǎ/","/ǎ/","/Ȧ/","/ȧ/","/Ạ/","/ạ/","/Ā/","/ā/","/Ã/","/ã/",
                        "/Ć/","/ć/","/C̀/","/c̀/","/Ĉ/","/ĉ/","/C̈/","/c̈/","/Ȼ/","/ȼ/","/Č/","/č/","/Ċ/","/ċ/","/C̣/","/c̣/","/C̄/","/c̄/","/C̃/","/c̃/","/ç/",                     
                        "/Ȩ/","/ȩ/","/Ę/","/ę/","/Ɇ/","/ɇ/","/Ě/","/ě/","/Ė/","/ė/","/Ẹ/","/ẹ/","/Ē/","/ē/","/Ẽ/","/ẽ/",
                        "/Í/","/í/","/Ì/","/ì/","/I̧/","/i̧/","/Į/","/į/","/Ɨ/","/ɨ/","/Ǐ/","/ǐ/","/Ị/","/ị/","/Ī/","/ī/","/Ĩ/","/ĩ/","/İ/",
                        "/J́/","/j́/","/J̀/","/j̀/","/Ĵ/","/ĵ/","/J̈/","/j̈/","/J̧/","/j̧/","/J̨/","/j̨/","/Ɉ/","/ɉ/","/J̌/","/ǰ/","/J̣/","/j̣/","/J̄/","/j̄/","/J̃/","/j̃/","/J̇/",
                        "/Ĺ/","/ĺ/","/L̀/","/l̀/","/L̂/","/l̂/","/L̈/","/l̈/","/Ļ/","/ļ/","/L̨/","/l̨/","/Ł/","/ł/","/Ƚ/","/ƚ/","/Ľ/","/ľ/","/L̇/","/l̇/","/Ḷ/","/ḷ/","/L̄/","/l̄/","/L̃/","/l̃/",                      
                        "/Ń/","/ń/","/Ǹ/","/ǹ/","/N̂/","/n̂/","/N̈/","/n̈/","/Ņ/","/ņ/","/N̨/","/n̨/","/Ň/","/ň/","/Ṅ/","/ṅ/","/Ṇ/","/ṇ/","/N̄/","/n̄/","/Ñ/","/ñ/",
                        "/Ó/","/ó/","/Ò/","/ò/","/Ö/","/ö/","/O̧/","/o̧/","/Ǫ/","/ǫ/","/Ø/","/ø/","/Ɵ/","/ɵ/","/Ǒ/","/ǒ/","/Ȯ/","/ȯ/","/Ọ/","/ọ/","/Ō/","/ō/","/Õ/","/õ/",
                        "/Ś/","/ś/","/S̀/","/s̀/","/Ŝ/","/ŝ/","/S̈/","/s̈/","/Ş/","/ş/","/S̨/","/s̨/","/Š/","/š/","/Ṡ/","/ṡ/","/Ṣ/","/ṣ/","/S̄/","/s̄/","/S̃/","/s̃/",
                        "/T́/","/t́/","/T̀/","/t̀/","/T̂/","/t̂/","/T̈/","/ẗ/","/Ţ/","/ţ/","/T̨/","/t̨/","/Ⱦ/","/ⱦ/","/Ŧ/","/ŧ/","/Ť/","/ť/","/Ṫ/","/ṫ/","/Ṭ/","/ṭ/","/T̄/","/t̄/","/T̃/","/t̃/",
                        "/Ú/","/ú/","/U̧/","/u̧/","/Ų/","/ų/","/Ʉ/","/ʉ/","/Ǔ/","/ǔ/","/U̇/","/u̇/","/Ụ/","/ụ/","/Ū/","/ū/","/Ũ/","/ũ/",    
                        "/Ý/","/ý/","/Ỳ/","/ỳ/","/Ŷ/","/ŷ/","/Ÿ/","/ÿ/","/Y̧/","/y̧/","/Y̨/","/y̨/","/Ɏ/","/ɏ/","/Y̌/","/y̌/","/Ẏ/","/ẏ/","/Ỵ/","/ỵ/","/Ȳ/","/ȳ/","/Ỹ/","/ỹ/",
                        "/Ź/","/ź/","/Z̀/","/z̀/","/Ẑ/","/ẑ/","/Z̈/","/z̈/","/Z̧/","/z̧/","/Z̨/","/z̨/","/Ƶ/","/ƶ/","/Ž/","/ž/","/Ż/","/ż/","/Ẓ/","/ẓ/","/Z̄/","/z̄/","/Z̃/","/z̃/");

    $Remplacement = array("A","a","A","a","A","a","A","a","A","a","A","a","A","a","A","a","A","a",
                        "C","c","C","c","C","c","C","c","C","c","C","c","C","c","C","c","C","c","C","c","c",
                        "E","e","E","e","E","e","E","e","E","e","E","e","E","e","E","e",
                        "I","i","I","i","I","i","I","i","I","i","I","i","I","i","I","i","I","i","I",
                        "J","j","J","j","J","j","J","j","J","j","J","j","J","j","J","j","J","j","J","j","J","j","J",
                        "L","l","L","l","L","l","L","l","L","l","L","l","L","l","L","l","L","l","L","l","L","l","L","l","L","l",
                        "N","n","N","n","N","n","N","n","N","n","N","n","N","n","N","n","N","n","N","n","N","n",
                        "O","o","O","o","O","o","O","o","O","o","O","o","O","o","O","o","O","o","O","o","O","o","O","o",
                        "S","s","S","s","S","s","S","s","S","s","S","s","S","s","S","s","S","s","S","s","S","s",
                        "T","t","T","t","T","t","T","t","T","t","T","t","T","t","T","t","T","t","T","t","T","t","T","t","T","t",
                        "U","u","U","u","U","u","U","u","U","u","U","u","U","u","U","u","U","u",
                        "Y","y","Y","y","Y","y","Y","y","Y","y","Y","y","Y","y","Y","y","Y","y","Y","y","Y","y","Y","y",
                        "Z","z","Z","z","Z","z","Z","z","Z","z","Z","z","Z","z","Z","z","Z","z","Z","z","Z","z","Z","z");

    return preg_replace($A_remplacer, $Remplacement, $txt);
}


function suppr_carac_spe($txt){
    $txt = suppr_lig_nom($txt);
    $txt = suppr_carac($txt);
    return $txt;
}

// test si il y a des symbols tel que €
function Test_caractere($txt){
    if(preg_match('/[<>!"#$£%&€§=°ß()¤\*+,.\/:;?@\\\\^_`{\|}~\[\]]/', $txt) || preg_match("/[0-9]/", $txt))
        return 1;
    else
        return 0;
}

//transforme en maj la première lettre d'une chaine
function FirstToUpper($txt){
    $A_remplacer = array("/À/","/à/","/Â/","/â/","/Ç/","/ç/","/É/","/é/","/È/","/è/","/Ê/","/ê/","/Ë/","/ë/","/Î/","/î/","/Ï/","/ï/","/Ô/","/ô/","/Ù/","/ù/","/Û/","/û/","/Ü/","/ü/");
    $Remplacement = array("A","a","A","a","C","c","E","e","E","e","E","e","E","e","I","i","I","i","O","o","U","u","U","u","U","u");
    $txt = preg_replace($A_remplacer, $Remplacement, mb_substr($txt, 0, 1)).mb_substr($txt, 1);
    return ucwords($txt);
}

function isPhoneNumber($txt){
    if(preg_match('/^(0)[0-9]{9}$/', str_replace(array(" ", ".", "-"), "", trim($txt))))
        return 1;
    else
        return 0;
}

function isEmail($txt){
    if(preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', trim($txt)))
        return 1;
    else
        return 0;
}

function isPostalCode($txt){
    if(preg_match('/^[0-9]{4,5}$/', str_replace(array(" ", ".", "-"), "", $txt))){
        return 1;
    }
    else{
        return 0;
    }
}

function convertToPhoneNumber($txt){
    if(preg_match( '/^(0[1-9])([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})$/', $txt,  $matches))
    {
        return $matches[1].' '.$matches[2].' '.$matches[3].' '.$matches[4].' '.$matches[5];
        
    }
    else{
        return $txt;
    }
}

?>