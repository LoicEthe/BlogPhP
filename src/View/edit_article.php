<?php 


$title = "modification d'un article";
include 'header.php';


if (!empty($error_messages)) :?>
<div>
    <ul>
        <?php foreach ($error_messages as $msg) :?>
            <li><?= $msg ?></li>
            <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<form action="edit_article_controller.php?id=<?= $article->getId_article()?>" method="post" style="display: flex; flex-direction:column; width: 500px; height:300px">
    <input type="text" name="title" id="title" value="<?=$article->getTitle()?>">
    
    <textarea name="description" id="description" cols="30" rows="10" ><?=$article->getDescription()?></textarea>
    <input type="submit" value="Envoyer">
</form>

<?php include 'footer.php' ?>