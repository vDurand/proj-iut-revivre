using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ConsoleApplication2
{
    class Program
    {
        
        static void Main(string[] args)
        {
            int i;
            int statV = 0;
            int statP = 0;
            int statA = 0;
            int statJ = 0;
            int random;
            Random rand = new Random();


            string[] assignment = new string[26];
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

            string[] guys = new string[6];
            guys[0] = "Valentin D";
            guys[1] = "Alexandre F";
            guys[2] = "Pierre F";
            guys[3] = "Jeremie LB";
            guys[4] = "Valentin D";
            guys[5] = "Pierre F";


            Console.WriteLine("-Repartition des taches random-\n\n");

            for (i = 0; i < 26; i++)
            {
                random = rand.Next(6);
                Console.WriteLine("{0} : {1} ==> {2}\n", i + 1, assignment[i], guys[random]);
                if (string.Compare(guys[random], "Valentin D") == 0)
                {
                    statV++;
                }
                if (string.Compare(guys[random], "Jeremie LB") == 0)
                {
                    statJ++;
                }
                if (string.Compare(guys[random], "Pierre F") == 0)
                {
                    statP++;
                }
                if (string.Compare(guys[random], "Alexandre F") == 0)
                {
                    statA++;
                }
            }
            Console.WriteLine("\nValentin = {0}\nPierre = {1}\nAlexandre = {2}\nJeremie = {3}\n", statV, statP, statA, statJ);
            Console.WriteLine("Appuyez sur une touche pour continuer");
            Console.ReadLine();
        }
    }
}
