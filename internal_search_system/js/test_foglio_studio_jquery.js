//------------------------------------------------------------------------------------------------
//  search bar


// Seleziona il template HTML per una singola carta utente
const userCardTemplate = document.querySelector("[data-user-template]")
// Seleziona il contenitore dove verranno inserite le carte utente
const userCardContainer = document.querySelector("[data-user-cards-container]")
// Seleziona l'input della barra di ricerca
const searchInput = document.querySelector("[data-search]")

// ------------------------------------------------------------------------------------------------------
// seleziono gli input dei filtri
const categoryFilterInput = document.querySelectorAAll("[category-filter-data]");


const releaseYearFilterInput = document.querySelectorAll("[release-year-data]");

const priceFilterInput = document.querySelectorAll("[price-filter-data]")






// creiamo un Array per memorizzare gli utenti ottenuti dalla richiesta
let users = []


// ci poiniamo in ascolto sulla barra di ricerca in modo tale che a ogni input venga eseguita una ticerca (semnaz premere invio)
searchInput.addEventListener("input", e => {

  // otteniamo il valore inserito nella barra di ricerca, convertendolo in minuscolo per rendere la ricerca case-insensitive
    const value = e.target.value.toLowerCase()

  // Itera su ogni utente presente nell'array ==> ricerchiamo su tutto il file
    users.forEach(user => {
    // Controlla se il nome o l'email dell'utente corrente includono il valore inserito nella barra di ricerca
        const isVisible =
        user.name.toLowerCase().includes(value) ||
        user.email.toLowerCase().includes(value)

        // Nasconde o mostra la carta utente in base alla visibilità calcolata
        user.element.classList.toggle("hide", !isVisible)
  })
})



// per questo esempio utiliziamo dei file predefiniti giusto per capire il funzionamento della barra di ricerca
fetch("https://jsonplaceholder.typicode.com/users")
  .then(res => res.json()) // Estrai il corpo della risposta come JSON
  .then(data => {
    // Una volta ottenuti i dati, mappa ciascun utente per creare le relative carte utente
    users = data.map(user => {
      // Clona il template della carta utente
      const card = userCardTemplate.content.cloneNode(true).children[0]
      // Seleziona gli elementi all'interno della carta utente per impostare il nome e l'email dell'utente corrente
      const header = card.querySelector("[data-header]")
      const body = card.querySelector("[data-body]")
      header.textContent = user.name
      body.textContent = user.email
      // Aggiungi la carta utente al contenitore delle carte
      userCardContainer.append(card)

      // Memorizza il nome, l'email e l'elemento DOM della carta utente nell'array degli utenti
      return { name: user.name, email: user.email, element: card }
    })
  })
