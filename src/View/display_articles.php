<?php 
$title = "Liste des articles";
include 'header.php';
?>


<?php
foreach ($articles as $article): ?>

<article>
    <h1><?= trim(filter_var($article->getTitle(),FILTER_SANITIZE_FULL_SPECIAL_CHARS))?></h1>
    <p><?= nl2br(trim(filter_var($article->getDescription(),FILTER_SANITIZE_FULL_SPECIAL_CHARS)))?></p> <!--FILTRE POUR AVOIR UN SAUT A LA LIGNE-->
    <a href="display_one_article_controller.php?id=<?= $article->getId_article() ?>"> <!--Creation du lien html qui se transeformera automatiquement avec l'id choisi -->
        <button id="more" type="submit">En savoir plus</button>
    </a>

</article>

<?php endforeach;?>

  
<?php include 'footer.php'; ?>