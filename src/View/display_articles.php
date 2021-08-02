<?php 
$title = "Liste des articles";
include 'header.php';


foreach ($articles as $article): ?>

<article>
    <h1><?= $article["title"] ?></h1>
    <p><?= nl2br(trim(filter_var($article["description"],FILTER_SANITIZE_FULL_SPECIAL_CHARS)))?></p> <!--FILTRE POUR AVOIR UN SAUT A LA LIGNE-->
    <a href="display_one_article_controller.php?id=<?= $article['id_article'] ?>"> <!--Creation du lien html qui se transeformera automatiquement avec l'id choisi -->
        <button type="submit">En savoir plus</button>
    </a>

</article>

<?php endforeach;?>

  
<?php include 'footer.php'; ?>