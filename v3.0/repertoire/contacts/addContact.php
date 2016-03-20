<?php
	$pageTitle = "Ajout d'un contact";
	$pwd='../../';
	include($pwd."bandeau.php");

	$query = mysqli_query($db, "SELECT TC_ID, TC_Nom FROM typecontact ORDER BY TC_ID;");
?>
<div id="corps">
	<div id="labelT">
		<label>Ajout d'un contact</label>
	</div>
	<div class="repertoire-form-filters">
		<table>
			<tbody>
				<tr>
					<td><label>Choisissez le type du formulaire pour le contact : </label></td>
					<td>
						<div class="selectType" style="width:200px">
							<select id="TC_ID">
								<option value="0" selected="selected" disabled="disabled">Choisissez le type</option>
							<?php
								while($data = mysqli_fetch_assoc($query)){
									echo '<option value="'.$data["TC_ID"].'">'.$data["TC_Nom"].'</option>';
								}
							?>
							</select>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<hr class="hr-stylized"/>
	<div class="repertoire-form-content waiting-repertoire-form">
		<div class="form-loader">
			<div class='uil-ring-css' style='transform:scale(0.6);'><div></div></div>
			<label>En attente de sélection d'un type de formulaire</label>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#TC_ID").on("change", function(){
		if($(this).val() != "0"){
			getDataAjax("./ajax/formulaireDataAdd.php", {"request_type": "form", "TC_ID": $("#TC_ID").val()}, function(data){
				if(data.length > 0){
					$(".repertoire-form-content").removeClass("waiting-repertoire-form");
					$(".repertoire-form-content .form-loader").hide();
					$(".repertoire-form-content form").remove();
					$(".repertoire-form-content").append(data);
				}
				else{
					$(".repertoire-form-content").addClass("waiting-repertoire-form");
					$(".repertoire-form-content .form-loader").show();
					$(".repertoire-form-content form").remove();
				}
			});
		}
		else{
			$(".repertoire-form-content").addClass("waiting-repertoire-form");
			$(".repertoire-form-content .form-loader").show();
			$(".repertoire-form-content form").remove();
		}
	});

	function getDataAjax(url, params, callback){
		 $.post(url, params, callback);
	}
</script>
<?php
	include($pwd."footer.php");
?>