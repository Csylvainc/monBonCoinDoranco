<?php
namespace Models;

use PDO;
use App\Db;

class UsersModel extends Db{
    // /////////////// CRUD //////////////////

    // //// Méthode de lecture

    // Trouver tous les users
    public static function findAll(){
        $request = "SELECT * FROM users";
        $reponse = self::getDb()->prepare($request);
        $reponse->execute();

        return $reponse->fetchAll(PDO::FETCH_ASSOC);
    }

    // trouver un user par son id
    // Documentation de la méthode
    /**
     * Attend un id d'utilisateur
     * @param array $id[int]
     */
    public static function findById(array $id){
        $request = "SELECT * FROM users WHERE id_user = ?";
        $reponse = self::getDb()->prepare($request);
        $reponse->execute($id);

        return $reponse->fetch(PDO::FETCH_ASSOC);
    }

    // Trouver un user par son login
    /**
     * Attend un login user
     * @param array $login[string]
     */
    public static function findByLogin(array $login){
        $request = "SELECT * FROM users WHERE login = ?";
        $reponse = self::getDb()->prepare($request);
        $reponse->execute($login);

        return $reponse->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode d'écriture

    // Créer un user
    public static function create(array $data){
        // $data est un tableau qui contient les infos du user à insérer en BDD
        $request = "INSERT INTO users (login, password, firstName, lastName, adress, cp, city, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $reponse = self::getDb()->prepare($request);
        $reponse->execute($data);
    }

    // Upadate user
    public static function update(array $data){
        $request = "UPDATE users SET login = ?, password = ?, firstName = ?, lastName = ?, adress = ?, cp = ?, city = ?, phone = ? WHERE id_user = ?";
        $reponse = self::getDb()->prepare($request);
        $reponse->execute($data);
    }

    // Méthode de suppression
    public static function delete(array $id){
        $request = "DELETE FROM users WHERE id_user = ?";
        $reponse = self::getDb()->prepare($request);

        return $reponse->execute($id);
    }
}