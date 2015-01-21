<?php
/**
 * Created by Valentin Durand
 * IUT Caen - DUT Informatique
 * Date: 21/01/15
 * Time: 19:51
 */
$pageTitle = "Ajouter Employé";
include('bandeau.php');
if(!empty($_POST['NumC'])){
    $typeEntreprise = "client";
    $num = $_POST['NumC'];
    $queryEnt = "SELECT CLI_Nom FROM Clients WHERE CLI_NumClient = $num";
    $repEnt = mysqli_query($db, $queryEnt);
    $dataEnt = mysqli_fetch_assoc($repEnt);
    $nom = $dataEnt['CLI_Nom'];
    echo "<input name=\"NumC\" value=\"".$num."\" type=\"hidden\" form=\"Employe\">";
}
else if(!empty($_POST['NumF'])){
    $typeEntreprise = "fournisseur";
    $num = $_POST['NumF'];
    $queryEnt = "SELECT FOU_Nom FROM Fournisseurs WHERE FOU_NumFournisseur = $num";
    $repEnt = mysqli_query($db, $queryEnt);
    $dataEnt = mysqli_fetch_assoc($repEnt);
    $nom = $dataEnt['FOU_Nom'];
    echo "<input name=\"NumF\" value=\"".$num."\" type=\"hidden\" form=\"Employe\">";
}
else{
    echo "ERROR";
}
?>
    <div id="corps">
        <div id="labelT">
            <label>Ajouter un employé du <?php echo $typeEntreprise." ".$nom; ?></label>
        </div>
        <br>
        <form method="post" action="employePost.php" id="Employe" name="Employe">
            <div style="overflow:auto;">
                <table align="left">
                    <tr>
                        <td style="vertical-align:top;">
                            <table id="leftT" cellpadding="10">
                                <tr id="Contact-Nom">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Nom">Nom* :</label>
                                    </td>
                                    <td>
                                        <input id="Nom" required maxlength="255" name="Nom" type="text" class="inputC"
                                               autofocus="autofocus">
                                    </td>
                                </tr>
                                <tr id="Contact-Prenom">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Prenom">Prénom* :</label>
                                    </td>
                                    <td>
                                        <input id="Prenom" required maxlength="255" name="Prenom" type="text" class="inputC">
                                    </td>

                                </tr>
                                <tr id="Contact-Tel_Fixe">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Tel_Fixe">Téléphone Fixe :</label>
                                    </td>
                                    <td>
                                        <input id="Tel_Fixe" maxlength="255" name="Tel_Fixe" type="text" class="inputC">
                                    </td>
                                </tr>
                                <tr id="Contact-Portable">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Portable">Téléphone Portable :</label>
                                    </td>
                                    <td>
                                        <input id="Portable" maxlength="255" name="Portable" type="text" class="inputC">
                                    </td>
                                </tr>
                                <tr id="Contact-Fax">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Fax">Fax :</label>
                                    </td>
                                    <td>
                                        <input id="Fax" maxlength="255" name="Fax" type="text" class="inputC">
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="vertical-align:top;">
                            <table id="rightT" cellpadding="10">
                                <tr id="Contact-Email">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Email">Email :</label>
                                    </td>
                                    <td>
                                        <input id="Email" maxlength="255" name="Email" type="text" class="inputC"
                                               title="exemple@exemple.com"
                                               pattern="^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-z]{2,3}$">
                                    </td>
                                </tr>
                                <tr id="Contact-Adresse">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Adresse">Adresse* :</label>
                                    </td>
                                    <td>
                                        <input id="Adresse" required maxlength="255" name="Adresse" type="text"
                                               class="inputC">
                                    </td>
                                </tr>
                                <tr id="Contact-Code_Postal">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Code_Postal">Code Postal* :</label>
                                    </td>
                                    <td>
                                        <input id="Code_Postal" required name="Code_Postal" pattern="^\d{5}$"
                                               type="text" title="" style="width:100px;background-color:#cde5f7;"
                                               maxlength="5">
                                    </td>
                                </tr>
                                <tr id="Contact-Ville">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Ville">Ville* :</label>
                                    </td>
                                    <td>
                                        <input id="Ville" required maxlength="255" name="Ville" type="text"
                                               class="inputC">
                                    </td>
                                </tr>
                                <tr id="Contact-Fonction">
                                    <td style="text-align: left; width: 150px; white-space: normal;">
                                        <label for="Struct">Fonction :</label>
                                    </td>
                                    <td>
                                        <input id="Fonction" maxlength="255" name="Fonction" type="text"
                                               class="inputC">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <table id="downT">
                <tr>
                    <td>
							<span>
								<input name="submit" type="submit" value="Ajouter" class="buttonC">&nbsp;&nbsp;
								<input name="reset" type="reset" value="Annuler" class="buttonC">
							</span>
                    </td>
                </tr>
            </table>
            <br/><br/>
            * : Champs obligatoires.
        </form>
    </div>
<?php
include('footer.php');
?>