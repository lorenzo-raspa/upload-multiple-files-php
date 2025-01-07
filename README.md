*** Upload di più file ***

In questo programma gestiremo l'upload di più file, andando a studiare le proprietà della variabile $_FILES e gestendo: 
- controllo sul tipo di file (selezioniamo solo immagini), 
- controllo sulla dimensione massima dei file.
- controlli sugli errori e visualizzazione tramite sessioni 

PS: non ho inserito alcuna formattazione di proposito, per tenere il codice più snello e leggibile possibile

-----------------------------------------------------------------------------------------
Qui sotto alcuni dettagli sull'array $_FILES

In $_FILES abbiamo questa struttura:
un array generale $_FILES -> che contiene un array di "files" (nome preso dall'attributo name del tag input file del form)

all'interno dell'array "files[]" avremo le seguenti props relative ad ogni file caricato:

- name: nome del file da caricare (scelto dall'utente)

- full_path: rappresenta il percorso completo originale del file selezionato nel file system dell'utente, che per motivi di privacy non viene esposto, tant'è che nella maggior parte dei browser questo attributo corrisponde all'attributo name (praticamente sono uguali)

- type: rappresenta il tipo di file (image/png, application/pdf, ecc.)

- tmp_name: contiene il percorso temporaneo in cui il file caricato è stato salvato sul server; quando un file viene caricato tramite un form HTML, PHP lo memorizza temporaneamente in una directory sul server prima che tu decida di spostarlo o elaborarlo; Il file caricato viene salvato in una directory temporanea configurata nel file php.ini tramite la direttiva upload_tmp_dir. Se questa directory non è configurata, PHP utilizza una directory di sistema predefinita (es. /tmp su Linux o una cartella temporanea su Windows). Successivamente attraverso move_uploaded_file() andremo a spostare il file nella directory desiderata.

- error: il campo error indica lo stato di upload del file ed utilizza un valore numerico per rappresentare il tipo di errore. Se il valore è 0, allora il file è stato caricato con successo (per altri errori vedi sotto);

- Qui sotto aggiungo un esempio di gestione altenativa dell'errore (in base alle costanti della tabella): 
if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    echo "File caricato correttamente.";
} else {
    switch ($_FILES['file']['error']) {
        case UPLOAD_ERR_INI_SIZE:
            echo "Errore: Il file supera la dimensione massima consentita.";
            break;
        case UPLOAD_ERR_NO_FILE:
            echo "Errore: Nessun file caricato.";
            break;
        case UPLOAD_ERR_PARTIAL:
            echo "Errore: Il file è stato caricato solo parzialmente.";
            break;
        default:
            echo "Errore: Problema sconosciuto durante il caricamento del file.";
    }
}


- size: il campo size indica la dimensione del file in byte. attraverso questo valore si può impostare un controllo sulla dimensione del file


