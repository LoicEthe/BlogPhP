<?php
$title = sprintf("Modif article n° %d", $article['id_article']);

include 'header.php';
?>
<article>
    <h2><?=$article["title"]?></h2>
    <p><?= nl2br(trim(filter_var($article["description"],FILTER_SANITIZE_FULL_SPECIAL_CHARS)))?></p>
    
    <em><?=$article["date_creation"]?></em>
    
    <a href="edit_article_controller.php?id=<?= $article['id_article'] ?>">
    <button>Editer l'article</button>
    </a>
    
    <a href="delete_article_controller.php?id=<?= $article['id_article'] ?>">
    <button>Supprimer l'article</button>
    </a>
    
</article>

<?php if(!empty($commentaires)) : ?>
    <div>
        <?php foreach ($commentaires as $commentaire) : ?>
        <div><span><?= $commentaire["date_creation"] ?></span>
            <p><?=  $commentaire["contenu"] ?></p>
        </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>    

<?php include 'footer.php';?>