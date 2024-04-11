# Internal search system

Realizza un modulo di ricerca per trovare informazioni utili all'interno del sito di startSAW. Il tipo di ricerca è naturalmente correlato al dominio scelto per il progetto e puoi anche prevedere una ricerca "advanced" per trovare, per esempio, i post su un certo argomento, o i prodotti in vendita sotto una certa soglia di prezzo, o i messaggi scambiati tra gli utenti in piattaforma (ovviamente solo per gli utenti coinvolti nello scambio dei messaggi stessi).

**ATTENZIONE**. Per la ricerca è buona pratica usare l'operatore SQL LIKE



## Funzionalità: 
La funzionalità che un sistema di ricerca interno per un sito Udemy-like dovrebbe evere sono pressappoco le seguenti (non penso che risucirò a implementarle tutte con il solo uso di PHP):

### Funzionalità di base:

- **Ricerca per parola chiave**: Gli utenti dovrebbero poter cercare corsi utilizzando parole chiave relative al titolo, all'argomento, al docente o alle descrizioni dei corsi.


- **Filtri**: Gli utenti dovrebbero poter filtrare i risultati della ricerca per diversi criteri, come:
   - **Argomento**: Per restringere la ricerca a un'area specifica di interesse (es. sviluppo web, design, marketing).
    - **Livello di difficoltà**: Per trovare corsi adatti al proprio livello di esperienza (es. principiante, intermedio, avanzato).
     - **Prezzo**: Per trovare corsi gratuiti o a pagamento che rientrano nel proprio budget.
    - **Lingua**: Per trovare corsi in una lingua specifica.
    - **Valutazione**: Per trovare corsi con una valutazione alta da parte di altri studenti.
   - **Ordinamento**: Gli utenti dovrebbero poter ordinare i risultati della ricerca per diversi criteri, come:
   - **Pertinenza**: Per visualizzare i corsi più pertinenti alla query di ricerca.
   - **Data di pubblicazione**: Per visualizzare i corsi più recenti.
   - **Valutazione**: Per visualizzare i corsi con le migliori valutazioni.


- **creazione dinamica delle pagine**: Invece di avere *n-pagine* all'interno del sito le pagine di riferimento dei corsi verranno create dinamicamente. il funzionamento è pressappoco il seguente

    1. a creazione dinamica delle pagine:

    2. L'utente clicca sulla tagline del corso.
    3. Il server invia una richiesta al database.
    4. Il database restituisce le informazioni relative al corso.
    5. Il server utilizza queste informazioni per generare dinamicamente la pagina del corso.
    6. La pagina del corso viene inviata al browser dell'utente.


### Funzionalità avanzate:

- **Ricerca per frase**: Gli utenti dovrebbero poter cercare corsi utilizzando frasi complete, per una ricerca più precisa.

- **Ricerca per sinonimi**: Il motore di ricerca dovrebbe essere in grado di identificare i sinonimi delle parole chiave utilizzate nella ricerca e restituire risultati pertinenti.

- **Autocompletamento**: Il motore di ricerca dovrebbe suggerire automaticamente le parole chiave mentre l'utente digita la sua query.

- **Correzione automatica degli errori**: Il motore di ricerca dovrebbe essere in grado di correggere gli errori di ortografia e di battitura nella query di ricerca.

- **Integrazione con i social media**: Gli utenti dovrebbero poter condividere i corsi che trovano con i loro amici e follower sui social media.


### Design 

- **Interfaccia utente accessibile**: Il motore di ricerca dovrebbe essere accessibile agli utenti con disabilità.

- **Risultati di ricerca accessibili**: I risultati della ricerca dovrebbero essere accessibili agli utenti con disabilità. Oltre a queste funzionalità, un motore di ricerca interno dovrebbe essere efficiente e veloce, e dovrebbe fornire agli utenti un'esperienza di ricerca piacevole e intuitiva.

Esempio di motori di ricerca interni di successo:

https://www.google.com/search/howsearchworks/

https://www.amazon.com/search/s?k=search

https://www.youtube.com/howyoutubeworks/product-features/search/
