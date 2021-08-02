<?php 

require_once "PDO/pdo_dao.php";

function add_article(string $title, string $description)
{
    $dbh = getPDO();

    $req = $dbh->prepare("INSERT INTO article (title, description) VALUES (:title, :description)");

    $req->execute([
        ":title" => $title,
        ":description" => $description
    ]);
}

function get_all_article(): array{
    $dbh = getPDO();

    $req = $dbh->prepare("SELECT * FROM article");
    $req->execute();
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function get_article_by_id($id){
    $dbh = getPDO();

    $req = $dbh->prepare("SELECT * FROM article WHERE id_article = :id");
    $req->bindValue(":id",$id);
    $req->execute();
    $result = $req->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function update_article(array $article) : void{

    $dbh = getPDO();
    $req = $dbh->prepare("UPDATE article 
                          SET title = :title, description = :description
                          WHERE id_article = :id");
    $req->execute([
        ":title"=>$article['title'],
        ":description"=>$article['description'],
        ":id"=>$article['id_article']
    ]);
}

function delete_article(int $id): void{
    $dbh = getPDO();

    $req = $dbh->prepare("DELETE FROM article 
                        WHERE id_article = :id_article");

    $req->execute([":id_article" => $id]);
    
}