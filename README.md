# Progetto SAW

## Organizzazione workspace

**Folders** -  eccezion fatta per quelle auto esplicative come css e database; abbiamo: 

- modules: ovvero i moduli come header e footer evitandoci di fare copia e incolla goni volta

- configuration: file anchessi, comuni a tutti i file di configurazione e inizializzazione della sessione, includendolo all'inizio della pagina avrai già session_start()

- E di come ci si connetterà al database (forse questo è da rivedere, funziona ma non mi convince granchè dal lato sicurezza)


Ma la parte grossa diciamo, è quella delle pagine con relativo backend, in particolar modo possiamo suddividere le funzionalità (es. per l'area del profilo in un folder: profile) e dentro suddetti folder, tutto il codice collegato alle pagine che l'utente visualizzerà, in modo tale da non aver troppo codice sparso tra differenti cartelle. Aprendone una hai tutto il codice ad esso collegato.


In ogni **funtionality_folder**:  le sotto cartelle principali saranno:

- *pages*: ovvero le pagine che visualizzerà l'utente
- *nome_pagina*: con tutti i file php e js di riferimento


in somma una gestione del codice modulare alla funzionalità da implementare (o area del sito).

Ho visto alcuni codici di esempio, anche da altri del corso e suddividere il codice in cartelle in base al tipo di file contenuto in esso, mi sempbra molto confusionario.


ho evitato di creare un'altra macro cartella: *common* o *shared* per inidicare tutto il codice (suddiviso in sotto cartelle) condiviso tra le pagine del sito. comunque possiamo aggiungerlo successivamente
