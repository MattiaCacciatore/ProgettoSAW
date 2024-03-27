# User Area

Qui verranno implementate le funzionalità o area del sito dedicata all'utente:

- profilo utente
- modifica del profilo utente


## visualizzazione del profilo utente

Ogni utente deve poter visualizzare il proprio profilo per vedere quali sono le sue informazioni salvate nel database del sito. Il nome dello script che visualizza i dati del profilo deve chiamarsi show_profile.php.

## modifica del profilo utente

Ogni utente deve poter modificare il proprio profilo. Nel modulo di modifica del profilo i campi dovranno essere precompilati rispetto a quanto già presente nel database.
ATTENZIONE. L'impronta hash della password non deve essere  mai visualizzata nel form di modifica! Consiglio di tenere separata la modifica della password dalla modifica del profilo.

Nella modifica del profilo il test automatico controlla solo i campi obbligatori del modulo base (email, nome, cognome) ma non verifica i campi aggiunti per il profilo. Per i campi email, nome, cognome devi usare la stessa struttura del modulo fornito per la registrazione. Il nome dello script che modifica i dati nel database deve chiamarsi update_profile.php.