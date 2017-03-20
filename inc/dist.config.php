<?php

// J'inclus l'autoload de COMPOSER
require_once dirname(dirname(__FILE__)).'/vendor/autoload.php';

// Importe la librairie social-links de composer
use SocialLinks\Page;

// Le fichier de config contient toutes les valeurs de configuration qui change entre les différents serveurs (dév et prod par exemple)
$config = array(
	'DB_username' => '',
	'DB_password' => '',
	'DB_database' => '',
	'DB_host' => '',
);

//Create a Page instance with the url information
/*
$socialLinks = new Page([
    'url' => 'http://projet-toto.dev/'.$_SERVER['PHP_SELF'], // TODO mettre la page courante
    'title' => 'Projet TOTO',
    'text' => 'Gestion des formations webforce3',
    'image' => 'http://www.wf3.fr/wp-content/uploads/2015/03/logo_WF3_new.png',
    'twitterUser' => '@twitterUser'
]);
*/
// J'inclus la connexion à la DB
require_once dirname(__FILE__).'/db.php';
// J'inclus le fichier de fonctions
require_once dirname(__FILE__).'/functions.php';