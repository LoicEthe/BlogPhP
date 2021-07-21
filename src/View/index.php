<?php 
$title = "Welcome"; // balise title qui change
include 'header.php' // joint le fichier header
?>
    <div>
        <h1><?= filter_input(INPUT_POST,"title"); ?></h1>
        <p><?= filter_input(INPUT_POST,"desc")?></p>
    </div> 
   
<?php include 'footer.php' ?> <!-- Joint le fichier footer -->