<?php
/**
 * Created by Valentin Durand
 * IUT Caen - DUT Informatique
 * Date: 21/01/15
 * Time: 20:47
 */
$pwd='../';
include('../bandeau.php');
?>
    <div id="corps">
        <?php
        $nom=addslashes(mysqli_real_escape_string($db, formatUP($_POST["Nom"])));
        $prenom=addslashes(mysqli_real_escape_string($db, formatLOW($_POST["Prenom"])));
        $tel=addslashes(mysqli_real_escape_string($db, $_POST["Tel_Fixe"]));
        $port=addslashes(mysqli_real_escape_string($db, $_POST["Portable"]));
        $fax=addslashes(mysqli_real_escape_string($db, $_POST["Fax"]));
        $email=addslashes(mysqli_real_escape_string($db, $_POST["Email"]));
        $add=addslashes(mysqli_real_escape_string($db, formatLOW($_POST["Adresse"])));
        $cp=addslashes($_POST["Code_Postal"]);
        $ville=addslashes(mysqli_real_escape_string($db, formatUP($_POST["Ville"])));
        $fct=addslashes(mysqli_real_escape_string($db, formatLOW($_POST["Fonction"])));

        $queryPerMax = mysqli_query($db, "SELECT MAX(PER_Num) as maxi FROM Personnes");
        $resultPerMax = mysqli_fetch_assoc($queryPerMax);
        $perMax = $resultPerMax['maxi']+1;

        // ajout employe client
        if(!empty($_POST["NumC"])){
            $cliNum = $_POST["NumC"];
            $insertPersonne = "INSERT INTO Personnes (PER_Num, PER_Nom, PER_Prenom, PER_TelFixe, PER_TelPort, PER_Fax, PER_Email, PER_Adresse, PER_CodePostal, PER_Ville) VALUES ($perMax, '$nom', '$prenom', '$tel', '$port', '$fax', '$email', '$add', '$cp', '$ville')";
            $sql = mysqli_query($db, $insertPersonne);
            $err = mysqli_error($db);

            if($sql){
                $insertClient = "INSERT INTO EmployerClient (CLI_NumClient, PER_Num, EMC_Fonction) VALUES ($cliNum, $perMax, '$fct')";
                $sql2 = mysqli_query($db, $insertClient);
                $err2 = mysqli_error($db);
                if($sql2){
                    echo '<div id="good">
                    <label>Employe client ajouté avec succès</label>
                    </div>';
                    echo '<script language="Javascript">
                    <!--
                    document.location.replace("detailEmployeC.php?NumC='.$perMax.'");
                    // -->
                    </script>';
                }
            }
            else{
                echo '<div id="bad">
                  <label>L\'employé client n\'a pas pu être ajouté</label>
                  </div>';
            }
        }
        // ajout employe fournisseur
        else if(!empty($_POST["NumF"])){
            $fouNum = $_POST["NumF"];
            $insertPersonne = "INSERT INTO Personnes (PER_Num, PER_Nom, PER_Prenom, PER_TelFixe, PER_TelPort, PER_Fax, PER_Email, PER_Adresse, PER_CodePostal, PER_Ville) VALUES ($perMax, '$nom', '$prenom', '$tel', '$port', '$fax', '$email', '$add', '$cp', '$ville')";
            $sql = mysqli_query($db, $insertPersonne);
            $err = mysqli_error($db);

            if($sql){
                $insertFourn = "INSERT INTO EmployerFourn (FOU_NumFournisseur, PER_Num, EMF_Fonction) VALUES ($fouNum, $perMax, '$fct')";
                $sql2 = mysqli_query($db, $insertFourn);
                $err2 = mysqli_error($db);
                if($sql2){
                    echo '<div id="good">
                    <label>Employe fournisseur ajouté avec succès</label>
                    </div>';
                    echo '<script language="Javascript">
                    <!--
                    document.location.replace("detailEmployeF.php?NumC='.$perMax.'");
                    // -->
                    </script>';
                }
            }
            else{
                echo '<div id="bad">
                  <label>L\'employé fournisseur n\'a pas pu être ajouté</label>
                  </div>';
            }
        }
        else{
            echo '<div id="bad">
          <label>L\'employé n\'a pas pu être ajouté</label>
          </div>';
        }
        ?>
    </div>
<?php
include('../footer.php');
?>