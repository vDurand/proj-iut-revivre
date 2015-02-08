<?php
$pwd='../';
include('../bandeau.php');
?>
    <div id="corps">
        <?php
        // Ajout personne en insertion
        $fonct = 0;
        $type = addslashes($_POST["Type"]);
        $dateEntretien = addslashes($_POST["Entretien"]);
        $nom = addslashes(mysqli_real_escape_string($db, formatUP($_POST["Nom"])));
        $prenom = addslashes(mysqli_real_escape_string($db, formatLOW($_POST["Prenom"])));
        $dateN = addslashes($_POST["DateNai"]);
        $nation = addslashes(mysqli_real_escape_string($db, formatUP($_POST["Nationalite"])));
        $lieuN = addslashes(mysqli_real_escape_string($db, formatUP($_POST["LieuNai"])));
        $situationF = addslashes(mysqli_real_escape_string($db, formatUP($_POST["Situation"])));
        $tel = addslashes(mysqli_real_escape_string($db, $_POST["Tel_Fixe"]));
        $port = addslashes(mysqli_real_escape_string($db, $_POST["Portable"]));
        $fax = addslashes(mysqli_real_escape_string($db, $_POST["Fax"]));
        $email = addslashes(mysqli_real_escape_string($db, $_POST["Email"]));
        $add = addslashes(mysqli_real_escape_string($db, formatLOW($_POST["Adresse"])));
        $cp = addslashes($_POST["Code_Postal"]);
        $ville = addslashes(mysqli_real_escape_string($db, formatUP($_POST["Ville"])));
        $nPoleEmploi = addslashes($_POST["N_Pole"]);
        $nSecu = addslashes($_POST["N_Secu"]);
        $nCaf = addslashes($_POST["N_CAF"]);
        $numRef = addslashes($_POST["Ref"]);
        $convention = addslashes($_POST["Convention"]);
        $nbJours = addslashes($_POST["Jours"]);
        $dateEntree = addslashes($_POST["Entree"]);
        $contrat = addslashes($_POST["Contrat"]);
        $nbHeures = addslashes($_POST["N_Heures"]);
        $nivScol = addslashes($_POST["Niveau"]);
        $recoTH = addslashes($_POST["Reconnaissance"]);
        $diplome = addslashes($_POST["Diplome"]);
        $permis = addslashes($_POST["Permis"]);
        $revenu = addslashes($_POST["Revenus-Type"]);
        $PEDepuis = addslashes($_POST["Inscrit-Pole"]);
        $positionement = addslashes($_POST["CAP"]);
        $situGeo = addslashes($_POST["Situation-Geo"]);
        $revenuDepuis = addslashes($_POST["Revenus-Durée"]);
        $SEDepuis = addslashes($_POST["Sans-Emploi"]);
        $mutuelle = addslashes($_POST["Mutuelle"]);
        $repas = addslashes($_POST["Repas"]);

        $queryPerMax = mysqli_query($db, "SELECT MAX(PER_Num) as maxi FROM Personnes");
        $resultPerMax = mysqli_fetch_assoc($queryPerMax);
        $perMax = $resultPerMax['maxi'] + 1;

        $insertPersonne = "INSERT INTO Personnes (PER_Num, PER_Nom, PER_Prenom, PER_TelFixe, PER_TelPort, PER_Fax, PER_Email, PER_Adresse, PER_CodePostal, PER_Ville)
                           VALUES ($perMax, '$nom', '$prenom', '$tel', '$port', '$fax', '$email', '$add', '$cp', '$ville')";
        $sql2 = mysqli_query($db, $insertPersonne);
        $errr2 = mysqli_error($db);

        if ($sql2) {
            $querySalMax = mysqli_query($db, "SELECT MAX(SAL_NumSalarie) as maxi FROM Salaries");
            $resultSalMax = mysqli_fetch_assoc($querySalMax);
            $salMax = $resultSalMax['maxi'] + 1;

            $insertSal = "INSERT INTO Salaries (SAL_NumSalarie, PER_Num, FCT_Id, TYP_Id) VALUES ($salMax, $perMax, '$fonct', '$type')";
            $sql = mysqli_query($db, $insertSal);
            $errr = mysqli_error($db);

            if ($sql) {
                $insertIns = "INSERT INTO Insertion(SAL_NumSalarie, INS_DateEntretien, INS_DateN, INS_LieuN, INS_Nation, INS_SituationF, INS_NPoleEmp, INS_NSecu,
                INS_NCaf, INS_NivScol, INS_Diplome, INS_Permis, INS_RecoTH, INS_Revenu, INS_Mutuelle, CNV_Id, CNT_Id, INS_DateEntree, INS_NbHeures, INS_NbJours,
                INS_RevenuDepuis, INS_SEDepuis, INS_PEDupuis, INS_Repas, INS_Positionmt, INS_SituGeo, REF_NumRef, TYS_ID)
                VALUES ($salMax, '$dateEntretien', '$dateN', '$lieuN', '$nation', '$situationF', '$nPoleEmploi', '$nSecu', '$nCaf', '$nivScol', '$diplome', '$permis', '$recoTH',
                '$revenu', '$mutuelle', '$convention', '$contrat', '$dateEntree', '$nbHeures', '$nbJours', '$revenuDepuis', '$SEDepuis', '$PEDepuis', '$repas', '$positionement', '$situGeo', '$numRef', '0')";
                $sql3 = mysqli_query($db, $insertIns);
                $errr = mysqli_error($db);
            }
        }

        if ($sql3) {
            echo '<div id="good">
        <label>Ajout Réussi</label>
        </div>';
        } else {
            echo '<div id="bad">
          <label>Le Salarié n\'a pas pu être ajouté</label>
          </div>';
        }
        ?>
    </div>
<?php
include('../footer.php');
?>