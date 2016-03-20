<?php
	$pageTitle = "Liste des référents";
	$pwd='../../../';
	include($pwd.'bandeau.php');
?>
<div id="corps">
	<div id="labelT">
		<label>Liste des référents</label>
	</div>
	<div class="repertoire-form-content">
	<?php
		$query_salaries = mysqli_query($db, "SELECT * FROM referents JOIN personnes USING(PER_Num) JOIN prescripteurs USING(PRE_Id) WHERE PER_Nom <> '' ORDER BY PER_Nom, PER_Prenom;");
	?>
		<div class="repertoire-show-list">
        	<table class="sortable" cellpadding="5">
            	<thead>
            		<tr>
                		<th>Nom</th>
                		<th>Prénom</th>
	                    <th>Tél Fixe</th>
	                    <th>Tél Portable</th>
	                    <th>Email</th>
	                    <th>Rue/Lotissement</th>
	                    <th>Prescripteur</th>
	                </tr>
                </thead>
                <tbody>
	<?php
				while($data = mysqli_fetch_assoc($query_salaries)){
	?>
            		<tr data-refnum="<?php echo $data["REF_NumRef"]; ?>">
                		<td><?php echo (($data["PER_Nom"] != "") ? stripcslashes($data["PER_Nom"]) : '<i class="no-data">Aucun nom</i>') ?></td>
                		<td><?php echo (($data["PER_Prenom"] != "") ? stripcslashes($data["PER_Prenom"]) : '<i class="no-data">Aucun nom</i>') ?></td>
	                    <td><?php echo (($data["PER_TelFixe"] != "") ? convertToPhoneNumber($data["PER_TelFixe"]) : '<i class="no-data">Aucun numéro</i>'); ?></td>
	                    <td><?php echo (($data["PER_TelPort"] != "") ? convertToPhoneNumber($data["PER_TelPort"]) : '<i class="no-data">Aucun numéro</i>'); ?></td>
	                    <td class="truncate"><?php echo (($data["PER_Email"] != "") ? stripcslashes($data["PER_Email"]) : '<i class="no-data">Aucun e-mail</i>'); ?></td>
	                    <td class="truncate"><?php echo (($data["PER_Adresse"] != "") ? stripcslashes($data["PER_Adresse"]) : '<i class="no-data">Aucune rue/lotissement</i>'); ?></td>
	                    <td class="truncate"><?php echo (($data["PRE_Nom"] != "") ? stripcslashes($data["PRE_Nom"]) : '<i class="no-data">Aucun prescripteur</i>'); ?></td>
	                </tr>
	<?php
				}
	?>
                </tbody>
          	</table>
        </div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(".repertoire-show-list table tbody tr").on("click", function(){
			$.redirect("./showReferent.php", {"RefNum": $(this).data("refnum")}, "get");
		});
	});
</script>
<?php
include($pwd.'footer.php');
?>