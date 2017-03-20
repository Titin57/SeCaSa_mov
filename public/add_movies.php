<?php

// Inclusion de config.php
require dirname(dirname(__FILE__)).'/inc/config.php';

// récupération de données ou autre
$currentPage = 'Add a new film';
// Formulaire soumis
if (!empty($_POST)) {
	//print_r($_POST);exit;
	// Je récupère les données en GET
	$mov_post = filterStringInputPost('mov_post');
	$mov_title = filterStringInputPost('mov_title');
	$mov_actors = filterStringInputPost('mov_actors');
	$mov_fileName = filterStringInputPost('mov_fileName');
	$mov_rel = filterIntInputPost('mov_rel');
	$mov_plot = filterIntInputPost('mov_plot');
	$gen_name = filterIntInputPost('gen_name');
	$sup_name = filterIntInputPost('sup_name');

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
		// J'appelle la fonction ajoutant le student à la DB
		$filmId = addFilm(
			$mov_post,
			$mov_title,
			$mov_actors,
			$mov_fileName,
			$mov_rel,
			$mov_plot,
			$gen_name,
			$sup_name
		);

		// Si ajout ok
		if ($studentId > 0) {
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
				header('Location: home.php');
				// Je redirige sur sa page
				//header('Location: home.php?id='.$studentId);
				exit;
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

function addFilm($lastname,$firstname,$email,$birthdate,$friendliness,$sessionId,$cityId) {
	global $pdo;

	$sql = '
		INSERT INTO student (stu_lastname, stu_firstname, stu_email, stu_birthdate, stu_friendliness, session_ses_id, city_cit_id)
		VALUES (:lastname, :firstname, :email, :birthdate, :friendliness, :ses_id, :cit_id)
	';
	$sth = $pdo->prepare($sql);
	$sth->bindValue(':mov_post', $mov_post);
	$sth->bindValue(':mov_title', $mov_title);
	$sth->bindValue(':mov_actors', $mov_actors);
	$sth->bindValue(':mov_fileName', $mov_fileName);
	$sth->bindValue(':mov_rel', $mov_rel);
	$sth->bindValue(':mov_plot', $mov_plot);
	$sth->bindValue(':gen_name', $gen_name);
	$sth->bindValue(':sup_name', $sup_name);
/* I didnt check the parameter genre like we did in class :
	$sth->bindValue(':cit_id', $cityId, PDO::PARAM_INT);
*/
/* copy
			$mov_post,
			$mov_title,
			$mov_actors,
			$mov_fileName,
			$mov_rel,
			$mov_plot,
			$gen_name,
			$sup_name
*/ copy


	if ($sth->execute() === false) {
		print_r($sth->errorInfo());
	}
	else {
		// Je récupère l'ID auto-incrémenté
		return $pdo->lastInsertId();
	}

	return false;
}





// Pour éviter les notices dans la vue, j'initialise mon tableau de données

// Dont know what this does, but i changed the variables anyway
$studentInfos = array(
	'mov_post' => 0,
	'mov_title' => '',
	'mov_actors' => '',
	'mov_fileName' => '',
	'mov_rel' => '',
	'mov_plot' => '',
	'gen_name' => '',
	'sup_name' => '',

);
*/
// A la fin, TOUJOURS, les vues
include dirname(dirname(__FILE__)).'/view/header.php';
include dirname(dirname(__FILE__)).'/view/add_movies.php';
include dirname(dirname(__FILE__)).'/view/footer.php';