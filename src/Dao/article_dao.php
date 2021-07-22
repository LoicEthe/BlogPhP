<?php

function getPDO(){
    static $dbh = "";
    
    if(!($dbh instanceof PDO)){
        $dbh = new PDO(
            "mysql:host=localhost; dbname=ccib; charset=UTF8",
            "loiceth",
            "ccipe",
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
    return $dbh;
}

function add_article(string $title, string $description):void {
    $dbh = getPDO();

    $req = $dbh->prepare("INSERT INTO article (title, description) 
                        VALUES (:title, :description)");
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

function get_article_by_id(int $id){
    $dbh = getPDO();

    $req = $dbh->prepare("SELECT * FROM article WHERE id_article = $id");

    $req->execute();
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function update_article(){}

function delete_article(){}