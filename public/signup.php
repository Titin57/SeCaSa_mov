<?php

// Inclusion de config.php
// double dirname pour retrouver le répertoire parent
require dirname(dirname(__FILE__)).'/inc/config.php';

// ICI MON CODE POUR CETTE PAGE
/*
$currentPage = 'Inscription';

// Formulaire soumis
if (!empty($_POST)) {
	// Debug
	//print_r($_POST);

	// Je récupère les données
	$emailToto = isset($_POST['emailToto']) ? trim($_POST['emailToto']) : '';
	$passwordToto1 = isset($_POST['passwordToto1']) ? trim($_POST['passwordToto1']) : '';
	$passwordToto2 = isset($_POST['passwordToto2']) ? trim($_POST['passwordToto2']) : '';
	// tableau d'erreurs
	$errorList = array();

	// Je valide les données
	if (empty($emailToto)) {
		$errorList[] = 'Email vide';
	}
	else if (filter_var($emailToto, FILTER_VALIDATE_EMAIL) === false) {
		$errorList[] = 'Email incorrect';
	}
	// Je vérifie que l'email n'est pas déjà pris
	else if (emailExists($emailToto)) {
		$errorList[] = 'Email existe déjà';
	}

	// Si un des password est vide
	if (empty($passwordToto1) || empty($passwordToto2)) {
		$errorList[] = 'Le mot de passe est vide';
	}
	// Si les password sont différents
	else if ($passwordToto1 != $passwordToto2) {
		$errorList[] = 'Les 2 mots de passe sont différents';
	}

	// Aucune erreur
	if (empty($errorList)) {
		// On insère en DB
		$sql = '
			INSERT INTO user (usr_email, usr_password, usr_date_creation)
			VALUES (:email, :password, NOW())
		';
		$sth = $pdo->prepare($sql);
		// BindValues !!!!
		$sth->bindValue(':email', $emailToto);
		//$sth->bindValue(':password', $passwordToto1)); // en clair en DB, pas sécurisé du tout
		//$sth->bindValue(':password', md5($passwordToto1)); // encodé md5, bien mais peut être décrypté
		//$sth->bindValue(':password', md5('*'.$passwordToto1.'!$¨ben')); // ajout d'un "salt" qui rend + difficile le décryptage du md5
		$sth->bindValue(':password', password_hash($passwordToto1, PASSWORD_BCRYPT)); // password_hash => tjr 60 caractères !!!!

		// J'exécute !!
		if ($sth->execute() === false) {
			print_r($sth->errorInfo());
		}
		else {
			echo 'Sign up ok !!!!!<br>';
			exit;
		}
	}
}
*/
// FIN DE MON CODE POUR CETTE PAGE

// A la fin, TOUJOURS, les vues
include dirname(dirname(__FILE__)).'/view/header.php';
include dirname(dirname(__FILE__)).'/view/signup.phtml';
include dirname(dirname(__FILE__)).'/view/footer.php';