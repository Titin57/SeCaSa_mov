<?php

// Include config.php here
// double dirname to go to parent directory
require dirname(dirname(__FILE__)).'/inc/config.php';

// Stats nb genres
/* Code for link max movies by genre
		4 results should be shown 
		get all genre by name  */

	$genreList = array();
	$sql = '
		SELECT COUNT(*) AS nb, gen_name
		FROM genres
		INNER JOIN movies ON genres.gen_id = movies.genres_gen_id
		GROUP BY gen_name
		ORDER BY nb DESC, gen_name ASC
		LIMIT 4
	';
	$sth = $pdo->query($sql);
	if ($sth === false) {
		print_r($pdo->errorInfo());
	}
	else {
		$genreList = $sth->fetchAll(PDO::FETCH_ASSOC);
		
	}

/* Stats nb movies (limit to 4 movies)
 	Code for movies here
	results should be shown get all movies by name 
	Limit to 4 movies */

	$moviesList = array();
	$sql = '
		SELECT mov_title, mov_post
		FROM movies
		GROUP BY mov_title
		ORDER BY mov_title ASC
		LIMIT 4
	';
	$sth = $pdo->query($sql);
	if ($sth === false) {
		print_r($pdo->errorInfo());
	}
	else {
		$moviesList = $sth->fetchAll(PDO::FETCH_ASSOC);
		
	}

		
// FIN DE MON CODE POUR CETTE PAGE

// At the end, always all view pages */
include dirname(dirname(__FILE__)).'/view/header.php';
include dirname(dirname(__FILE__)).'/view/home.php';
include dirname(dirname(__FILE__)).'/view/footer.php';