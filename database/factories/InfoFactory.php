<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Info;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Info::class, function (Faker $faker) {
    return [

         'apartment_id' => $faker->unique()->numberBetween(1,30),

         // 'summary' => $faker->text($maxNbChars = 400),
         'summary' => $faker->randomElement(["La via più chic del quadrilatero della moda, a pochi passi dal DUOMO (5 minuti) Cattedrale e nelle vicinanza della 'SCALA'. Splendido piccolo appartamento: camera da letto, bagno, cucina e salotto con luminosa veranda. Pulito e confortevole.",
         "Completamente accessoriato, nel cuore dell'Isola in Via Borsieri. L'appartamento ha soffitti bassi nella zona cucina e camera da letto (182 cm nella cucina e da 169 cm nella zona notte), ed il letto misura 120*190. Controllate le procedure di check in prima di prenotare! Altre cose da evidenziare: il nostro sistema di check in è completamente automatizzato. Riceverete un link per inviarci le informazioni di registrazione previste dalla legge alla quale risponderemo con la procedura di accesso all'appartamento ed il codice della cassetta di sicurezza per prelevare le chiavi.",
         "Graziosa camera in appartamento con due camere: bagno e cucina condivisi con ospiti Airbnb dell'altra stanza. Vicino a metro linea 1 (rossa): perfetto per raggiungere centro e stadio, buono per Rho Fiera. Parcheggio libero e sicuro in strada, wifi, aria condizionata, quartiere calmo e tranquillo. Pochi gradini all'ingresso poi ascensore. Ristorante, caffé bar e supermarket molto vicino. Tutti dettagli e informazioni sono nell'annuncio. Abbiamo poche piccole regole, vi invitiamo a leggerle.",
         "Monolocale nel centro storico di Napoli a pochi passi dalla stazione Garibaldi attaccata a uno dei più antichi castelli napoletani Castel Capuano il monolocale si trova al piano terra è dotato di tutti i confort aria condizionata, microonde ,macchina del caffè ,mini frigo , tv c’è il Wi-Fi gratuito per tutti i nostri ospiti! Dalla suite di Pako si arriva velocemente a tutti i siti più importanti di Napoli a 20 metri c’è la fermata bus turistico,a meno di 400 dalla metro ideale per spostarsi! O' vasce (il basso) tipica abitazione del centro storico napoletano !! Che si trova piano Terra fronte strada !! l'alloggio e composto da una camera con angolo colazione! Un letto matrimoniale , e una poltrona letto.la camera da bagno e spaziosa e dorata di una grande doccia! C'è la TV il wifi e climatizzazione oltre a tutti i piccoli elettrodomestici che occorrono per la colazione",
         "ATTENZIONE: LE SPESE DI PULIZIA NON SONO INCLUSE nel totale della prenotazione e vanno pagate al momento del check-in. Le spese di pulizia comprendono anche il kit di biancheria e il servizio check-in. Ad ogni ospite sarà fornito un kit di biancheria comprensivo anche di un telo doccia, un asciugamano viso e un rotolo di carta igienica.
         Di seguito i costi:
         30 euro per soggiorno per 1/2 ospiti
         35 euro per soggiorno per 3/4 ospiti
         Questo grazioso appartamento si trova nel cuore di Napoli: consiste in una camera da letto con letto matrimoniale, bagno con doccia e soggiorno con divano letto per 2. Ci sono 3 balconi che affacciano su Corso Umberto I.
         L'appartamento è al primo piano, non c'è ascensore.",
         "Questo comodo e funzionale bilocale offre un perfetto equilibrio tra comfort e voglia di avventura. La sua posizione è centralissima e ben collegata con mezzi pubblici e luoghi di attrazione turistica. Al suo interno troverete un'ampia zona living provvista di cucina completa ed attrezzata,include tostapane e forno funzionante,tv a schermo piatto con canali satellitari,questo spazio comprende una branda opportunamente mascherata per evitare ai nostri ospiti l'ingombro giornaliero,ma costituisce la possibilità di un terzo posto letto. La camera da letto prevede un comodo letto matrimoniale ed armadio capiente, da questa stanza si accede al bagno della casa,completo e fornito di tutto il necessario per il vostro soggiorno. L'appartamento sarà rifornito di alcuni prodotti per la colazione.",
         "E' un bellissimo appartamento affacciato su uno dei campi più struggenti di Venezia, San Giacomo dell'Orio. L'appartamento è un open-space composto da un salotto a doppia altezza con 2 letti singoli (ad estrazione), un'ampia sala da pranzo con grande tavolo in legno e una cucina attrezzata con microonde e piano cottura. Sul soppalco è situata una romantica camera su soppalco con travi a vista sostenute da antica colonna marmorea. La casa si completa di bagno con doppio lavandino e vasca/doccia. Le finiture sono molto curate, dal tipico pavimento alla veneziana della zona giorno, al pavimento in legno della camera soppalcata.
         E' dotato di aria condizionata, riscaldamento autonomo, wifi, asciugacapelli, lavatrice. L'appartamento è di notevole dimensioni e possiede una corte esterna dove è possibile sedersi avvolti dalle dolci fragranze del gelsomino. L'atmosfera di Ca' Cortigiane Suite è veramente rilassante ed accogliente per coppie e famiglie. Tassa di soggiorno non compresa. Costo: Euro 1,50 a persona a notte e euro 0,75 per i bambini ( 11 - 16 anni) . Il Check-in e' a partire dalle 14:00 ma in caso di arrivo anticipato è possibile depositare il bagaglio. Check-in dopo le ore 20:00 costo extra di euro +25,00, euro +35,00 dopo le ore 22:00 e dopo le 00:00 euro +45,00. Vi aspettiamo. Francesca e Rosanna",
         "Affascinante sistemazione su una terrazza tipica del centro storico salentino nella parte più antica e caratteristica della città di Lecce. La stanza e' proprio sulla terrazza con il suo bagno privato e completamente indipendente dal resto della casa.
         La stanza è completamente indipendente dal resto della casa e la terrazza antistante ad essa è a completa e ad esclusiva disposizione degli ospiti.
         La terrazza è a completa disposizione degli ospiti. Molto vicino e precisamente nei pressi di Porta Rudiae c'è un parcheggio molto ampio",
         "Situato in uno dei più prestigiosi palazzi antichi della città, nel cuore del centro storico, un grande appartamento ristrutturato accoglie gli ospiti che desiderano soggiornare in città.
         La collocazione è ideale per girare a piedi; tutti i monumenti più interessanti sono nel raggio di pochi metri. Dai balconi delle camere da letto si ha una vista suggestiva della Chiesa di S. Irene, una delle più importanti della città; all’interno del palazzo vi è un piccolissimo giardino con dei grandi alberi di banano. La città di Lecce, capoluogo di provincia, è una meta irresistibile per le vostre vacanze. Lecce vanta un eccellente patrimonio artistico, tra cui l'Anfiteatro Romano, il Castello Carlo V, la Chiesa di S. Niccolò e Cataldo, la Basilica di Santa Croce, l’ex Convento dei Celestini, la chiesa di Sant' Irene, a chiesa di San Matteo, il Vescovato del Seicento, ed un centro storico ricchissimo di stradine e corti. Il Bed and Breakfast si trova a pochi metri da tutte queste meraviglie, nel pieno centro storico."]),

         'room_num' => $faker->numberBetween(1, 8),

         'beds_num' => $faker->numberBetween(1, 10),

         'bathroom_num' => $faker->numberBetween(1,3),

         'sq_mt' => $faker->numberBetween(20,200),

         'image' => $faker->randomElement(['uploads/apt_image1.jpeg', 'uploads/apt_image2.jpeg', 'uploads/apt_image3.jpeg',
         'uploads/apt_image4.jpeg', 'uploads/apt_image5.jpeg', 'uploads/apt_image6.jpeg', 'uploads/apt_image7.jpeg', 'uploads/apt_image8.jpg', 'uploads/apt_image9.jpeg', 'uploads/apt_image10.jpg', 'uploads/apt_image11.jpg', 'uploads/apt_image12.jpg', 'uploads/apt_image13.jpg'])
    ];
});
