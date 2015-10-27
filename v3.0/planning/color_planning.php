<?php
	echo "<input name=\"couleur\" id=\"couleur\" type=\"color\" style=\"margin: 0 5px;\" value=\"#000000\" onchange=\"changeCouleur()\"/>"
?>
<script type="text/javascript">

function changeCouleur(){
	var res = document.getElementById("couleur");
	console.log(res.value);
}

</script>