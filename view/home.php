<!--- The home.php page shows following items:
	a) inlcude header.php with 3 links (Home, Genres, Add a Movie) and a search field to search the local DB
	b) a description field for the project
--> 

<div class="jumbotron">
	<h2>Project: Movie database.</h2>
	<div class="container">
		<p>The database contains a movie collection.
		In this project, the database can be populated with all data related to the movie like ...</p>
		<p>... title, release date, movie descritpion, actor(s), genre(s), on which support the movie can be found ...</p>
		<p>... and much more ...</p>
	</div>
</div>

<!--- Search field start here -->

<form action="list.php" class="navbar-form navbar-center " method="get">
	<div class="form-group">
		<input type="text" name="s" class="form-control input-lg" placeholder="Search">
	</div>
	<button type="submit" class="btn btn-success btn-lg">OK</button>
</form>

<!--- Search stops here -->

<div>
	
	<?php foreach ($genreList as $row) : ?>
	<tr>
		<!--- href to the genre summary page -->
		<a href = ''><td><?= $row['gen_name'] ?></td><a/>
		<td><?= $row['nb'] ?></td>
	</tr>
	<?php endforeach; ?>
</div>
<!--- end of max movies by genre code here -->

<!--- Code for thumbnails of 4 movies here with title- displayed randomly ... --> 
<div>
	<h3>Movies </h3>
</div>
<div>
	

	<?php foreach ($moviesList as $row) : ?>
		<!--- href to the movie detail page -->
		<a href = ''><img src='<?= $row['mov_post'] ?>' style ='width: 100px; height: 100px' ></img></a>
		<td><?= $row['mov_title'] ?></td>
	<?php endforeach; ?>

</div>

<!--- end of thumbnail code here -->
