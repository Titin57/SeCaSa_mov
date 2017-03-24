<?php

// Inclusion de config.php
require dirname(dirname(__FILE__)).'/inc/config.php';

// récupération de données ou autre
$currentPage = 'Add a new film';

$movieSupport = getAllSupport();
$movieGenres = getAllGenres();

if (isset($_GET['omdb'])) {
	$askimdb = $_GET['omdb'];
	$askimdb = removeSpaces ($askimdb);
	echo 'input in the url '. $askimdb;
	$filmInfosOmdb= askImdb($askimdb);
	//print_r($filmInfos);
}
else {
	// Sinon, page n°1 par défaut
	$askimdb = 'Pulp+Fiction';
}


//askImdb($askimdb);

// Formulaire soumis
if (!empty($_POST)) {
	//print_r($_POST);exit;
	// Je récupère les données en GET
	$mov_post = filterStringInputPost('mov_post');
	$mov_title = filterStringInputPost('mov_title');
	$mov_actors = filterStringInputPost('mov_actors');
	$mov_fileName = filterStringInputPost('mov_fileName');

	#$mov_rel = filter_input(INPUT_POST, 'mov_rel');

	$mov_rel = filterStringInputPost('mov_rel');
	$mov_plot = filterStringInputPost('mov_plot');
	$genres_gen_id = filterStringInputPost('genres_gen_id');
	$support_sup_id = filterStringInputPost('support_sup_id');

	#formatDate($mov_rel);
	// Le tableau contenant toutes les valeurs
	$errorList = array();

			// sorry we dont test at the moment
	// Je teste toutes les erreurs
	/*
	if (empty($lastname)) {
		$errorList[] = 'Le nom est vide';
	}
	else if (strlen($lastname) < 2) {
		$errorList[] = 'Le nom est incorrect';
	}
	if (empty($firstname)) {
		$errorList[] = 'Le prénom est vide';
/*
	}
	else if (strlen($firstname) < 2) {
		$errorList[] = 'Le prénom est incorrect';
	}
	if (empty($email)) {
		$errorList[] = 'L\'email est vide';
	}
	else if (filter_var($email,  FILTER_VALIDATE_EMAIL) === false) {
		$errorList[] = 'L\'email est incorrect';
	}
	if (empty($birthdate)) {
		$errorList[] = 'La date de naissance est vide';
	}
	if ($friendliness < 0 || $friendliness > 5) {
		$errorList[] = 'La sympathie est incorrecte';
	}
	if (empty($sessionId)) {
		$errorList[] = 'La session n\'est pas renseignée';
	}
	if (empty($cityId)) {
		$errorList[] = 'La ville n\'est pas renseignée';
	}
					*/
	// Si aucune erreur
	if (empty($errorList)) {
		// i force values into the object i am waiting for



		// J'appelle la fonction ajoutant le student à la DB
		$filmId = addMovie(
			$mov_post,
			$mov_title,
			$mov_actors,
			$mov_fileName,

			$mov_rel,
			$mov_plot,
			$genres_gen_id,
			$support_sup_id);

		// Si ajout ok
		if ($filmId > 0) {
			// Je gère l'upload après la création de la ligne

			/* NO adding of images so far

			if (!empty($_FILES)) {
				$currentFileInfo = $_FILES['stu_image'];
				if ($currentFileInfo['error'] == 0) {
					// Je récupère l'extension
					$tmp = explode('.', $currentFileInfo['name']);
					$extension = end($tmp);

					$authorizedExtensions = array('jpg', 'jpeg', 'gif', 'svg', 'png');

					// Si l'extension est dans les extensions autorisées
					if (in_array($extension, $authorizedExtensions)) {
						$filename = '/img/files/'.md5($lastname.'wf3'.time()).'.'.$extension;
						if (move_uploaded_file($currentFileInfo['tmp_name'], dirname(__FILE__).$filename)) {
							if (updateStudentImageFilename($studentId, $filename)) {
								echo 'Fichier uploadé<br>';
							}
							else {
								$errorList[] = 'Erreur dans l\'update DB';
							}
						}
						else {
							$errorList[] = 'Erreur dans l\'upload';
						}
					}
					else {
						$errorList[] = 'extension non autorisée';
					}
				}
				else {
					$errorList[] = 'Erreur dans l\'upload';
				}
			}

			*/ # NO adding of images so far

			if (empty($errorList)) {
				// I go home


					//return to INDEX!!!!!!


				header('Location: index.php');


				// Je redirige sur sa page
				//header('Location: home.php?id='.$studentId);
				//exit;
			}
		}
	}
}


/*   OLD stuff projet Toto
// Je récupère toutes les villes
$citiesList = getAllCities();

// Je récupère toutes les sessions
$sessionsList = getAllSessions();
*/ # OLD stuff projet Toto


// function AddFilm -> put in functions.php afterwords !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!






// Pour éviter les notices dans la vue, j'initialise mon tableau de données
/*
// Dont know what this does, but i changed the variables anyway
$filmInfos = array(
	'mov_post' => 0,
	'mov_title' => '',
	'mov_actors' => '',
	'mov_fileName' => '',
	'mov_rel' => '',
	'mov_plot' => ''
);
*/
$filmInfos = array(
	'mov_fileName' => 'C:\media\myFilms'
);

// A la fin, TOUJOURS, les vues
include dirname(dirname(__FILE__)).'/view/header.php';
include dirname(dirname(__FILE__)).'/view/add_movies.php';
include dirname(dirname(__FILE__)).'/view/footer.php';