<?php 

require_once "PDO/pdo_dao.php";


function get_commentaire_by_article_id(int $article_id): array{
    $dbh = getPDO();

    $req = $dbh->prepare("SELECT * FROM commentaire WHERE id_article = :article_id ORDER BY date_creation DESC");
    
    $req->bindValue(":article_id",$article_id);
    $req->execute();

    return $req->fetchAll(PDO::FETCH_ASSOC);

}

function add_commentaire(array $commentaire) : void{
    $dbh = getPDO();

    $req = $dbh->prepare("INSERT INTO commentaire (contenu,id_article) VALUES (:contenu, :id_article)");

    $req->execute([
        ":contenu" => $commentaire["contenu"],
        ":id_article"=> $commentaire['article_id']
    ]);
}

function get_commentaire_by_id(int $id): array
{
    $dbh = getPDO();
    $req = $dbh->prepare("SELECT * FROM commentaire WHERE id_commentaire = :id");
    $req->execute([":id" => $id]);
    return $req->fetch(PDO::FETCH_ASSOC);
}

function update_commentaire(array $commentaire): void
{
    $dbh = getPDO();
    $req = $dbh->prepare("UPDATE commentaire
                         SET contenu = :contenu
                         WHERE id_commentaire = :id_commentaire
    ");
    $req->execute([
        ":contenu" => $commentaire["contenu"],
        ":id_commentaire" => $commentaire["id_commentaire"]
    ]);
}



function delete_comment(int $id): void{
    $dbh = getPDO();

    $req = $dbh->prepare("DELETE  FROM commentaire 
                        WHERE id_commentaire = :commentaire_id");

    $req->execute([":id_commentaire" => $id]);
}
