/**
 * @Author Valentin Durand - DUT Informatique - IUT Ifs
 * @Project Repartition
 * @Package 
 * @Class Repartition
 * @ Oct 8, 2014 8:08:49 PM
 */

public class Repartition {
		private static String [] assignment;
		private static String [] guys;
	
	/**
	 * @param args
	 */
	public static void main(String[] args) {
		int statV = 0;
		int statP = 0;
		int statA = 0;
		int statJ = 0;
		
		int j;
		
		assignment = new String[26];
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
		
		guys = new String[6];
		guys[0] = "Valentin D";
		guys[1] = "Alexandre F";
		guys[2] = "Pierre F";
		guys[3] = "Jeremie LB";
		guys[4] = "Valentin D";
		guys[5] = "Pierre F";

		System.out.println("-Repartition des taches random-\n\n");

		for(int i=0; i<assignment.length; i++){
			j = (int)(Math.random()*(5));
			System.out.println(i+1+ " : "+assignment[i]+" ==> "+guys[j]);
			if (guys[j].equals("Valentin D")){
				statV++;
			}
			if (guys[j].equals("Jeremie LB")){
				statJ++;
			}
			if (guys[j].equals("Pierre F")){
				statP++;
			}
			if (guys[j].equals("Alexandre F")){
				statA++;
			}
		}
		System.out.println("\nValentin = "+statV+"\nPierre = "+statP+"\nAlexandre = "+statA+"\nJeremie = "+statJ);

	}

}
