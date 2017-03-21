<?php

// Inclusion de config.php
require dirname(dirname(__FILE__)).'/inc/config.php';

$currentPage = 'Détail du film';


	global $pdo;
	$id=1;

	$sql = '
		SELECT mov_title, gen_name, mov_plot, mov_actors, mov_rel, sup_name, mov_fileName
		FROM movies
		INNER JOIN genres ON genres.gen_id = movies.genres_gen_id
		INNER JOIN support ON support.sup_id = movies.support_sup_id
		WHERE mov_id = :movieId
	';

		$sth = $pdo->prepare($sql);
		$sth->bindValue(':movieId', $id,  PDO::PARAM_INT);

		if ($sth->execute() === false) {
			print_r($pdo->errorInfo());
		}
		else {
			$movieDetail = $sth->fetch(PDO::FETCH_ASSOC);

		}


// Si detail
/*if (isset($_GET['detailId'])) {
	$id = intval($_GET['detailId']);
}

// Je récupère le paramètre dans l'URL
$movieId = isset($_GET['id']) ? intval($_GET['id']) : 0;

$movieDetail = getMoviesInfo($movieId);*/

$json = file_get_contents('http://www.omdbapi.com/?t=invasion+U.S.A.');

$array = json_decode($json, true);

// A la fin, TOUJOURS, les vues
include dirname(dirname(__FILE__)).'/view/header.php';
include dirname(dirname(__FILE__)).'/view/movies.php';
include dirname(dirname(__FILE__)).'/view/footer.php';