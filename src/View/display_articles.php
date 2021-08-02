<?php 
$title = "Liste des articles";
include 'header.php';


foreach ($articles as $article): ?>

<article>
    <h1><?= $article["title"] ?></h1>
    <p><?= $article["description"] ?></p>

    <a href="display_one_article_controller.php?id=<?= $article['id_article'] ?>"> <!--Creation du lien html qui se transeformera automatiquement avec l'id choisi -->
        <button type="submit">En savoir plus</button>
    </a>

</article>

<?php endforeach;?>

  
<?php include 'footer.php'; ?>