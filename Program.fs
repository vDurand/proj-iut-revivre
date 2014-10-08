// Obtenez des informations sur F# via http://fsharp.net
// Voir le projet 'Didacticiel F#' pour obtenir de l'aide.

open System

[<EntryPoint>]
let main argv =
    let statV = 0
    let statJ = 0
    let statA = 0
    let statP = 0

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

    let function1()=
        let statV = 0
        let statJ = 0
        let statA = 0
        let statP = 0
        for i = 0 to 25 do
            let j =
                let rand = new Random()
                rand.Next(5)

            let num = i+1
            printfn "%d : %s ==> %s\n" num assignement.[i] guys.[j]
            let test1 = 
                if assignement.[i] = "ValentinD"
                then 
                    let statV = statV + 1
                    printfn ""

            let test2 = 
                if assignement.[i] = "JeremieLB"
                then 
                    let statJ = statJ + 1
                    printfn ""

            let test3 = 
                if assignement.[i] = "PierreF"
                then 
                    let statP = statP + 1
                    printfn ""

            let test4 = 
                if assignement.[i] = "AlexandreF"
                then 
                    let statA = statA + 1
                    printfn ""
            printfn ""
        printfn "\nValentin = %d\nPierre = %d\nAlexandre = %d\nJeremie = %d\n" statV statP statA statJ

    function1()
    0 // retourne du code de sortie entier
