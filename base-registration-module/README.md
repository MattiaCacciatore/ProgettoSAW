# Laboratorio 11 
## sistema di Sign in e Log In per il progetto




## Sistema di Sign in: features

- verifica che i campi siano tutti completi
- verifica la correttezza delle email
- verifica che i campi di password e Conferma della Password siano uguali
- se ci sono dei campi corretti, ma la registrazione non e' avvenuta per qualche errore li mantiene (eccezion fatta per le password)
- alle password gli viene correttamente applicato l'hashing prima di essere salvato sul database
- viene verificato se l'email e' gia' registrata sul sito (e' presente nel database) cosi' che non ci siano pericoli di account multipli con una stessa email
- tutti gli errori vengono correttamente stampati a schermo, cosi' come nel caso di una corretta registrazione


- l'id di sessione viene rigenerato ogni 30 minuti per "impedire" attacchi
- le sessioni possono essere trasmesse solo attraverso i cookie 
- le sessioni dovranno rispettano tutte le regole di restrizione
- i cookie sono trasmessi solo su connessioni https
- il sito e' accessibile solo in http e non puo' essere modificato da js 


# login & Accesso area privata

- verifica la correttezza delle credenziali
- stampa un messaggio di login avvenuto
- reindirizza l'utente verso la sua area privata altrimenti mostra una pagina di accesso negato (vedi nella cartella errors)



Piccola legenda dei file:

- '.inc' : è il file main dellla pagina di riferimento lato backend
- '.model': metodi accesso al db 
- '.cont(rol)': metodi di controllo degli input
