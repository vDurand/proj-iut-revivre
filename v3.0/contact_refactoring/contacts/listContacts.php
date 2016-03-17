<?php
	$pageTitle = "Liste des contacts";
	$pwd='../../';
	include($pwd.'bandeau.php');
	$query = mysqli_query($db, "SELECT TC_ID, TC_Nom FROM Typecontact ORDER BY TC_ID");
?>
<div id="corps">
	<div id="labelT">
		<label>Liste des contacts</label>
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
					<td><label for="TC_ID">Choisissez le type de contact à afficher : </label></td>
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
					
					<td>		
						<label for="TypeClient" id="Label_TypeClient"  hidden="hidden">Type du client : </label>				
						<div class="selectType" style="width:200px" id="Div_TypeClient" hidden="hidden">
							<select id="TypeClient">
								<option value="0" selected="selected" disabled="disabled">Choisissez le type</option>
								<option value="structure">Structure</option>
								<option value="particulier">Particulier</option>
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
			<label>En attente de sélection d'un type de contact</label>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("#TC_ID").on("change", function(){
		//choix 
		if($("#TC_ID").val() == 1){
			getDataAjax("./ajax/formulaireDataAdd.php", {"request_type": "list", "TC_ID": $("#TC_ID").val()}, function(data){
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

		//choix du type de client (structure ou particulier)
		if($("#TC_ID").val() == 2){
			$("#Label_TypeClient, #Div_TypeClient").show();
			$("#Label_TypeClient").prop("hidden", "");
			$("#Div_TypeClient").prop("hidden", "");
		}
		else{
			$("#Label_TypeClient, #Div_TypeClient").hide();
			$("#TypeClient").val("0");
			$("#Label_TypeClient").prop("hidden", "hidden");
			$("#Div_TypeClient").prop("hidden", "hidden");
		}
	});

	$("#TypeClient").on("change", function(){
		getDataAjax("./ajax/formulaireDataAdd.php", {"request_type": "list", "TC_ID": $("#TC_ID").val(), "TypeClient": $("#TypeClient").val()}, function(data){
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
	});

	function triggerTableRows(){
		$(".repertoire-show-list table tbody tr").on("click", function(){
			if($("#TC_ID").val() == 2){
				$.redirect("./showContact.php", {"ConNum": $(this).data("connum"), "TC_ID": $("#TC_ID").val(), "TypeClient": $("#TypeClient").val()}, "POST");
			}
			else{
				$.redirect("./showContact.php", {"ConNum": $(this).data("connum"), "TC_ID": $("#TC_ID").val()}, "POST");
			}			
		});
	}

	function getDataAjax(url, params, callback){
		 $.post(url, params, callback);
	}
</script>
<?php
include('../../footer.php');
?>