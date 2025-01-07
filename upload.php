<?php
session_start();

include "./functions.php";

# inizializzo una variabile per la gestione degli errori
$_SESSION["messages"] = [];

# definiamo una directory dove spostare i file per l'upload
const MAIN_PATH = "./"; 
$targetDirectory = MAIN_PATH . "images/";

# controlliamo che la directory esista, se non esiste la crea
if(!is_dir($targetDirectory)) mkdir($targetDirectory, 0777, true);

# controlla se all'interno di $_FILES c'è qualcosa ed itera sui file
# altrimenti ridireziona direttamente al form con messaggio di errore
if(isset($_FILES["files"]) && count($_FILES["files"]["name"]) > 0){
    
    # iteriamo su ogni file presente nell'array
    for($i = 0; $i < count($_FILES["files"]["name"]); $i++){

        // recuperiamo info sul singolo file 
        $fileName = basename($_FILES["files"]["name"][$i]);
        $tmpFileName = $_FILES["files"]["tmp_name"][$i];
        $fileType = $_FILES["files"]["type"][$i];
        $fileSize = $_FILES["files"]["size"][$i];

        # impostiamo una variabile di uploadOK 1 = OK; 0 = Error
        $uploadOK = 1;

        # eseguiamo un controllo sul file size (ad esempio max 5Mb)
        if($_FILES["files"]["size"][$i] > 5000000){
            array_push($_SESSION["messages"], "File $fileName superiore a 5Mb"); 
            $uploadOK = 0;
        }

        # eseguiamo un controllo sul tipo del file da caricare (vogliamo solo immagini)
        $allowed_types = ["image/jpg", "image/jpeg", "image/png", "image/gif"];
        if(!in_array($_FILES["files"]["type"][$i], $allowed_types)){
            $errorMessage = "File $fileName non è un'immagine";
            array_push($_SESSION["messages"], $errorMessage);
            $uploadOK = 0;
        }

        # se non ci sono errori carica il file nella cartella images
        if($uploadOK){
            move_uploaded_file($tmpFileName, $targetDirectory. $fileName);
            array_push($_SESSION["messages"], "file $fileName caricato con successo");
        }else{
            # aggiungi un errore all'array messages
            array_push($_SESSION["messages"], "Errore upload files"); 
        }
 
    } // end for

    # reindirizza al form dopo iterazione sia che ci siano errori sia successo
    header("Location: /");
    exit();

# se non c'era nessun file da caricare nella variabile $_FILES:
}else{ 
    $_SESSION["message"] = "Non ci sono file da caricare";
    header("Location: /");
    exit();
}