<?php
namespace src\Model;

class Categorie {
    private $Categorie;

    public function SqlAdd(\PDO $bdd){
        try {
            $requete = $bdd->prepare("INSERT INTO categories (Categorie) VALUES(:Categorie)");

            $requete->execute([
                "Categorie" => $this->getCategorie(),
            ]);
            return $bdd->lastInsertId();
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }

    public function SqlUpdate(\PDO $bdd){
        try {
            $requete = $bdd->prepare("UPDATE categories set Categorie = :Categorie");

            $requete->execute([
                "Categorie" => $this->getCategorie(),
                "Id" => $this->getId()
            ]);
            return "OK";
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }
    /**
     * Récupère toutes les catégories
     * @param \PDO $bdd
     * @return array
     */
    public function SqlGetAll(\PDO $bdd){
        $requete = $bdd->prepare("SELECT * FROM categories");
        $requete->execute();
        //$datas =  $requete->fetchAll(\PDO::FETCH_ASSOC);
        $datas =  $requete->fetchAll(\PDO::FETCH_CLASS,'src\Model\Categorie');
        return $datas;

    }

    public function SqlGetById(\PDO $bdd, $Id){
        $requete = $bdd->prepare("SELECT * FROM categories WHERE Id=:Id");
        $requete->execute([
            "Id" => $Id
        ]);
        $requete->setFetchMode(\PDO::FETCH_CLASS,'src\Model\Categorie');
        $categorie = $requete->fetch();

        return $categorie;
    }

    public function SqlDeleteById(\PDO $bdd, $Id){
        $requete = $bdd->prepare("DELETE FROM categories WHERE Id=:Id");
        $requete->execute([
            "Id" => $Id
        ]);
        return true;
    }
    public function SqlTruncate(\PDO $bdd){
        $requete = $bdd->prepare("TRUNCATE TABLE categories");
        $requete->execute();
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param mixed $Id
     * @return Categorie
     */
    public function setId($Id)
    {
        $this->Id = $Id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->Categorie;
    }

    /**
     * @param mixed $Categorie
     * @return Categorie
     */
    public function setCategorie($Categorie)
    {
        $this->Categorie = $Categorie;
        return $this;
    }






}
