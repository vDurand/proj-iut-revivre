<?php
$pageTitle = "Login Revivre";
	include('bandeau.php');
	if(isset($_POST['logout'])){
	    session_destroy();
	    header("Location: login.php");
	}
	
	$id = postGetter("id");
	$pw = postGetter("pw");
	?>
	<div id="corps">
		<div id="labelT">     
	        <label>Identification</label>
		</div>
		<br/>
		<?php
	if ($id != null && $pw != null) {
	    if ($id == "revivre" && $pw == "projetIUT201415") {
		    $_SESSION["user"] = "revivre";
		    echo '<div id="good">     
		        <label>Id Correct</label>
		        </div>';
	        
	        echo '<script language="Javascript">
	        <!--
	        document.location.replace("home.php");
	        // -->
	        </script>';
	        
	    }
        else if ($id == "admin" && $pw == "projetRevivre") {
            $_SESSION["user"] = "admin";
            echo '<div id="good">
		        <label>Id Correct</label>
		        </div>';

            echo '<script language="Javascript">
	        <!--
	        document.location.replace("home.php");
	        // -->
	        </script>';

        }
        else {
	        echo '<div id="bad">     
	              <label>Id incorrect</label>
	              </div>';
	    }
	}
	?>
	<form action="login.php" method="post">
	    <table align="center">
	        <tr>
	            <th style="padding-top: 30px; text-align: left; width: 150px;">Identifiant : </th>
	            <td style="padding-top: 30px;"><input value="revivre" class="inputC" required type="text" name="id"></td>
	        </tr>
	        <tr>
	            <th style="text-align: left; width: 150px;">Mot de Passe : </th>
	            <td><input class="inputC" required value="projetIUT201415" type="password" name="pw"></td>
	        </tr>
	        <tr>
	            <th style="padding-top: 20px; text-align: center;"><input autofocus class="buttonC" name="submit" type="submit" value="Valider"></th>
	            <td style="padding-top: 20px; text-align: center;"><input class="buttonC" name="reset" type="reset" value="Annuler"></td>
	        </tr>
	    </table>
	</form>
			</div>
	<?php  
		include('footer.php');
	?>