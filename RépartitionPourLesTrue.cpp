// ConsoleApplication2.cpp: definit le point d'entree pour l'application console.
//

#include "stdafx.h"
#include <stdio.h>
#include <stdlib.h>
#include <time.h>


int _tmain(int argc, _TCHAR* argv[])
{
	int i, j;

	const char *assignment[26];
	assignment[0] = "Liste personne";
	assignment[1] = "Tri personne";
	assignment[2] = "Detail personne";
	assignment[3] = "Modif personne";
	assignment[4] = "Ajout personne";
	assignment[5] = "Liste chantier";
	assignment[6] = "Detail chantier";
	assignment[7] = "Modif cahntier";
	assignment[8] = "Progress bar";
	assignment[9] = "Ajout travail";
	assignment[10] = "Modif etat";
	assignment[11] = "Ajout achat";
	assignment[12] = "Ajout produit";
	assignment[13] = "Graph";
	assignment[14] = "Ajout responsable";
	assignment[15] = "Bandeau/Footer";
	assignment[16] = "Home";
	assignment[17] = "Rapport bug";
	assignment[18] = "Maintenance";
	assignment[19] = "MCD";
	assignment[20] = "MLD";
	assignment[21] = "DdD";
	assignment[22] = "MySQL";
	assignment[23] = "Use case";
	assignment[24] = "vues SQL";
	assignment[25] = "Importation donnees";

	const char *guys[4];
	guys[0] = "Valentin D";
	guys[1] = "Alexandre F";
	guys[2] = "Pierre F";
	guys[3] = "Jeremie LB";

	srand(time(NULL));

	printf("-Repartition des taches random-\n\n");

	for (i = 0; i<26; i++){
		j = rand() % (4);
		printf("%d : %s ==> %s\n", i + 1, assignment[i], guys[j]);
	}
	printf("\n");
	return 0;
}

