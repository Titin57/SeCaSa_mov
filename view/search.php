<?php

// Include config.php here
// double dirname to go to parent directory
require dirname(dirname(__FILE__)).'/inc/config.php';

$search = $_GET["search"]; 
if(!empty($search))
{
    $query = mysql_query("
    	SELECT * FROM movies 
    	WHERE mov_title 	
    	LIKE('%" . simple_protect($search) . "%') ORDER BY mov_title") or die (mysql_error()); 
    while ($row = mysql_fetch_assoc($query))
    { //echo $query;
    echo strip_all($row['mov_title'])."\n";
    }
}
else
{
    echo "No Records available";
}


// At the end, always all view pages */
include dirname(dirname(__FILE__)).'/view/header.php';
include dirname(dirname(__FILE__)).'/view/search.php';
include dirname(dirname(__FILE__)).'/view/footer.php';