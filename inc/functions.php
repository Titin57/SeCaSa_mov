<?php

// Filter the User inputs
function filterStringInputPost($name, $defaultValue='') {
	$getValue = filter_input(INPUT_POST, $name);
	if ($getValue !== false) {
		return trim(strip_tags($getValue));
	}
	return $defaultValue;
}



// Function to get all support Mediums from DB
function getAllSupport() {
	global $pdo;

	$sql = '
		SELECT sup_id, sup_name
		FROM support
	';

		$sth = $pdo->prepare($sql);

		if ($sth->execute() === false) {
			//print_r($pdo->errorInfo());
		}
		else {
			$movieSupport = $sth->fetchAll(PDO::FETCH_ASSOC);
			//print_r ($movieSupport);
			return $movieSupport;
		}
	return false;
}

// Function to get all film genres from DB
function getAllGenres() {
	global $pdo;

	$sql = '
		SELECT gen_id, gen_name
		FROM genres
	';

	$sth = $pdo->prepare($sql);

	if ($sth->execute() === false) {
		//print_r($pdo->errorInfo());
	}
	else {
		$movieGenres = $sth->fetchAll(PDO::FETCH_ASSOC);
		//print_r ($movieGenres);
		return $movieGenres;
	}
	return false;
}

function askImdb($userInputFilm){

	$searchString = 'http://www.omdbapi.com/?t='.$userInputFilm;
	//echo $searchString;

	$json = file_get_contents($searchString);
	//echo $json.'<br>';

	// Get it as object
	$object = json_decode($json);
	//var_dump($object);
	// J'affiche le genre

/*
	echo 'Title: '.$object->Title.'<br>';
	echo 'Actors: '.$object->Actors.'<br>';
	echo 'Released: '.$object->Released.'<br>';
	echo 'Plot: '.$object->Plot.'<br>';
	echo 'Actors: '.$object->Actors.'<br>';


	echo 'Genre: '.$object->Genre.'<br>';
*/

	/*
	// Get it as array
	$array = json_decode($json, true);
	var_dump($array);
	// J'affiche le genre
	echo 'Genre: '.$array['Genre'].'<br>';
	*/

}


function addMovie(
			$mov_post,
			$mov_title,
			$mov_actors,
			$mov_fileName,

			$mov_rel,
			$mov_plot,
			$genres_gen_id,
			$support_sup_id
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
							mov_plot,
							genres_gen_id,
							support_sup_id
							)

		VALUES (:mov_post,
				:mov_title,
				:mov_actors,
				:mov_fileName,

				:mov_rel,
				:mov_plot,
				:genres_gen_id,
				:support_sup_id)
	';
	$sth = $pdo->prepare($sql);
	$sth->bindValue(':mov_post', $mov_post);
	$sth->bindValue(':mov_title', $mov_title);
	$sth->bindValue(':mov_actors', $mov_actors);
	$sth->bindValue(':mov_fileName', $mov_fileName);

	$sth->bindValue(':mov_rel', $mov_rel);
	$sth->bindValue(':mov_plot', $mov_plot);
	$sth->bindValue(':genres_gen_id', $genres_gen_id, PDO::PARAM_INT);
	$sth->bindValue(':support_sup_id', $support_sup_id, PDO::PARAM_INT);

	/*
	I didnt check the parameter genre like we did in class :
	//$sth->bindValue(':cit_id', $cityId, PDO::PARAM_INT);
*/

	if ($sth->execute() === false) {
		print_r($sth->errorInfo());
	}
	else {
			// Je récupère l'ID auto-incrémenté
			return $pdo->lastInsertId();

		}
			/*
		*/
	return false;
};






/////////////////  OLD STUFF  ///////////////////////////
///////////////  PROJET TOTO  ///////////////////////////




// Function to introduce Film data into DB (still in public\add_movies)
/*
function addFilm(...){};
*/


// Fonction permettant de retourner le nom/titre (text) d'une sympathie (int)
/*
function getSympathieName($sympathie) {
	switch ($sympathie) {
		case 0:
			return 'Insupportable';
		case 1:
			return 'Antipathique';
		case 2:
			return 'Pas sympa';
		case 3:
			return 'Neutre';
		case 4:
			return 'Sympa';
		case 5:
			return 'Génial !!!';
		default:
			return 'NC';
	}
}

// Fonction permettant de calculer l'age à partir d'une date au format timestamp
function getAgeFromTimestamp($timestamp) {
	if ($timestamp < time()) {
		$diff = time() - $timestamp;
		return floor($diff / (365*86400));
	}

	return '-';
}

function filterStringInputPost($name, $defaultValue='') {
	$getValue = filter_input(INPUT_POST, $name);
	if ($getValue !== false) {
		return trim(strip_tags($getValue));
	}
	return $defaultValue;
}
function filterIntInputPost($name, $defaultValue=0) {
	$getValue = filter_input(INPUT_POST, $name);
	if ($getValue !== false) {
		return intval(trim($getValue));
	}
	return $defaultValue;
}

// Fonction permettant de retourner les informatiosn sur un étudiant
function getStudentInfos($id) {
	global $pdo;

	$sql = '
		SELECT stu_id, stu_lastname, stu_firstname, stu_email, stu_birthdate, stu_friendliness, stu_image, cit_name, session_ses_id, city_cit_id
		FROM student
		INNER JOIN city ON city.cit_id = student.city_cit_id
		WHERE stu_id = :studentId
	';
	$sth = $pdo->prepare($sql);
	$sth->bindValue(':studentId', $id,  PDO::PARAM_INT);

	if ($sth->execute() === false) {
		print_r($pdo->errorInfo());
	}
	else {
		$studentInfos = $sth->fetch(PDO::FETCH_ASSOC);
		// Calcule l'age avec la fonction "getAgeFromTimestamp"
		$studentInfos['age'] = getAgeFromTimestamp(strtotime($studentInfos['stu_birthdate']));

		return $studentInfos;
	}
}

function getAllSessions() {
	global $pdo;

	$sessionsList = array();
	$sql = '
		SELECT ses_id, ses_number, loc_name
		FROM session
		INNER JOIN location ON location.loc_id = session.location_loc_id
		ORDER BY loc_id ASC, ses_id DESC
	';
	$sth = $pdo->query($sql);
	if ($sth === false) {
		print_r($pdo->errorInfo());
	}
	else {
		while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
			$sessionsList[$row['ses_id']] = $row['loc_name'].' #'.$row['ses_number'];
		}
		return $sessionsList;
	}
}

function getAllCities() {
	global $pdo;

	$citiesList = array();
	$sql = '
		SELECT cit_id, cit_name
		FROM city
		ORDER BY cit_name ASC
	';
	$sth = $pdo->query($sql);
	if ($sth === false) {
		print_r($pdo->errorInfo());
	}
	else {
		while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
			$citiesList[$row['cit_id']] = $row['cit_name'];
		}

		return $citiesList;
	}
}

function addStudent($lastname,$firstname,$email,$birthdate,$friendliness,$sessionId,$cityId) {
	global $pdo;

	$sql = '
		INSERT INTO student (stu_lastname, stu_firstname, stu_email, stu_birthdate, stu_friendliness, session_ses_id, city_cit_id)
		VALUES (:lastname, :firstname, :email, :birthdate, :friendliness, :ses_id, :cit_id)
	';
	$sth = $pdo->prepare($sql);
	$sth->bindValue(':lastname', $lastname);
	$sth->bindValue(':firstname', $firstname);
	$sth->bindValue(':email', $email);
	$sth->bindValue(':birthdate', $birthdate);
	$sth->bindValue(':friendliness', $friendliness, PDO::PARAM_INT);
	$sth->bindValue(':ses_id', $sessionId, PDO::PARAM_INT);
	$sth->bindValue(':cit_id', $cityId, PDO::PARAM_INT);

	if ($sth->execute() === false) {
		print_r($sth->errorInfo());
	}
	else {
		// Je récupère l'ID auto-incrémenté
		return $pdo->lastInsertId();
	}

	return false;
}

function updateStudent($id,$lastname,$firstname,$email,$birthdate,$friendliness,$sessionId,$cityId) {
	global $pdo;

	$sql = '
		UPDATE student
		SET stu_lastname = :lastname,
		stu_firstname = :firstname,
		stu_email = :email,
		stu_birthdate = :birthdate,
		stu_friendliness = :friendliness,
		session_ses_id = :ses_id,
		city_cit_id = :cit_id
		WHERE stu_id = :id
	';
	$sth = $pdo->prepare($sql);
	$sth->bindValue(':id', $id);
	$sth->bindValue(':lastname', $lastname);
	$sth->bindValue(':firstname', $firstname);
	$sth->bindValue(':email', $email);
	$sth->bindValue(':birthdate', $birthdate);
	$sth->bindValue(':friendliness', $friendliness, PDO::PARAM_INT);
	$sth->bindValue(':ses_id', $sessionId, PDO::PARAM_INT);
	$sth->bindValue(':cit_id', $cityId, PDO::PARAM_INT);

	if ($sth->execute() === false) {
		print_r($sth->errorInfo());
	}
	else {
		return true;
	}

	return false;
}

function updateStudentImageFilename($id,$image) {
	global $pdo;

	$sql = '
		UPDATE student
		SET stu_image = :image
		WHERE stu_id = :id
	';
	$sth = $pdo->prepare($sql);
	$sth->bindValue(':id', $id);
	$sth->bindValue(':image', $image);

	if ($sth->execute() === false) {
		print_r($sth->errorInfo());
	}
	else {
		return true;
	}

	return false;
}

function deleteStudent($id) {
	global $pdo;

	$sql = '
		DELETE FROM student WHERE stu_id = :id
	';
	$sth = $pdo->prepare($sql);
	$sth->bindValue(':id', $id, PDO::FETCH_ASSOC);
	if ($sth->execute() === false) {
		print_r($sth->errorInfo());
	}
	else {
		return $sth->rowCount() > 0;
	}

	return false;
}

// Fonction permettant de savoir si un email existe ou non dans la DB
function emailExists($email) {
	global $pdo;

	$sql = '
		SELECT usr_id
		FROM user
		WHERE usr_email = :email
	';
	$sth = $pdo->prepare($sql);
	$sth->bindValue(':email', $email);

	// Si erreur !!!!
	if ($sth->execute() === false) {
		print_r($sth->errorInfo());
	}
	// Si la requête s'est bien exécutée
	else {
		// Si au moins 1 ligne => email exists
		if ($sth->rowCount() > 0) {
			return true;
		}
		else {
			return false;
		}
	}
}
*/