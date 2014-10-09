// Obtenez des informations sur F# via http://fsharp.net
// Voir le projet 'Didacticiel F#' pour obtenir de l'aide.

open System

[<EntryPoint>]
let main argv =

    let assignement =
        [|
            "Liste personne"
            "Tri personne"
            "Detail personne"
            "Modif personne"
            "Ajout personne"
            "Liste chantier"
            "Detail chantier"
            "Modif cahntier"
            "Progress bar"
            "Ajout travail"
            "Modif etat"
            "Ajout achat"
            "Ajout produit"
            "Graph"
            "Ajout responsable"
            "Bandeau/Footer"
            "Home"
            "Rapport bug"
            "Maintenance"
            "MCD"
            "MLD"
            "DdD"
            "MySQL"
            "Use case"
            "vues SQL"
            "Importation donnees"
        |]

    let guys =
        [|
            "ValentinD"
            "AlexandreF"
            "PierreF"
            "JeremieLB"
            "ValentinD"
            "PierreF"
        |]    

    printfn "-Repartition des taches random-\n\n"

    let countV = ref 0
    let countJ = ref 0
    let countA = ref 0
    let countP = ref 0

    let function1()=
        for i = 0 to 25 do
            let j = (new System.Random()).Next(0, 5)

            let num = i+1
            printfn "%d : %s ==> %s\n" num assignement.[i] guys.[j]
            let test1 = 
                if String.Compare(guys.[j], "ValentinD") = 0
                then 
                    incr countV
                    printfn ""

            let test2 = 
                if guys.[j] = "JeremieLB"
                then 
                    incr countJ
                    printfn ""

            let test3 = 
                if guys.[j] = "PierreF"
                then 
                    incr countP
                    printfn ""

            let test4 = 
                if guys.[j] = "AlexandreF"
                then 
                    incr countA
                    printfn ""
            printfn ""
        printfn "\nValentin = %d\nPierre = %d\nAlexandre = %d\nJeremie = %d\n" !countV !countP !countA !countJ

    function1()
    0 // retourne du code de sortie entier
