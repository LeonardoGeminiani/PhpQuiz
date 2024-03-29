<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultati</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<?php 
include("function.php");
include("themeGetter.php"); 
?>
<body data-bs-theme="<?php 
    echo $THEME
?>">
    <?php
        // stampo l'header
        include("header.php");
    ?>

    <div class="container">
        <div class="d-flex flex-column-reverse">
            <div class="row" style="justify-content:center;">
                <?php

                session_start();
                
                $ris = $_SESSION["risposte"];
                $domande = $_SESSION["domande"];
                
                $risposteCorrette = 0;
                // scorro tutte le risposte per stamparle
                foreach ($ris as $i => $rispostaSelezionata) {
                    // i = id della domanda
                    // rispostaSelezionata = risposta che è stata selezionata nella domanda
                    $img = $domande[$i-1]['img'];
                    $rispostaGiusta = false;
                    $risposta = $domande[$i-1]['nome'];
                    // controllo se la risposta data corrisponde con la risposta giusta
                    if ($risposta == $rispostaSelezionata) {
                        $rispostaGiusta = true;
                        // la aggiungo alle risposte corrette
                        $risposteCorrette++;
                    }
                    
                    // stampo il numero della domanda e la sua immagine
                    echo <<<EOL
                    <div class="shadow my-card card col-md-4 m-2" style="max-width: 30rem;">
                        <div class="card-header">Domanda $i</div>
                        <div class="row g-0 my-bd">
                            <div class="col-md-4">
                                <img src="$img" class="img-fluid rounded-start img-i" alt="...">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body">
                    EOL;

                    // risposta giusta -> verde; risposta sbagliata -> rosso
                    if($rispostaGiusta){
                        echo <<<EOL
                        <h5 class="card-title text-success">Risposta Giusta</h5>
                        <p class="text-success">✔️ $risposta</p>
                        EOL;
                    } else {
                        echo <<<EOL
                        <h5 class="card-title text-danger">Risposta Errata</h5>
                        <p class="text-danger">❌ $rispostaSelezionata</p>
                        <p class="text-success">✔️ $risposta</p>
                        EOL;
                    }

                    echo <<<EOL
                                </div>
                            </div>
                        </div>
                    </div>
                    EOL;
                }
                
                ?>
            </div>

            <div class="text-center m-4">
                <h1>Punteggio: <?php echo $risposteCorrette; ?>/20</h1>
            </div>
        </div>
    </div>
    <div id="mainWrap"></div>
    <div id="main"></div>
</body>
</html>