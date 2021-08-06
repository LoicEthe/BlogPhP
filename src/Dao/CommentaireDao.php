<?php 

namespace dao;

use model\Commentaire;
use PDO;

class CommentaireDao{

    private $pdo;

    public function __construct()
    {
        $conf = [
            "dsn" => "mysql:host=localhost; dbname=ccib; charset=UTF8",
            "user" => "root",
            "password" => "",
        ];
        $options =  [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        $this->pdo = new PDO(
            $conf["dsn"], 
            $conf["user"], 
            $conf["password"], 
            $options
        );
    }

    function getCommentaireByArticleById(int $article_id): array{
    
        $req = $this->pdo->prepare("SELECT * FROM commentaire WHERE id_article = :article_id ORDER BY date_creation DESC");
        
        $req->bindValue(":article_id",$article_id);
        $req->execute();
    
        return $req->fetchAll(PDO::FETCH_ASSOC);
    
    }
    
    
    function addCommentaire(Commentaire $commentaire){
      
        $req = $this->pdo->prepare("INSERT INTO commentaire (contenu,id_article) VALUES (:contenu, :id_article)");
    
        $req->execute([
            ":contenu" => $commentaire->getContenu(),
            ":id_article"=> $commentaire->getId_article()
        ]);
    }
    
    function getCommentaireById(int $id): array
    {
       
        $req = $this->pdo->prepare("SELECT * FROM commentaire WHERE id_commentaire = :id");
        $req->execute([":id" => $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }
    
    function updateCommentaire(array $commentaire): void
    {

        $req = $this->pdo->prepare("UPDATE commentaire
                             SET contenu = :contenu
                             WHERE id_commentaire = :id_commentaire
        ");
        $req->execute([
            ":contenu" => $commentaire["contenu"],
            ":id_commentaire" => $commentaire["id_commentaire"]
        ]);
    }
    
    function deleteCommentaire(int $id):void{
    
        $req = $this->pdo->prepare("DELETE FROM commentaire 
                            WHERE id_commentaire = :id_commentaire");
    
        $req->execute([":id_commentaire" => $id]);
    }
    


}
