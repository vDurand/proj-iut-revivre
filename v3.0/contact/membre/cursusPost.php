<?php
	$pageTitle = "Cursus du Salarié";
	$pwd = '../../';
	include('../../bandeau.php');
?>
<div id="corps">
<?php

	if(isset($_POST['valider'])){
		$type = $_POST['type'];
		$numero = $_POST['NumC'];
		if(isset($_POST['visible']))
			$visible = 1;
		else
			$visible = 0;
		$typeActuel = mysqli_fetch_assoc(mysqli_query($db, "SELECT TYP_Id from salaries where SAL_NumSalarie = ".$numero));

		$primNum = mysqli_fetch_assoc(mysqli_query($db, "SELECT max(cur_numero)+1 as max from cursus"));
		//echo $primNum;

		if (!isset($_POST['comment'])){
			$reponse = mysqli_query($db, "INSERT INTO cursus (cur_numero, cur_date, sal_numsalarie, typ_id, cur_visible) values (".$primNum['max'].",sysdate(),".$numero.",".$type.",".$visible.")");
			$reponse2 = mysqli_query($db, "UPDATE salaries set TYP_ID = ".$type." where SAL_NumSalarie = ".$numero);
		}
		else{
			$commentaire = $_POST['comment'];
			$requete = "INSERT INTO cursus values (".$primNum['max'].",sysdate(),".$numero.",".$type.",'".$commentaire."',".$visible.")";
			$reponse = mysqli_query($db, $requete);
			$reponse2 = mysqli_query($db, "UPDATE salaries set TYP_ID = ".$type." where SAL_NumSalarie = ".$numero);
		}
		if ($reponse && $reponse2){
			mysqli_query($db, "commit");
			echo "<div id=\"good\">Le cursus du salarié à bien été mis à jour</div>";
			}
		else{
			echo "</br>".$reponse." , ".$reponse2;
			mysqli_query($db, "rollback");
			echo "<div id=\"bad\">Une erreur est survenue dans la mise à jour du cursus</div>";
		}
	}
	else{
		echo "<div id=\"bad\">Une erreur est survenue dans la mise à jour du cursus</div>";
	}
	echo "
		<table align=\"center\" id=\"downT\">
			<tr>
				<td align=\"center\">
					<form method=\"post\" name=\"retourCursus\" action=\"cursus.php\">
					    <input type=\"hidden\" name=\"NumC\" value=\"".$_POST['NumC']."\"?>
					    <input type=\"submit\" name=\"retour\" class=\"buttonC\" value=\"Retour\" style=\"font-size: 14;\">
				  	</form>
				</td>
			</tr>
		</table>";
?>
</div>
<?php
	include('../../footer.php');
?>