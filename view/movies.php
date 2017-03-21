


<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><?= $movieDetail['mov_title'] ?></h3>
  </div>
  <div class="panel-body">

    affiche :<img src="<?= $array['Poster'] ?>"></img><br>
  
    Categorie : <?= $movieDetail['gen_name'] ?><br>
    Plot : <?= $movieDetail['mov_plot'] ?><br>
    Acteurs : <?= $movieDetail['mov_actors'] ?> <br>
    Date de sortie : <?= $movieDetail['mov_rel'] ?><br>
    Support : <?= $movieDetail['mov_fileName'] ?><br>
    <br>
  </div>
<a href="" class="btn btn-success btn-block">Modifier</a>
</div>