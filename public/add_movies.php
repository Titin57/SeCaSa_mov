<?php

// Inclusion de config.php
require dirname(dirname(__FILE__)).'/inc/config.php';
/*
// récupération de données ou autre
$currentPage = 'Ajout d\'un étudiant';

// Formulaire soumis
if (!empty($_POST)) {
	//print_r($_POST);exit;
	// Je récupère les données en GET
	$lastname = filterStringInputPost('stu_lastname');
	$firstname = filterStringInputPost('stu_firstname');
	$email = filterStringInputPost('stu_email');
	$birthdate = filterStringInputPost('stu_birthdate');
	$friendliness = filterIntInputPost('stu_friendliness', -1);
	$sessionId = filterIntInputPost('ses_id');
	$cityId = filterIntInputPost('cit_id');

	// Le tableau contenant toutes les valeurs
	$errorList = array();

	// Je teste toutes les erreurs
	if (empty($lastname)) {
		$errorList[] = 'Le nom est vide';
	}
	else if (strlen($lastname) < 2) {
		$errorList[] = 'Le nom est incorrect';
	}
	if (empty($firstname)) {
		$errorList[] = 'Le prénom est vide';
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

	// Si aucune erreur
	if (empty($errorList)) {
		// J'appelle la fonction ajoutant le student à la DB
		$studentId = addStudent(
			$lastname,
			$firstname,
			$email,
			$birthdate,
			$friendliness,
			$sessionId,
			$cityId
		);

		// Si ajout ok
		if ($studentId > 0) {
			// Je gère l'upload après la création de la ligne
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

			if (empty($errorList)) {
				// Je redirige sur sa page
				header('Location: edit.php?id='.$studentId);
				exit;
			}
		}
	}
}

// Je récupère toutes les villes
$citiesList = getAllCities();

// Je récupère toutes les sessions
$sessionsList = getAllSessions();

// Pour éviter les notices dans la vue, j'initialise mon tableau de données
$studentInfos = array(
	'stu_id' => 0,
	'stu_lastname' => '',
	'stu_firstname' => '',
	'stu_email' => '',
	'stu_birthdate' => '',
	'stu_friendliness' => '',
	'session_ses_id' => '',
	'city_cit_id' => '',
	'cit_name' => '',
	'stu_age' => '',
);
*/
// A la fin, TOUJOURS, les vues
include dirname(dirname(__FILE__)).'/view/header.php';
include dirname(dirname(__FILE__)).'/view/add_movies.php';
include dirname(dirname(__FILE__)).'/view/footer.php';