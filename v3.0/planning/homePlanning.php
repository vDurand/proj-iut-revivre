<?php
	$pageTitle = "Gestion des planning";
	$pwd="../";
	include($pwd.'bandeau.php');
?>
    <div id="corps">
        <div id="labelT">
            <label>Page en construction !</label>
        </div>
        <br/>
        <img id="construc" height="300px;" src="../images/maintenance.gif">
    </div>
    <script type="text/javascript">
		window.setTimeout("location=('./planning_insertion.php');",1500);
	</script>'
<?php
include($pwd.'footer.php');
?>