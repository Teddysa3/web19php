<?php
namespace src\Controller;

use src\Model\Categorie;
use src\Model\BDD;

class CategorieController extends AbstractController {

    public function Add(){
        if($_POST){
            $objCategorie = new Categorie();
            $objCategorie->setCategorie($_POST["Categorie"]);
            //Exécuter l'insertion
            $id = $objCategorie->SqlAdd(BDD::getInstance());
            // Redirection
            header("Location:/categorie/show/$id");
        }else{
            return $this->twig->render("Categorie/add.html.twig");
        }


    }

    public function All(){
            if($_POST){
                $categories = new Categorie();
                $datas = $categories->SqlGetAll(BDD::getInstance());
                // Redirection
                header("Location:/categorie/show/$id");
            }else{
                return $this->twig->render("Categorie/all.html.twig", [
                            "categorieList"=>$datas
                        ]);
                    }
         }


    public function Show($id){
        $categories = new Categorie();
        $datas = $categories->SqlGetById(BDD::getInstance(),$id);

        return $this->twig->render("Categorie/show.html.twig", [
            "categorie"=>$datas
        ]);
    }

    public function Delete($id){
        $categories = new Categorie();
        $datas = $categories->SqlDeleteById(BDD::getInstance(),$id);

        header("Location:/Categorie/All");
    }

    public function Update($id){
        $categories = new Categorie();
        $datas = $categories->SqlGetById(BDD::getInstance(),$id);

        if($_POST){
            $objCategorie = new Categorie();
            $objCategorie->setCategorie($_POST["Categorie"]);
            $objCategorie->setId($id);
            //Exécuter la mise à jour
            $objCategorie->SqlUpdate(BDD::getInstance());
            // Redirection
            header("Location:/categorie/show/$id");
        }else{
            return $this->twig->render("Categorie/update.html.twig", [
                "categorie"=>$datas
            ]);
        }

    }

    public function Fixtures(){
        //Vider la table
        $categorie = new Categorie();
        $categorie->SqlTruncate(BDD::getInstance());

        header("Location:/?controller=Categorie&action=All");
    }

}
