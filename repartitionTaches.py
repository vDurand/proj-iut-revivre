from random import randint

j=0
statV = 0
statP = 0
statA = 0
statJ = 0

assignment = []
assignment.append("Liste personne")
assignment.append("Tri personne")
assignment.append("Detail personne")
assignment.append("Modif personne")
assignment.append("Ajout personne")
assignment.append("Liste chantier")
assignment.append("Detail chantier")
assignment.append("Modif cahntier")
assignment.append("Progress bar")
assignment.append("Ajout travail")
assignment.append("Modif etat")
assignment.append("Ajout achat")
assignment.append("Ajout produit")
assignment.append("Graph")
assignment.append("Ajout responsable")
assignment.append("Bandeau/Footer")
assignment.append("Home")
assignment.append("Rapport bug")
assignment.append("Maintenance")
assignment.append("MCD")
assignment.append("MLD")
assignment.append("DdD")
assignment.append("MySQL")
assignment.append("Use case")
assignment.append("vues SQL")
assignment.append("Importation donnees")

guys = []
guys.append("Valentin D")
guys.append("Alexandre F")
guys.append("Pierre F")
guys.append("Jeremie LB")
guys.append("Valentin D")
guys.append("Pierre F")

print("-Repartition des taches random-\n\n")

for i in range(26):
    j = randint(0, 5)
    print i+1," : ",assignment[i]," ==> ",guys[j];
    if (guys[j]==("Valentin D")):
        statV += 1
    if (guys[j]==("Jeremie LB")):
        statJ += 1
    if (guys[j]==("Pierre F")):
        statP += 1
    if (guys[j]==("Alexandre F")):
        statA += 1

print "\nValentin = ",statV,"\nPierre = ",statP,"\nAlexandre = ",statA,"\nJeremie = ",statJ,"\n"