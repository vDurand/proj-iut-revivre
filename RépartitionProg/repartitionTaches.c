#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include <string.h>

int main(void) {
	int i, j;
	int statV = 0;
	int statP = 0;
	int statA = 0;
	int statJ = 0;
	

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

	const char *guys[6];
	guys[0] = "Valentin D";
	guys[1] = "Alexandre F";
	guys[2] = "Pierre F";
	guys[3] = "Jeremie LB";
	guys[4] = "Valentin D";
	guys[5] = "Pierre F";

	srand(time(NULL));

	printf("-Repartition des taches random-\n\n");

	for(i=0; i<26; i++){
		j = rand()%(6);
		printf("%d : %s ==> %s\n",i+1,assignment[i], guys[j]);
		if (strcmp(guys[j], "Valentin D")==0){
			statV++;
		}
		if (strcmp(guys[j], "Jeremie LB")==0){
			statJ++;
		}
		if (strcmp(guys[j], "Pierre F")==0){
			statP++;
		}
		if (strcmp(guys[j], "Alexandre F")==0){
			statA++;
		}
	}
	printf("\nValentin = %d\nPierre = %d\nAlexandre = %d\nJeremie = %d\n", statV, statP, statA, statJ);
	return 0;
}