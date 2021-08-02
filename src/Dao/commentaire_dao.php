<?php 

require_once "PDO/pdo_dao.php";


function get_commentaire_by_article_id(int $article_id): array{
    $dbh = getPDO();

    $req = $dbh->prepare("SELECT * FROM commentaire WHERE id_article = :article_id ORDER BY date_creation DESC");
    
    $req->bindValue(":article_id",$article_id);
    $req->execute();

    return $req->fetchAll(PDO::FETCH_ASSOC);

}

function add_commentaire(){
    
}