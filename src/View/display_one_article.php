<?php
$title = sprintf("Modif article n° %d", $article['id_article']);

include 'header.php';
?>

    <h2><?=$article["title"]?></h2>
    <p><?=$article["description"]?></p>
    <em><?=$article["date_creation"]?></em>
    <a href="edit_article_controller.php?id=<?= $article['id_article'] ?>">
    <button>Editer l'article</button>
    </a>
    <a href="delete_article_controller.php?id=<?= $article['id_article'] ?>">
    <button>Supprimer l'article</button>
    </a>

<?php
include 'footer.php';?>