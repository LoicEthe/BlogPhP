<!-- SI PAS CONNECTE ALORS-->
<div class="nav">
<?php if(!isset($_SESSION["user"])) : ?>
<a href="signup_controller.php"><button id="user">S'enregistrer</button></a>
<a href="signin_controller.php"><button id="signin">Se connecter</button></a>
</div>
<!-- SI CONNECTE ALORS-->
<?php else : ?>
<div class="nav2">
<a href="display_articles_controller.php"><button>Accueil</button></a>
<a href="add_article_controller.php"><button>Ajouter un article</button></a>
<a href="show_users_controller.php"><button>Voir liste utilisateurs</button></a>
<a href="show_one_user_controller.php?id=<?=unserialize($_SESSION["user"])->getId_user(); ?>"><button>Afficher mon profil</button></a>
<a href="signout_controller.php"><button>Se déconnecter</button></a>
<?php endif; ?>
</div>