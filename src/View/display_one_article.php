<?php
$title = sprintf("Modif article n° %d", $article['id_article']);

include 'header.php';
?>
<article>
    <h2><?=$article["title"]?></h2>
    <p><?= nl2br(trim(filter_var($article["description"],FILTER_SANITIZE_FULL_SPECIAL_CHARS)))?></p>
    
    <em><?=$article["date_creation"]?></em>
    
</article>
<a href="edit_article_controller.php?id=<?= $article['id_article'] ?>">
    <button id="edit">Editer l'article</button>
    </a>
    
    <a href="delete_article_controller.php?id=<?= $article['id_article'] ?>">
    <button id="delete">Supprimer l'article</button>
    </a>

    <a href="add_commentaire_controller.php?id=<?= $article['id_article'] ?>">
    <button id="add">Ajouter un commentaire</button>
    </a>

<?php if(!empty($commentaires)) :  ?> <h2>COMMENTAIRES</h2>
    <div>
        <?php foreach ($commentaires as $commentaire) : ?>
        <div class="comments"><span><?= $commentaire["date_creation"] ?></span>
            <p><?=  $commentaire["contenu"] ?></p>

            <a href="delete_commentaire_controller.php?article=<?= $article["id_article"] ?>&amp;id=<?=$commentaire["id_commentaire"]?>">
            <button id="delete">Supprimer un commentaire</button>
            </a>
            <a href="edit_commentaire_controller.php?article=<?= $article["id_article"] ?>&amp;id=<?=$commentaire["id_commentaire"]?>">
            <button id="edit" >Modifier un commentaire</button>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>    

<?php include 'footer.php';?>