<?php

namespace Models;

use PDO;
use App\Db;

class AnnoncesModel extends Db{
    // //////////////// CRUD (create , read, update, delete)/////////////////

    // Méthode de lecture

    // Méthode pour trouver toutes les annonces
    public static function findAll($order = null, $limit = null){
        // Méthode repetitive 
        // if($order === null){
        //     // Si pas de tri
        //     $request = "SELECT * , annonces.title AS title, categories.title AS titleCat FROM annonces INNER JOIN categories ON annonces.id_categorie = categories.id_categorie" . $limit;
        //     // en francais
        //     // SI $limit non null
        //     // SELECT * FROM annonces LIMIT 2
        //     // Si $limit null
        //     // SELECT * FROM annonces 
        // }else{
        //     $request = "SELECT * , annonces.title AS title, categories.title AS titleCat FROM annonces INNER JOIN categories ON annonces.id_categorie = categories.id_categorie ORDER BY " . $order . " " .$limit;
        //     // Si $limit non null
        //     // SELECT * FROM annonces ORDER BY price DESC LIMIT 2
        //     // Si $limit null
        //     // SELECT * FROM annonces ORDER BY price DESC
        // }

        // La même chose plus court
        $request = "SELECT * , annonces.title AS title, categories.title AS titleCat FROM annonces INNER JOIN categories ON annonces.id_categorie = categories.id_categorie";
        // if($order !== null){
        //     $request .= " ORDER BY " . $order;
        // }
        // if($limit !==null){
        //    $request .= " " . $limit; 
        // }


        // même chose avec une ternaire
        // Notre but est de modifier la requete en fonction de $order et/ou $limit
        // on test $order   si true                           si false
                    $order ? $request .= " ORDER BY " . $order : null;
                    $limit ? $request .= " " . $limit : null; 

        $reponse = self::getDb()->prepare($request);
        $reponse->execute();
        return $reponse->fetchAll(PDO::FETCH_ASSOC);
    }

    // Methode pour trouver une annonces par son id
    // Documentation de la méthode
    /**
     * Attend un id d'annonce
     * @param array $id[int]
     */
    public static function findById(array $id){
        $request = "SELECT * , annonces.title AS title, categories.title AS titleCat FROM annonces INNER JOIN categories ON annonces.id_categorie = categories.id_categorie WHERE id_annonce = ?";
        $reponse = self::getDb()->prepare($request);
        $reponse->execute($id);

        return $reponse->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour trouver les annonces d'un user
    public static function findByUser(array $idUser){
        $request = "SELECT * , annonces.title AS title, categories.title AS titleCat FROM annonces INNER JOIN categories ON annonces.id_categorie = categories.id_categorie WHERE id_user = ?";
        $reponse = self::getDb()->prepare($request);
        $reponse->execute($idUser);

        return $reponse->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour trouver les annonces d'une catégorie
    public static function findByIdCat($idCategorie, $order = null){
        $request = "SELECT * , annonces.title AS title, categories.title AS titleCat FROM annonces INNER JOIN categories ON annonces.id_categorie = categories.id_categorie WHERE annonces.id_categorie = ?";
        // ajouter la table devant le champs du where
        // Trenaire pour ajouter un tri
        $order ? $request .= " ORDER BY " . $order : null;
        $reponse = self::getDb()->prepare($request);
        $reponse->execute($idCategorie);

        return $reponse->fetchAll(PDO::FETCH_ASSOC);
    }

    // //// Méthode d'écriture 
    // Création d'une annonce
    /**
     * Méthode de création d'une annonce
     * @param array $data[
     * id_user: int,
     * id_categorie: int,
     * title: string,
     * description: string,
     * price: float,
     * image: string
     * ]
     */
    public static function create(array $data){
        $request = "INSERT INTO annonces (id_user, id_categorie,title,description,price,image) VALUE (?,?,?,?,?,?)";
        $reponse = self::getDb()->prepare($request);
        $reponse->execute($data);

        return self::getDb()->lastInsertId();
    }

    // Méthode de mise a jour d'une annonces
    /**
     * Méthode de création d'une annonce
     * @param array $data[
     * id_user: int,
     * id_categorie: int,
     * title: string,
     * description: string,
     * price: float,
     * image: string,
     * id_annonce, int
     * ]
     */
    public static function update(array $data){
        $request  = "UPDATE annonces SET id_user = ? , id_categorie = ?, title = ?, description = ?, price = ?, image = ? WHERE id_annonce = ?";
        $reponse = self::getDb()->prepare($request);

        return $reponse->execute($data);

    }

    // ////////////// DELETE /////////////////
    public static function delete(array $id){
        $request = "DELETE FROM annonces WHERE id_annonce = ?";
        $reponse = self::getDb()->prepare($request);

        return $reponse->execute($id);
    }
}