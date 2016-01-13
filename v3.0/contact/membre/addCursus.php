<?php
$pageTitle = "Cursus du Salarié";
$pwd = '../../';
include('../../bandeau.php');
?>
<div id="corps">
	<div id="labelT">
        <label>Détail du Cursus</label>
    </div>
    <?php
    	if (isset($_POST['NumC']))
    		$numero = $_POST['NumC'];
    	else
    		$numero = $_GET['NumC'];
    	$donnees = mysqli_query($db, "SELECT SAL_NumSalarie, PER_Nom, PER_Prenom, TYP_ID, INS_DateEntree
								FROM personnes JOIN salaries USING (PER_Num)
								JOIN insertion USING (SAL_NumSalarie)
								WHERE SAL_NumSalarie = $numero");


        $personne = mysqli_fetch_assoc($donnees);
    ?>
	<div>
		<form method="post" name="validerCursus" action="cursusPost.php">
		<table align="center" class="detailClients" width="80%" cellpadding="20px">
	    	<tr>
	    		<th style="text-align: center; width: 200px; white-space: normal;">
	    			<label><u>Numero de Salarié : <?php echo $personne['SAL_NumSalarie']?></label>
	    		</th>
	    		<th style="text-align: center">
	    			<label><u> <?php echo $personne['PER_Nom']."&nbsp".$personne['PER_Prenom']?></label>
	    		</th>
	    		<th style="text-align: center">
	    			<?php
	    				$type = mysqli_fetch_assoc(mysqli_query($db, "SELECT DISTINCT TYP_Nom from type where TYP_ID = ".$personne['TYP_ID']));
	    				echo "<u><label>".$type['TYP_Nom']."</label>";
	    			?>
	    		</th>
	    	</tr>
		</table>
	</div>
		<table align="center" width="60%" cellpadding="8px">
			<tbody>
				<tr align="center">
					<td > Nouveau type : </td>
					<td>
						<select name="type">
						<?php
							$donnees = mysqli_query($db, "SELECT * from type where TYP_ID > 5");
							while ($reponse = mysqli_fetch_assoc($donnees))
								echo "<option value=".$reponse['TYP_Id'].">".$reponse['TYP_Nom']."</option>";
						?>
					</td>
				</tr>
				<tr align="center">
					<td > Commentaire (optionnel) : </td>
					<td>
						<input type="text" name="comment" size="40px">
					</td>
				</tr>
				<tr align="center">
					<td colspan="2">
						<input type="checkbox" name="visible" id="visible" checked="checked"><label> Rendre visible dans le cursus</label>
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td align="center">
						<input type="hidden" name="NumC" value="<?php echo $numero; ?>">
						<input type="submit" name="valider" class="buttonC" value="Valider" style="font-size: 14;">
					</td>
					<td align="center">
						<form method="post" name="retourCursus" action="cursus.php">
						    <input type="hidden" name="NumC" value="<?php echo $numero; ?>">
						    <input type="submit" name="retour" class="buttonC" value="Retour" style="font-size: 14;">
					  	</form>
					</td>

				</tr>
			</tfoot>
		</table>
	</form>
</div>
<?php
include('../../footer.php');
?>