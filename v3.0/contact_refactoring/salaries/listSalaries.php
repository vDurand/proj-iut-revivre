<?php
	$pageTitle = "Liste des salariés";
	$pwd='../../';
	include($pwd.'bandeau.php');
	$query = mysqli_query($db, "SELECT TYP_Id, TYP_Nom FROM Type ORDER BY TYP_Id");
?>
<div id="corps">
	<div id="labelT">
		<label>Liste des salariés</label>
	</div>
	<div class="repertoire-show-filters">
		<table>
			<thead>
				<tr>
					<th colspan="3">Filtres :</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><label for="TYP_Id">Choisissez le type de salarié à afficher : </label></td>
					<td>
						<div class="selectType" style="width:200px">
							<select id="TYP_Id">
								<option value="0" selected="selected" disabled="disabled">Choisissez le type</option>
							<?php
								while($data = mysqli_fetch_assoc($query)){
									echo '<option value="'.$data["TYP_Id"].'">'.$data["TYP_Nom"].'</option>';
								}
							?>
							</select>
						</div>
					</td>
					<td>
						<input type="checkbox" name="SAL_Actif" id="SAL_Actif"/>
						<label for="SAL_Actif">N'afficher que les archives</label>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<hr class="hr-stylized"/>
	<div class="repertoire-form-content waiting-repertoire-form">
		<div class="form-loader">
			<div class='uil-ring-css' style='transform:scale(0.6);'><div></div></div>
			<label>En attente de sélection d'un type de salarié</label>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#TYP_Id, #SAL_Actif").on("change", function(){
		if($("#TYP_Id").val() > 0){
			getDataAjax("./ajax/formulaireDataAdd.php", {"request_type": "list", "TYP_Id": $("#TYP_Id").val(), "SAL_Actif": !$("#SAL_Actif").prop("checked")}, function(data){
				if(data.length > 0){
					$(".repertoire-form-content").removeClass("waiting-repertoire-form");
					$(".repertoire-form-content .form-loader").hide();
					$(".repertoire-form-content .repertoire-show-list").remove();
					$(".repertoire-form-content").append(data);
					triggerTableRows();
				}
				else{
					$(".repertoire-form-content").addClass("waiting-repertoire-form");
					$(".repertoire-form-content .form-loader").show();
					$(".repertoire-form-content .repertoire-show-list").remove();
				}
			});
		}
		else{
			$(".repertoire-form-content").addClass("waiting-repertoire-form");
			$(".repertoire-form-content .form-loader").show();
			$(".repertoire-form-content .repertoire-show-list").remove();
		}
	});

	function triggerTableRows(){
		$(".repertoire-show-list table tbody tr").on("click", function(){
			$.redirect("./showSalarie.php", {"SalNum": $(this).data("salnum")}, "get");
		});
	}

	function getDataAjax(url, params, callback){
		 $.post(url, params, callback);
	}
</script>
<?php
include('../../footer.php');
?>