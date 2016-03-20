<?php
	$pageTitle = "Propriétés des logos";
	$pwd='../';
	include($pwd."bandeau.php");
    
    if(isset($_POST["select_logo"]))
    {
        $numero_logo = $_POST["select_logo"];
    }
    else
    {
        $numero_logo = 0;
    }

    if(isset($_POST["typeAction"]))
    {
        $typeAction=$_POST["typeAction"];
    }
    else
    {
        $typeAction="read";
    }
	$arrayElements = Array();
?>
<div id="corps">
    <div id="labelT">     
        <label>Gestion des logo de plannings</label>
   	</div>
    <br/>
    <div style="width:100%; max-width:100%; height:175px; background-color:white; box-shadow:1px 1px 3px #555;">
        <form method="POST" name="gest_logo" id="gest_logo" enctype="multipart/form-data">
            <table style="padding:10px 10px 0px 10px; margin:auto;">
                <tr>
                    <td>
                        <select name="select_logo" id="select_logo" onchange="document.getElementById('typeAction').value='read';this.form.submit();" style="width:156px; height:25px;" <?php if($typeAction=="edit" || $typeAction=="add")echo "disabled"; ?>>
                            <option <?php if($numero_logo==0) echo "selected"; ?>value="0">Choisissez un logo...</option>
                            <?php
                                $query = mysqli_query($db, "SELECT LOGO_Id, LOGO_Libelle, LOGO_Url FROM logo ORDER BY LOGO_Libelle;");
                                $x=0;
                                while($data = mysqli_fetch_assoc($query))
                                {
                                    if($numero_logo == ($x+1)){$nomLogo = $data["LOGO_Libelle"];}
                            ?>  
                                    <option <?php if($numero_logo == ($x+1)){echo "selected";}?> value="<?php echo ($x+1);?>"><?php echo $data["LOGO_Libelle"]; ?></option>
                            <?php
                                    $arrayElements[$x++] = Array($data["LOGO_Libelle"], $data["LOGO_Url"], $data["LOGO_Id"]);
                                }
                                mysqli_free_result($query);
                            ?>
                        </select>
                    </td>
                    <td style="text-align:right;">
                        <input name="addLogo" id="addLogo" type="button" value="Ajouter" onclick="addNewLogo()" class="buttonNormal" <?php if($typeAction=="edit" || $typeAction=="add")echo "disabled"; ?>>
                        <input name="editLogo" id="editLogo" type="button" value="Modifier" onclick="editCurrentLogo()" class="buttonNormal" <?php if($numero_logo<=0 || $typeAction=="add" || $typeAction=="edit")echo "disabled"; ?>>
                        <input name="delLogo" id="delLogo" type="button" value="Supprimer" onclick="deleteLogo()" class="buttonNormal" <?php if($numero_logo<=0 || $typeAction=="add" || $typeAction=="edit")echo "disabled"; ?>>
                    </td>
                </tr>
                <tr>
                  <td colspan="2"><hr style="margin:0; padding:0; margin:7px 0px; width:100%;"/></td>  
                </tr>
                <tr>    
                    <?php
                        if($typeAction == "edit")
                        {
                            echo '<td rowspan="3" style="text-align:center;"><div class="logoContainer">
                            <label class="logoTagEdit" for="fileInput"></label>
                            <input id="fileInput" name="fileInput" type="file" accept="image/png, image/jpeg" />';
                            $query = mysqli_query($db, "SELECT LOGO_Url FROM logo WHERE LOGO_Libelle='$nomLogo';");
                            while($data = mysqli_fetch_assoc($query))
                            {
                                echo '<img id="imgLogo" src="'.$data['LOGO_Url']."?cacheid=".rand(1, 500).'"/>';
                            }
                            echo '</div></td>';
                        }
                        elseif($typeAction == "add")
                        {
                            echo '<td rowspan="3" style="text-align:center;"><div class="logoContainer">
                            <label class="logoTagEdit" for="fileInput"></label>
                            <input type="file" id="fileInput" name="fileInput" accept="image/png, image/jpeg" />';
                            echo '<img id="imgLogo" src=""/>';
                            echo '</div></td>';
                        }
                        elseif($numero_logo > 0)
                        {
                            $query = mysqli_query($db, "SELECT LOGO_Url FROM logo WHERE LOGO_Libelle='$nomLogo';");
                            while($data = mysqli_fetch_assoc($query))
                            {
                                echo '<td rowspan="3" style="text-align:center;"><img id="imgLogo" src="'.$data['LOGO_Url'].'" style="border: 3px solid lightgrey; margin:0px 10px 0px 0px;"/></td>';
                            }
                        }
                        else
                        {
                            echo '<td rowspan="3" style="width:166px;"></td>';   
                        }

                        if($typeAction != "read")
                        {
                            echo '<td style="width:350px; padding:0;">Nom : <input type="text" name="nomLogo" id="nomLogo" required="required" style="width:85%; margin:0 0 0 1px;" placeholder="Nom du logo" onkeyup="activeValidButton();"></td>';
                        }
                        elseif($numero_logo > 0)
                        {
                            echo '<td style="width:350px; padding:0;">Logo : <input type="text" name="nomLogo" id="nomLogo" style="border:none; font-size:16px; width:85%; margin:0 0 0 1px;" readonly="readonly"></td>';
                        }
                        else
                        {
                           echo '<td style="width:350px;"></td>'; 
                        }
                    ?>
                </tr>
                <tr>
                    <?php 
                        if($typeAction != "read")
                            echo '<td id="uploadValidMessage" style="font-style:italic; font-size:12px;">Cliquez sur l\'image pour ajouter un logo (100px*60px)</td>';
                    ?>
                </tr>
                <tr>
                    <td style="width:300px; text-align:center;">
                        <?php 
                            if($typeAction != "read")
                            {
                                echo '<input name="cancelLogo" id="cancelLogo" type="button" value="Annuler" style="width:100px;" onclick="cancelEnvoi()" class="printButton">  ';
                                echo '<input name="validLogo" id="validLogo" type="button" value="Valider" style="width:100px;" onclick="validerEnvoi()" class="printButton" disabled="disabled">';
                            }
                        ?>
                        <input type='hidden' id="Tableau" name='Tableau'>
                        <input type='hidden' id="typeAction" name='typeAction'>
                        <input type='hidden' id="idLogo" name='idLogo'>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<script type="text/javascript">
    <?php
		$js_array = json_encode($arrayElements);
		echo "var tableauElements = ".$js_array.";";
	?>
    var finalUrl="";
    
    if(document.getElementById("select_logo").selectedIndex > 0 && ("<?php echo $typeAction;?>" == "edit" || "<?php echo $typeAction;?>" == "read"))
    {
        document.getElementById("nomLogo").value = document.getElementById("select_logo").options[document.getElementById("select_logo").selectedIndex].text;
    }

    function deleteLogo()
    {
        if(confirm('Êtes-vous sûr de vouloir supprimer ce logo ?'))
        {
            document.getElementById('idLogo').value = tableauElements[parseInt(document.getElementById("select_logo").selectedIndex)-1][2];
            document.getElementById('typeAction').value = "delete";
            document.getElementById("gest_logo").action = "./logoPost.php";
		    document.getElementById("gest_logo").submit();
        }
    }
    
    function addNewLogo()
    {
        document.getElementById("typeAction").value="add";
        document.getElementById("gest_logo").submit();
    }
    
    function editCurrentLogo()
    {
        document.getElementById("typeAction").value="edit";
        document.getElementById("gest_logo").submit();
    }
    
    function activeValidButton()
    {
        document.getElementById("validLogo").disabled = "";
    }
    
    function readImage(file) 
    {
        var reader = new FileReader();
        var image  = new Image();

        reader.readAsDataURL(file);  
        reader.onload = function(_file)
        {
            image.src = _file.target.result;
            image.onload = function()
            {
                var w = this.width;
                var h = this.height;
                    
                if(w <= 100 && h <= 60)
                {
                    document.getElementById('uploadValidMessage').style.fontWeight="bold";
                    document.getElementById('uploadValidMessage').style.color="green";
                    document.getElementById('uploadValidMessage').style.fontStyle="";
                    document.getElementById('uploadValidMessage').style.fontSize="14px";
                    document.getElementById('uploadValidMessage').innerHTML="Logo valide.";
                    finalUrl = "../images/logo_upload/"+file.name;
                    document.getElementById('imgLogo').src=this.src;
                    activeValidButton();
                }
                else
                {
                    document.getElementById('uploadValidMessage').style.fontWeight="bold";
                    document.getElementById('uploadValidMessage').style.color="red";
                    document.getElementById('uploadValidMessage').style.fontStyle="";
                    document.getElementById('uploadValidMessage').style.fontSize="12px";
                    document.getElementById('uploadValidMessage').innerHTML="Logo invalide. Les dimensions doivent être de 100px*60px";
                }
            };

            image.onerror= function()
            {
                alert('Fichier de type invalide : '+ file.type);
            };      
        };
    }
    
    $("#fileInput").change(function (e)
    {
        if(this.disabled) return alert('Fichier non supporté !');
        var F = this.files;
        if(F && F[0]) for(var i=0; i<F.length; i++) readImage( F[i] );
    });
    
    function cancelEnvoi()
    {
        document.getElementById("typeAction").value="read";
        document.getElementById("gest_logo").submit();
    }
    
    function validerEnvoi()
    {
        if(document.getElementById('nomLogo').value != "")
        {
            var error = false;
            for(var x=0; x<(document.getElementById('select_logo').options).length; x++)
            {
                if(document.getElementById('select_logo').options[x].text == document.getElementById('nomLogo').value && "<?php echo $typeAction;?>" == "add" || (document.getElementById('select_logo').selectedIndex != x 
                    && document.getElementById('select_logo').options[x].text == document.getElementById('nomLogo').value && "<?php echo $typeAction;?>" == "edit"))
                {
                    error = true;
                    break;
                }
            }
            if(!error)
            {
                if(("<?php echo $typeAction;?>" == "add" && finalUrl != "") || "<?php echo $typeAction;?>" == "edit")
                {
                    <?php
                    if($typeAction == "add")
                    {
                        echo "var ligneAjout = new Array(document.getElementById('nomLogo').value);
                            document.getElementById('Tableau').value = JSON.stringify(ligneAjout);
                            document.getElementById('typeAction').value='add';";
                            
                    }
                    else
                    {
                        echo "if(finalUrl != \"\")
                            {
                                var ligneModif = [document.getElementById('nomLogo').value, tableauElements[".($numero_logo-1)."][1],tableauElements[".($numero_logo-1)."][2],true]; 
                            }
                            else
                            {
                                var ligneModif = tableauElements[".($numero_logo-1)."];
                                ligneModif[0] = document.getElementById('nomLogo').value;
                                ligneModif[3] = false;
                            }
                            document.getElementById('Tableau').value = JSON.stringify(ligneModif);
                            document.getElementById('typeAction').value='edit';";
                    }
                ?>
                document.getElementById("gest_logo").action = "./logoPost.php";
                document.getElementById("gest_logo").submit();
                }
                else
                {
                    alert("Veuillez ajouter un logo.");
                }
            }
            else
            {
                alert("Le nom existe déjà pour un autre logo.");
            }
        }
        else
        {
            alert("Veuillez remplir le champ nom.");  
        }
    }
</script>
<?php
	include($pwd."footer.php");
?>