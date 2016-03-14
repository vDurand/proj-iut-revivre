<?php
	$errorsTemp = explode(";", $_POST['Post_Errors']);
	for($x=0; $x<sizeof($errorsTemp); $x++){
		if(!empty($errorsTemp[$x])){
			$tempSplit = explode("|", $errorsTemp[$x]);
			$errors[$tempSplit[0]] = $tempSplit[1];
		}
	}
?>
<div class="form-errors">
	<h4>Un ou plusieurs champs n'a/n'ont pas été saisie(s) correctement(s) :</h4>
	<ul>
		<?php
			foreach($errors as $field => $error){
				echo '<li>'.$error.'</li>';
			}
		?>
	</ul>
</div>
<script type="text/javascript">
	var inputErrorList = <?php echo json_encode($errors); ?>;
	$(document).ready(function(){
		$.each(inputErrorList, function(key, value){
			if($("#"+key).prop("nodeName") == "SELECT"){
				$("#"+key).parent().addClass("value-error");
			}
			else{
				$("#"+key).addClass("value-error");
			}
		});
	});
</script>