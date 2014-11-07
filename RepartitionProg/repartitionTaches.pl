#!/usr/bin/env perl

my $j;
my $statV = 0;
my $statP = 0;
my $statA = 0;
my $statJ = 0;

@assignment = (
	"Liste personne", 
	"Tri personne", 
	"Detail personne", 
	"Modif personne", 
	"Ajout personne",
	"Liste chantier",
	"Detail chantier",
	"Modif cahntier",
	"Progress bar",
	"Ajout travail",
	"Modif etat",
	"Ajout achat",
	"Ajout produit",
	"Graph",
	"Ajout responsable",
	"Bandeau/Footer",
	"Home",
	"Rapport bug",
	"Maintenance",
	"MCD",
	"MLD",
	"DdD",
	"MySQL",
	"Use case",
	"vues SQL",
	"Importation donnees"
	);

@guys;
$guys[0] = "Valentin D";
$guys[1] = "Alexandre F";
$guys[2] = "Pierre F";
$guys[3] = "Jeremie LB";
$guys[4] = "Valentin D";
$guys[5] = "Pierre F";

print"-Repartition des taches random-\n\n";

for(my $i=0; $i<26; $i++){
	$j = int(rand(6));
	printf("%d : $assignment[$i] ==> $guys[$j]\n", $i+1);
	if ($guys[$j] eq "Valentin D"){
		$statV++;
	}
	if ($guys[$j] eq "Jeremie LB"){
		$statJ++;
	}
	if ($guys[$j] eq "Pierre F"){
		$statP++;
	}
	if ($guys[$j] eq "Alexandre F"){
		$statA++;
	}
}
printf("\nValentin = %d\nPierre = %d\nAlexandre = %d\nJeremie = %d\n", $statV, $statP, $statA, $statJ);
