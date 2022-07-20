<?php

/**
 * Fichier contenant la configuration de l'application
 */
const CONFIG = [
    'db' => [
        'DB_HOST' => 'localhost',
        'DB_PORT' => '3306',
        'DB_NAME' => 'nasa0443_smart_reader',
        'DB_USER' => 'nasa0443_smart_reader',
        'DB_PSWD' => 'smart-reader75!',
    ],
    'app' => [
        'name' => 'smart_reader',
        'projectBaseUrl' => 'http://localhost/smart_reader'
        // 'projectBaseUrl' => 'http://smart_reader.codeyourlife.fr'
    ]
];

/**
 * Constantes pour accéder rapidement aux dossiers importants du MVC
 */
const BASE_DIR = __DIR__ . '/../';
const BASE_PATH = CONFIG['app']['projectBaseUrl'] . '/public/index.php/';
const PUBLIC_FOLDER = BASE_DIR . 'public/';
const VIEWS = BASE_DIR . 'views/';
const MODELS = BASE_DIR . 'src/models/';
const CONTROLLERS = BASE_DIR . 'src/controllers/';
const PHOTO = BASE_DIR.'public/uploads/';
const COVER = '../../public/uploads/';
const ASSET =  CONFIG['app']['projectBaseUrl'] . '/asset/';
const API_KEY = "AIzaSyAzFkhp4TZ1_TvOfKk3f7O7r3pgk2lMxFQ";

/**
 * Liste des actions/méthodes possibles (les routes du routeur)
 */
$routes = [
    // Général--------------------------------------------------------------
    ''                           => ['AppController', 'index'],
    '/'                          => ['AppController', 'index'],
    '/qui_sommes_nous'           => ['AppController', 'who'],
    '/contact'                   => ['AppController', 'contact'],
    '/mentions_legales'          => ['AppController', 'legal'],
    '/erreur'                    => ['AppController', 'erreur'],

    // API : Livres--------------------------------------------------------------
    '/listeLivres'          => ['BookController', 'booksListing'], //OK
    '/detailLivre'          => ['BookController', 'bookDetail'], //OK

    // Table user : Utilisateurs--------------------------------------------------------
    '/monCompte'            => ['UserController', 'compteDetail'], //OK
    '/modifCompte'          => ['UserController', 'updateUser'],//OK
    '/connexion'            => ['UserController', 'connexion'],//git pulOK
    
    '/inscription'          => ['UserController', 'replaceUser'],//OK
    // '/suppression'          => ['UserController', 'disabled'],
    //Déconnexion OK

    // Table dealing et API : Offres et demandes d'un utilisateur----------
    '/mesOffres'            => ['DealController', 'offersList'], //OK
    '/addOffre'             => ['DealController', 'addOffer'], //OK

    '/mesSouhaits'          => ['DealController', 'wishList'], //OK
    '/addSouhait'           => ['DealController', 'addWish'], //OK

    '/modifDeal'            => ['DealController', 'modifDeal'],//OK
    // Supression => OK

    // Table exchange, dealing et user--------------------------------------

    '/allOffres'              => ['ExchangeController', 'allOffersList'], //OK
    '/allSouhaits'            => ['ExchangeController', 'allWishesList'], //OK
    '/tradeDetail'            => ['ExchangeController', 'tradeDetail'], //OK
    '/monHistorique'          => ['ExchangeController', 'myTradesList'], //OK
    '/allHistorique'          => ['ExchangeController', 'allTrades'], 

    // Admin
    '/listUsers'            => ['AdminController', 'usersListing'], //OK
    '/deleteUser'           => ['AdminController', 'deleteUser'], //OK
    '/adminUser'            => ['AdminController', 'adminUser'], //OK
    '/listBooks'            => ['AdminController', 'booksListing'], 

    // '/inscription'          => ['UserController', 'replaceUser'],//OK


];
