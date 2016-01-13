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
    	$numero = $_POST['NumC'];
    	$donnees = mysqli_query($db, "SELECT SAL_NumSalarie, PER_Nom, PER_Prenom, TYP_ID, INS_DateEntree
								FROM personnes JOIN salaries USING (PER_Num)
								JOIN insertion USING (SAL_NumSalarie)
								WHERE SAL_NumSalarie = $numero");


        $personne = mysqli_fetch_assoc($donnees);

        if ($personne){
	?>
		<div>
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
		<div>
			<table rules="all" align="center" width="80%" cellpadding="10px" name="tableCursus" class="emargement-hebdo">
				<thead>
					<tr style="background-color:lightgrey">
						<th id="date">Date de Changement</th>
						<th id="type">Nouveau Type</th>
						<th id="com">Commentaire</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$donnees = mysqli_query($db, "SELECT * from cursus where SAL_NumSalarie = ".$personne['SAL_NumSalarie']." ORDER BY CUR_Date desc");
					if(mysqli_num_rows($donnees) == 0){
						echo "<tr>
								<th style=\"text-align: center;\"colspan=\"4\"><i> Aucun cursus disponible pour ce salarié </i></th>
							  </tr>";
					}
					else{
					while ($reponse = mysqli_fetch_assoc($donnees)){
							$rep = mysqli_query($db, "SELECT TYP_Nom, TYP_ID from type where TYP_ID = ".$reponse['TYP_Id']);
							$type = mysqli_fetch_assoc($rep);
							echo "<tr>
									<td style=\"text-align: center\">".dater($reponse['CUR_Date'])."</td>
									<td style=\"text-align: center\">".$type['TYP_Nom']."</td>
									<td style=\"text-align: center\">".$reponse['CUR_Comment']."</td></form></tr>";
							}
					}
				?>
			</table>
		</div>
		<?php
		}
		else
			 echo "<div id='error'>Une erreur est survenue dans l'affichage du cursus</div>";
		?>
        <table align="center" width="60%" id="downT">
            <tr>
                <td>
                	<form method="post" action="addCursus.php" name="ajouterEtape">
					    <input type="hidden" name="NumC" value="<?php echo $numero ?>">
                  		<input align="center" type="submit" name="addChange" class="buttonC" value="Ajouter" style="font-size: 14;">
                  	</form>
                </td>
				<?php
				if ($personne['TYP_ID'] < 6) {
		            echo '
		            	<td>
		            		<form method="get" action="detailSal.php" name="detailSal">';
		        } else {
		            echo '
		            	<td>
		            		<form method="get" action="detailInsertion.php" name="detailInsertion">';
		        }
		        ?>
					    <input type="hidden" name="NumC" value="<?php echo $numero ?>">
					    <input align="center" type="submit" name="retour" class="buttonC" value="Retour" style="font-size: 14;">
				  	</td>
            </tr>
        </table>
</div>
<?php
include('../../footer.php');
?>