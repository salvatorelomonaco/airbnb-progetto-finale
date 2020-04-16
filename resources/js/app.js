/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

// ------------------ ATTIVAZIONE TOOLTIPs DI BOOSTRAP -------------------------
$(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
// ------------------ ATTIVAZIONE TOOLTIPs DI BOOSTRAP -------------------------

// premendo il tasto ENTER mentre uno dei campi del form ha il focus,
// si scatena l'evento "submit del form", per evitare questo
// blocco la possibilità di invio del form premendo il tasto ENTER
// l'invio deve avvenire solo con l'evento click sul bottone del modal corrispondente
$(document).on("keydown", ":input:not(textarea)", function(event) {
    return event.key != "Enter";
});

// ---------------------------- TOMTOM -----------------------------------------

$(document).ready(function() {

    // se l'id "map" è definito, vuol dire che mi trovo sulla pagina "show" dove devo visualizzare la mappa,
    // altrimenti non faccio nulla
    if ($("#map").length) {

        var lat = $("#map").attr('data-lat');
        var lon = $("#map").attr('data-lon');
        var address = $("#map").attr('data-address');
        var Apt_location = [lat, lon]; // coordinate [lat, lon]

        var map = tomtom.L.map('map', {
            key: 'BG5ffg9ACWQBPZZHShDaXxBnheo0bD36', // api-key di tomtom
            basePath: '../', // path di dove si trova la cartella con SDK di TomTom
            center: Apt_location, // array che contiene le coordinate della posizione
            zoom: 14 // livello di zoomata
        });
        // aggiungo un marker sulla mappa (map), nella posizione specificata nell'array Apt_location
        var Apt_location_marker = tomtom.L.marker(Apt_location).addTo(map);

        // aggiungo un popup sul marker, con l'indirizzo della posizione
        Apt_location_marker.bindPopup(address);

    }
}); // end document ready
// ---------------------------- TOMTOM -----------------------------------------


// ---------------------------- create/edit blade -----------------------------------------
$(document).ready(function() {
    $("#submit-btn").click(function() {
        // nascondo eventuali messaggi d'errore precedentemente visualizzati
        $('#err-list ul li').addClass('d-none').removeClass('d-block');
        $('#err-list').addClass('d-none').removeClass('d-block');

        // se non ci sono errori attivo il modal per procedere con la creazione dell'appartamento
        if (checkFormData()) {
            // non ci sono errori, visualizzo il modal che chiede all'utente se procedere o meno con la creazione
            $('#submit-modal').modal();

        } else {
            // ci sono errori sui dati del form, visualizzo il modal che avvisa l'utente che ci sono errori
            $('#err-submit-modal').modal();

            // riporto lo scroll a inizio pagina per mostrare la lista errori all'utente
            $(window).scrollTop(0);
        }
    }); // end click event

    // intercetto l'evento 'perdita del focus' sui campi della sezione indirizzo
    $('.street-field, .number-field, .city-field, .state-field').on('focusout', function() {
        console.log("focusout");
        var apiKey = "BG5ffg9ACWQBPZZHShDaXxBnheo0bD36";
        var street = $('.street-field').val().trim();
        var number = $('.number-field').val().trim();
        var city = $('.city-field').val().trim();
        var state = $('.state-field').val().trim();

        // verifico se sono "non nulli" tutti e 4 i campi che compongono l'indirizzo
        if (street && number && city && state) {
            // ho tutti i dati che compongono l'indirizzo per poter far partire la chiamta ajax verso TOMTOM

            var baseUrl = "https://api.tomtom.com/";
            var endPoint = "search/2/geocode/";
            var apiUrl = baseUrl + endPoint + street + " " + number + " " + city + " " + state + ".json";
            // esempio: https://api.tomtom.com/search/2/geocode/via%20carlo%20dolci%2032%20milano%20italia.json?countrySet=IT&key=*****
            $.ajax({
                type: "GET",
                url: apiUrl,
                data: {
                    "countrySet": 'IT',
                    "key": apiKey
                },

                success: function(data) {
                    console.log(data);
                    // recupero lat e lon dalla risposta che mi è arrivata
                    var lat = data.results[0].position.lat;
                    var lon = data.results[0].position.lon;
                    // inserisco i valori di lat e lon nel form, in 2 campi 'input' nascosti
                    $('.lat-input').val(lat);
                    $('.lon-input').val(lon);

                    console.log($('.lat-input').val());
                    console.log($('.lon-input').val());
                },

                error: function() {
                    //alert("Indirizzo non trovato!");
                }
            }); // end ajax call
        } // end if
    }); // end focusout event
}); // end document ready

function checkFormData() {
    // controlli di validità sui dati del form della pagina 'create' o 'edit'

    // se c'e un errore rendo visibili gli alert d'errore
    // per ogni campo controllo che sia presente un valore e che sia diverso da "spazi"
    if (!$('#title').val().trim()) {
        $('#err-title').removeClass('d-none').addClass('d-block');
    }
    if (!$('.state-field').val().trim()) {
        $('#err-state').removeClass('d-none').addClass('d-block');
    }
    if (!$('.city-field').val().trim()) {
        $('#err-city').removeClass('d-none').addClass('d-block');
    }
    if (!$('.street-field').val().trim()) {
        $('#err-street').removeClass('d-none').addClass('d-block');
    }
    if (!$('.number-field').val().trim()) {
        $('#err-number').removeClass('d-none').addClass('d-block');
    }
    if (!$('.zip-field').val().trim()) {
        $('#err-zip').removeClass('d-none').addClass('d-block');
    }
    if (!$('#summary').val().trim()) {
        $('#err-summary').removeClass('d-none').addClass('d-block');
    }
    if (!$('#room_num').val().trim()) {
        $('#err-room-num').removeClass('d-none').addClass('d-block');
    }
    if (!$('#beds_num').val().trim()) {
        $('#err-beds-num').removeClass('d-none').addClass('d-block');
    }
    if (!$('#bathroom_num').val().trim()) {
        $('#err-bathroom').removeClass('d-none').addClass('d-block');
    }
    if (!$('#sq_mt').val().trim()) {
        $('#err-sq-mt').removeClass('d-none').addClass('d-block');
    }

    if ($('#err-list ul li').hasClass('d-block')) {
        // se c'è almeno un alert che è stato reso visibile, rendo visibile il div che li contiene
        $('#err-list').removeClass('d-none').addClass('d-block');

        // ritorno falso per indicare che ci sono errori
        return false;
    } else {
        // non ci sono errori, ritorno true
        return true;
    }
}
// ---------------------------- create/edit blade -----------------------------------------


// ----------------------- home blade (pubblica)--------------------------------
$(document).ready(function() {

    // simulo il click sul bottone cerca quando viene premuto il tasto ENTER
    $('#home-where-input').keyup(function(event) {
        if (event.which == 13) {
            $('#home-submit-search').click();
        }
    });

    // quando viene caricata la pagina, resetto il campo di ricerca della località, il campo sarebbe valorizzato se
    // l'utente, che aveva fatto una ricerca, torna sulla pagina home premendo la freccia "back" del browser
    if ($('#home-where-input').length) { // verifico se l'id è definito, cioè se sono sulla pagina home
        // ripulisco il campo di ricerca della località
        $('#home-where-input').val("");
    }

    $('#home-where-input').keyup(function() {

        var apiKey = "BG5ffg9ACWQBPZZHShDaXxBnheo0bD36";

        place = $('#home-where-input').val().trim();

        if ((place) && (place.length >= 2)) {

            var baseUrl = "https://api.tomtom.com/";
            var endPoint = "search/2/geocode/";
            var apiUrl = baseUrl + endPoint + place + ".json";

            $.ajax({
                type: "GET",
                url: apiUrl,
                data: {
                    "countrySet": 'IT',
                    "key": apiKey
                },

                success: function(data) {

                    // verifico che tomtom mi abbia restituito dei valori di lat e lon
                    if (typeof(data.results[0]) !== 'undefined') {

                        // recupero lat e lon dalla risposta che mi è arrivata
                        var lat = data.results[0].position.lat;
                        var lon = data.results[0].position.lon;
                        // inserisco i valori di lat e lon nel form, in 2 campi 'input' nascosti
                        $('.lat-input').val(lat);
                        $('.lon-input').val(lon);
                    }

                    console.log($('.lat-input').val());
                    console.log($('.lon-input').val());
                },

                error: function() {
                    // alert("Indirizzo non trovato!");
                }
            }); // end ajax call
        } // end if
    }); // end keyup event

    // $('#home-submit-search').click(function() {
    //     alert("go for serach");
    //     // ripulisco il campo di ricerca della località
    //     $('#home-where-input').val("");
    // }); // end click event


}); // end document ready
// ----------------------- home blade (pubblica)--------------------------------