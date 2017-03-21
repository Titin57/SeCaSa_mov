<?php

// Include config.php here
// double dirname to go to parent directory
require dirname(dirname(__FILE__)).'/inc/config.php';

/* // Code for this page here
$currentPage = '';

// Get all movies
$moviesList = array();
$sql = '
	SELECT * 
	FROM movies
	
';
$sth = $pdo->query($sql);
if ($sth === false) {
	print_r($sth->errorInfo());
}
else {
	while ($row = $sth->fetchAll(PDO::FETCH_ASSOC)) {
		$title = $row['tra_name'].' à '.$row['loc_name'];
		$moviesList[$title][] = $row;
	}
}
/*
// Stats nb students par ville
$sql = '
	SELECT count(*) as nb, cit_name
	FROM city
	INNER JOIN student ON student.city_cit_id = city.cit_id
	GROUP BY cit_name
	ORDER BY nb DESC, cit_name ASC
';
$sth = $pdo->query($sql);
if ($sth === false) {
	print_r($pdo->errorInfo());
}
else {
	$studentsVilleList = $sth->fetchAll(PDO::FETCH_ASSOC);
}*/

// FIN DE MON CODE POUR CETTE PAGE

// At the end, always all view pages */
include dirname(dirname(__FILE__)).'/view/header.php';
// include dirname(dirname(__FILE__)).'/view/home.php';
include dirname(dirname(__FILE__)).'/view/footer.php';