
<section>
	<!-- page top : profile picture, first & last name -->
	<img src="img_profil/<?= $page["picture"] ?>" alt="" width="40px">
	<img src="img_baniere/<?= $page["banner"] ?>" alt="" >
</section>
<h1 id="h1"><?=$h1?></h1>
<!-- stats -->
<section> 
<div> <?=$page["name"]?> compte <?=$nb_articles?> articles. </div>
<div> <?=$page["name"]?> est suivie par <?=$nb_followers?> personnes. </div>
</section> <br> <!-- we will remove this br when the css is done-->
<section>
	<div>
	<!-- interactions -->
		<?php if ($is_follower) :?>
			<!-- unfollow -->
			<form action="/unfollow" class="form" method="post" >
				<button type="submit" id="unfollow" name="unfollow">
					Ne plus suivre cette page
				</button>
				<input type="hidden" name="unfollow" value="<?= $page_id ?>">
			</form>
			<!-- i leave that here because we may use it for the group's page later, and i don't want to type it again -->
			<!-- <form action="/start_chat" class="form" method="post" >
				<button type="submit" id="start_chat" name="start_chat">
					Démarrer la conversation
				</button>
				<input type="hidden" name="start_chat" value="<?= $user_id ?>">
			</form> -->
		<?php else :?>
			<form action="/follow" class="form" method="post" >
				<button type="submit" id="follow" name="follow">
					Suivre cette page
				</button>
				<input type="hidden" name="follow" value="<?= $page_id ?>">
			</form>
		<?php endif ?>
	</div>
</section>
<section>
	<!-- main page -->
	<div>
	<!-- articles -->
		<div>
		<!-- new article -->
			<!-- Form new article: needs to be modified to match a page -->
			<?php if ($is_admin) :?>
			<form id="newPublicationForm" method="post" enctype="multipart/form-data" action="/new_article">
				<label id="publicationLabel" for="articleInput">Ecrivez votre message</label><br>
				<textarea id="articleInput" name="articleInput" type="text"></textarea>
				<div id="depose">Déposez vos images ou cliquez pour choisir</div>
				<input type="file" name="fileToUpload" id="fileToUpload" accept="image/jpeg, image/png, image/gif, image/jpg">
				<div id="preview"></div>
				<button type="submit" id="submitPublication">Envoyer</button>
				<button id="cancel">Annuler</button>
			</form>
			<?php endif ?>
		</div>
		<div>
			<!-- past articles -->
			<?php foreach ($articles as $article): ?>
				<div id="article" style="margin-top:20px; border: solid 1px black; padding: 10px; width: 500px">
					<form id="goToProfile" action="/profile" method="post"> <!-- needs to be modified to match a page -->
						<input type="hidden" name="profil_id" value="<?= $page_id ?>" />
						<button type="submit" id="profil_picture" style="background: white; border:0; padding:5px;">
							<img src="img_profil/<?= $page["picture"] ?>" alt="" width="40px">
						</button>
						<button type="submit" id="first_name" style="background: white; border:0; padding:0;"> 
							<?= $page["name"] ?> 
						</button>
					</form>
					<span id="date"><?= $article["date"] ?></span>
					<br>
					<span id="data"><?= $article["content"] ?></span>
					<br>
					<?php if($article["picture"]) :?>
						<img id="image_article" width="300px" src="img_post/<?=$article["picture"]?>" >
					<?php endif; ?>
					<?php if($is_admin) :?>
						<form id="delete_article" method="post" action="/delete_article">
							<button type="submit" id="delete_btn">Supprimer</button>
							<input type="hidden" name="article_id" value="<?=$article["article_id"]?>">
							<input type="hidden" name="article_user" value="<?=$article["user_id"]?>">
						</form>
					<?php endif ?>
				</div>
			<?php endforeach;?>
		</div>
	</div>
	<div>
	<!-- stats -->
		<div>
		<!-- articles published through time -->
		</div>
		<div>
		<!-- likes / the person put through time -->
		</div>
		<div>
		<!-- likes / the person obtained through time -->
		</div>
	</div>
</section>
