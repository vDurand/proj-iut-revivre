<?php
/**
 * Created by Valentin Durand
 * IUT Caen - DUT Informatique
 * Date: 23/01/15
 * Time: 09:05
 */
$pageTitle = "Crédit";
include('bandeau.php');
?>
    <div id="corps">
        <div id="labelT">
            <label>Change log</label>
        </div>
        <div style="padding-left: 20px;">
            <h2>v3.1</h2>
            <ul type="square">
                <li>gestion par entreprise des clients et fournisseurs</li>
                <li>insertion et détail des salariés en insertion</li>
            </ul>
            <br>
            <h2>v2.0</h2>
            <ul type="square">
                <li>module d'achat par bordereau de livraison sans produit</li>
            </ul>
            <br>
            <h2>v1.0</h2>
            <ul type="square">
                <li>table personne</li>
            </ul>
        </div>
    </div>
<?php
include('footer.php');
?>