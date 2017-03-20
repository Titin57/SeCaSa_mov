<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Add a film</h3>
  </div>
  <div class="panel-body">
  	<?php /*if (!empty($errorList)) : ?>
		<div class="alert alert-danger" role="alert">
		  <?php foreach ($errorList as $currentErrorText) : ?>
		  	<?= $currentErrorText ?><br>
		  <?php endforeach; ?>
		</div>
  	<?php endif;*/ ?>
	<form action="" method="post" enctype="multipart/form-data">
		<?php if (!empty($filmInfos['mov_post'])) :?>
			<img src="<?= $filmInfos['mov_post'] ?>" alt="" height="140" style="display:block;margin:auto;" /><br>
		<?php endif; ?>
  		<div class="row">
	  		<div class="col-md-6 col-sm-6 col-xs-12">

				<div class="form-group">
					<label>movie title</label>
					<input type="text" class="form-control" name="mov_title" value="<?= $filmInfos['mov_title'] */?>" placeholder="movie title" />
				</div>

				<div class="form-group">
					<label>actors</label>
					<input type="text" class="form-control" name="mov_actors" value="<?= $filmInfos['mov_actors'] */?>" placeholder="actors" />
				</div>

				<div class="form-group">
					<label>file name</label>
					<input type="text" class="form-control" name="mov_fileName" value="<?= $filmInfos['mov_fileName'] ?>" placeholder="file name" />
				</div>

				<div class="form-group">
					<label>release date</label>
  					<input type="text" class="form-control" name="mov_rel" value="<?=$filmInfos['mov_rel'] ?>" placeholder="release date" />
  					<small class="form-text text-muted">format in YYYY-MM-DD (<?= date('Y-m-d') ?>)</small>
  				</div>
			</div>
	  		<div class="col-md-6 col-sm-6 col-xs-12">

				<div class="form-group">
					<label>genre</label>
                    <input type="text" class="form-control" name="gen_name" value="<?=$filmInfos['gen_name'] ?>" placeholder="genre" />

                    <!--
					<select name="stu_friendliness" class="form-control">
						<option value="">choisissez</option>
						<?php/*for($i=0;$i<=5;$i++) : ?>
							<option value="<?= $i ?>"<?= $studentInfos['stu_friendliness'] == $i ? ' selected=selected"' : '' ?>><?= getSympathieName($i) ?></option>
						<?php endfor; */?>
					</select>
                    -->
				</div>

				<div class="form-group">
					<label>film plot</label>
					<textarea rows="4" cols="50"  class="form-control" name="mov_plot" value="<?=$filmInfos['mov_plot'] ?>" placeholder="film plot" >
                    </textarea>
				</div>


				<div class="form-group">
					<label>Image</label>
					<input type="file" name="stu_image" placeholder="Image" />
				</div>
			</div>
		</div>
		<?php

        if (!empty($filmInfos['film_id'])) : ?>
			<input type="submit" class="btn btn-success btn-block" value="Modify" />
    	<?php else : ?>
			<input type="submit" class="btn btn-success btn-block" value="Ajdd" />
		<?php endif; */?>
	</form>
  </div>
</div>