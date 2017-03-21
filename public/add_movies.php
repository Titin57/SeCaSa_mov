<?php

// Inclusion de config.php
require dirname(dirname(__FILE__)).'/inc/config.php';

// récupération de données ou autre
$currentPage = 'Add a new film';

$movieSupport = getAllSupport();
$movieGenres = getAllGenres();

// Formulaire soumis
if (!empty($_POST)) {
	//print_r($_POST);exit;
	// Je récupère les données en GET
	$mov_post = 'mov_post';
	$mov_title = filterStringInputPost('mov_title');
	$mov_actors = filterStringInputPost('mov_actors');
	$mov_fileName = filterStringInputPost('mov_fileName');

	$mov_rel = filterStringInputPost('mov_rel');
	$mov_plot = filterStringInputPost('mov_plot');
	$gen_name = filterStringInputPost('gen_name');
	$sup_name = filterStringInputPost('sup_name');

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
		$filmId = addFilm(
			$mov_post,
			$mov_title,
			$mov_actors,
			$mov_fileName,

			$mov_rel,
			$mov_plot,
			$gen_name,
			$sup_name);

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


				//header('Location: index.php');
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

function filterStringInputPost($name, $defaultValue='') {
	$getValue = filter_input(INPUT_POST, $name);
	if ($getValue !== false) {
		return trim(strip_tags($getValue));
	}
	return $defaultValue;
}

/*
function AddFilm
	* 1 sql request on movies
	* 2 sql request on genres
	* 3 sql request on support



*/
function addFilm(
			$mov_post,
			$mov_title,
			$mov_actors,
			$mov_fileName,

			$mov_rel,
			$mov_plot,
			$gen_name,
			$sup_name
			) {
	global $pdo;

	/*	* 1 sql request on movies
	*******************************/

	$sql = '
		INSERT INTO movies (mov_post,
							mov_title,
							mov_actors,
							mov_fileName,

							mov_rel,
							mov_plot)

		VALUES (:mov_post,
				:mov_title,
				:mov_actors,
				:mov_fileName,

				:mov_rel,
				:mov_plot)
	';
	$sth = $pdo->prepare($sql);
	$sth->bindValue(':mov_post', $mov_post);
	$sth->bindValue(':mov_title', $mov_title);
	$sth->bindValue(':mov_actors', $mov_actors);
	$sth->bindValue(':mov_fileName', $mov_fileName);

	$sth->bindValue(':mov_rel', $mov_rel);
	$sth->bindValue(':mov_plot', $mov_plot);

	/*
	I didnt check the parameter genre like we did in class :
	//$sth->bindValue(':cit_id', $cityId, PDO::PARAM_INT);
*/

	if ($sth->execute() === false) {
		print_r($sth->errorInfo());
	}
	else {
			// Je récupère l'ID auto-incrémenté
			/*
			return $pdo->lastInsertId();

		}
		*/
		#return false;


		/*	* 2 sql request on genres
		*******************************/
		$id = 25;
		$gen_name = 'sfdaiugbasig';

		$sql2 = '
			INSERT INTO genres (gen_id, gen_name)
			VALUES (:id,:gen_name)';
		$sth2 = $pdo->prepare($sql2);
		$sth2->bindValue(':gen_id', $id, PDO::PARAM_INT);
		$sth2->bindValue(':gen_name', $gen_name);
		//print_r($sth2);

		if ($sth2->execute() === false) {
			print_r($sth2->errorInfo());
		}
		else {
				/*
				// Je récupère l'ID auto-incrémenté
				return $pdo->lastInsertId();
			}

			#return false;


			/*	* 3 sql request on support
			*******************************/
			print_r('easwpkjtgawrejg');



			$sql3 = '
				INSERT INTO support (sup_id, sup_name)
				VALUES (:id, :sup_name)';

			$sth3 = $pdo->prepare($sql3);
			$sth3->bindValue(':sup_name', $sup_name);
			$sth3->bindValue(':gen_name', $id);

			if ($sth3->execute() === false) {
				print_r($sth3->errorInfo());
			}
			else {
				// Je récupère l'ID auto-incrémenté
				return $pdo->lastInsertId();
			}

			return false;

			}
	}
}

// Pour éviter les notices dans la vue, j'initialise mon tableau de données

// Dont know what this does, but i changed the variables anyway
$filmInfos = array(
	'mov_post' => 0,
	'mov_title' => '',
	'mov_actors' => '',
	'mov_fileName' => '',
	'mov_rel' => '',
	'mov_plot' => ''
);



/// not used function: seb wrote nearly the same request
function getMovieInfos($id) {
	global $pdo;

	$sql = '
		SELECT mov_title, gen_name, mov_plot, mov_actors, mov_rel, sup_name, mov_fileName
		FROM movies
		INNER JOIN genres ON genres.gen_id = movies.genres_gen_id
		INNER JOIN support ON support.sup_id = movies.support_sup_id
	';

		$sth = $pdo->prepare($sql);
		$sth->bindValue(':movieId', $id,  PDO::PARAM_INT);

		if ($sth->execute() === false) {
			//print_r($pdo->errorInfo());
		}
		else {
			$movieDetail = $sth->fetch(PDO::FETCH_ASSOC);
		}
}

// A la fin, TOUJOURS, les vues
include dirname(dirname(__FILE__)).'/view/header.php';
include dirname(dirname(__FILE__)).'/view/add_movies.php';
include dirname(dirname(__FILE__)).'/view/footer.php';