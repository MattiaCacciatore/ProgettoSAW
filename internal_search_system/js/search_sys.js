


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

//-------------------------------------------------------------------------------------------------------------------------------
// ricerca sulla base dell'input della barra di ricerca


searchInput.addEventListener("input", searchByInputOnSearchBar);

// Funzione per filtrare gli utenti in base all'input nella barra di ricerca
function searchByInputOnSearchBar(event) {
   // Otteniamo il valore inserito nella barra di ricerca, convertendolo in minuscolo per rendere la ricerca case-insensitive
   const value = event.target.value.toLowerCase();

   // Iteriamo su ogni utente presente nell'array
   users.forEach(user => {
      // Controlliamo se il nome o l'email dell'utente corrente includono il valore inserito nella barra di ricerca
      const isVisible = user.name.toLowerCase().includes(value) || user.email.toLowerCase().includes(value);

        // Nascondiamo tutti gli elementi che non sono pertinenti con la ricerca effettuata
        user.element.classList.toggle("hide", !isVisible);
   });
}



// ***********************************************
// versione Jquery

// ricerca sulla base dell'input della barra di ricerca
$('[data-search]').on('input', searchByInputOnSearchBar);

// Funzione per filtrare gli utenti in base all'input nella barra di ricerca
function searchByInputOnSearchBar(event) {
   // Otteniamo il valore inserito nella barra di ricerca, convertendolo in minuscolo per rendere la ricerca case-insensitive
   const value = $(this).val().toLowerCase();

   // Iteriamo su ogni utente presente nell'array
   users.forEach(user => {
      // Controlliamo se il nome o l'email dell'utente corrente includono il valore inserito nella barra di ricerca
      const isVisible = user.name.toLowerCase().includes(value) || user.email.toLowerCase().includes(value);

      // Nascondiamo tutti gli elementi che non sono pertinenti con la ricerca effettuata
      $(user.element).toggleClass("hide", !isVisible);
   });
}




//-------------------------------------------------------------------------------------------------------------------------------
// ricerca in base all'input della categoria del corso

// Aggiungi un listener a ciascun elemento checkbox

categoryFilterInput.forEach(input => {
    input.addEventListener('change', searchByCategory);
});

// Funzione per filtrare gli utenti per categoria
function searchByCategory(event) {

    // Otteniamo i valori delle categorie selezionate
    const selectedCategories = Array.from(categoryFilterInputs)
        .filter(input => input.checked)
        .map(input => input.value);

    // Iteriamo su ogni utente presente nell'array
    users.forEach(user => {

        // Controlliamo se la categoria dell'utente corrente è inclusa tra le categorie selezionate 
        //user.category probabilemente da modidficare in futuro
        const isVisible = selectedCategories.includes(user.category) || selectedCategories.includes('all');

        // Nascondiamo tutti gli elementi che non sono pertinenti con la ricerca effettuata
        user.element.classList.toggle("hide", !isVisible);
    });
}



// ***********************************************
// versione Jquery

$('[category-filter-data]').on('change', searchByCategory);

function searchByCategory() {
    const selectedCategories = $('[category-filter-data]:checked').map(function() {
        return $(this).val();
    }).get();

    users.forEach(user => {
        const isVisible = selectedCategories.includes(user.category) || selectedCategories.includes('all');
        $(user.element).toggleClass("hide", !isVisible);
    });
}



//-------------------------------------------------------------------------------------------------------------------------------
// ricerca in base all'input della anno di rilascio del corso

releaseYearFilterInput.addEventListener('change', searchByReleaseYear);

function searchByReleaseYear(event) {

  const selctedReleaseYear = Array.form(releaseYearFilterInput)
    .filter(input => input.checked)
    .map(input => input.value);


    users.forEach(user => {


      const isVisible = selctedReleaseYear.includes(user.releaseYear) || selectedCategories.includes('all');

      user.element.classList.toggle('hide', !isVisible);
      
    });

}



// ***********************************************
// versione Jquery

$('[release-year-filter-data]').on('change', searchByReleaseYear);

function searchByReleaseYear() {
    const selectedReleaseYears = $('[release-year-filter-data]:checked').map(function() {
        return $(this).val();
    }).get();

    users.forEach(user => {
        const isVisible = selectedReleaseYears.includes(user.releaseYear) || selectedReleaseYears.includes('all');
        $(user.element).toggleClass('hide', !isVisible);
    });
}


//-------------------------------------------------------------------------------------------------------------------------------
// ricerca in base all'input della prezzo  del corso

categoryFilterInput.addEventListener('change', searchByCategory);

function searchByCategory(event) {

  const selectedPrice = Array.from(priceFilterInput);
    .filter(input => input.checked)
    .map(input => input.value);

  users.forEach(user => {

    const isVisible =  selectedPrice.includes(user.Price) || selectedPrice.includes('all')
    user.element.classList.toggle('hide', !isVisible);
  })


}




// ***********************************************
// versione Jquery
$('[price-filter-data]').on('change', searchByPrice);

function searchByPrice() {
    const selectedPrices = $('[price-filter-data]:checked').map(function() {
        return $(this).val();
    }).get();

    users.forEach(user => {
        const isVisible = selectedPrices.includes(user.price) || selectedPrices.includes('all');
        $(user.element).toggleClass('hide', !isVisible);
    });
}







//------------------------------------------------------------------------------------------------------------------------------
// effettuiamo la ricercca sul file json per il momento

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

  
  //------------------------------------------------------------------------------------------
  // versione riadattata:




  





  //------------------------------------------------------------------------------------------
  // metodi per la visualizzazione degli elenchi dei filtri


  var checkList = document.getElementById('categories');
  checkList.getElementsByClassName('anchor')[0].onclick = function(evt) {
    if (checkList.classList.contains('visible'))
      checkList.classList.remove('visible');
    else
      checkList.classList.add('visible');
  }


  var checkList2 = document.getElementById('release-year');
  checkList2.getElementsByClassName('anchor')[0].onclick = function(evt) {
    if (checkList2.classList.contains('visible'))
    checkList2.classList.remove('visible');
    else
    checkList2.classList.add('visible');
  }








  