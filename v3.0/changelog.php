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
            <h2>v3.2</h2>
            <ul type="square">
                <li>recherche sur le répertoire</li>
                <li>édition des temps de travail et achats</li>
                <li>type encadrant en responsable uniquement</li>
                <li>liste type d'achat</li>
                <li>popup impression de chantier non fini</li>
                <li>temps de travail en heure/minute</li>
                <li>durée des sessions augmentée</li>
            </ul>
            <br>
            <h2>v3.1</h2>
            <ul type="square">
                <li>détail des salarié en insertion, stagiaire et atelier occupationnel</li>
                <li>onglet partenaires</li>
                <li>référents déplacés dans partenaires</li>
                <li>liste des employés dans le détail des structures client et fournisseur</li>
            </ul>
            <br>
            <h2>v3.0</h2>
            <ul type="square">
                <li>refonte de la base de données</li>
                <li>gestion des clients et fournisseurs par structure/employés</li>
                <li>formulaire d'ajout de salarié en insertion, stagiaire et atelier occupationnel</li>
                <li>mise à jour du traitement php avec la nouvelle base</li>
            </ul>
            <br><h2>v2.9</h2>
            <ul type="square">
                <li>liste des chantiers dans le détail des clients</li>
                <li>liste des achats dans le détail des fournisseurs</li>
            </ul>
            <br>
            <h2>v2.8</h2>
            <ul type="square">
                <li>module d'achat par bordereau de livraison sans produit</li>
            </ul>
        </div>
    </div>
<?php
include('footer.php');
?>