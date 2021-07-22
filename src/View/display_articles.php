<?php

$title = "Ajout d'un nouvel article";
include 'header.php' ;

foreach($articles as $article) : ?>
<article>
    <h1><?= $article['title']?></h1>
    <p><?= $article['description']?></p>
    <a href="display_one_article_controller.php?id=<?= $article['id_article']?>"><button>En savoir +</button></a>
</article>

<?php endforeach;  



include 'footer.php' ?>
