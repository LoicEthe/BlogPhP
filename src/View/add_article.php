<?php 
$titre = "Ajout d'un nouvel article";
include 'header.php' 

?> 
    <?php if(!empty($error_messages)) : ?>
        <div>
            <?php foreach ($error_messages as $mgs):?>
            <h3><?=$mgs?></h3> 
            <?php endforeach;?>
        </div>
    <?php endif;?>
    
    <form action="" method="post" style="display:flex; flex-direction:column; width:300px;">
        <label for="title">Titre :</label>
        <input type="text" name="title">

        <label for="description">Description :</label>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>

        <input type="submit" value="Envoyer">
    </form>


 
<?php include 'footer.php' ?>