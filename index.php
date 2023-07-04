<?php

use App\Db;
use Models\AnnoncesModel;
use Models\CategoriesModel;
use Models\UsersModel;

require_once('autoloader.php');


// Test de la methode findAll()
$categories = CategoriesModel::findAll();

var_dump($categories);

// Test de la methode findById($id)
$categorie = CategoriesModel::findById([3]);
var_dump($categorie);

// Test de la methode findByName($title)
$categorieByName = CategoriesModel::findByName(array('maison'));

var_dump($categorieByName);

// Test de création d'une categorie
// $newCat = CategoriesModel::create(['informammmmmmmmmmmmmmtique']);
// var_dump($newCat);

// Test de modification de categorie
// $catUpdate = CategoriesModel::update(['materiel informatique', 4]);

// Test de la méthode de suppression d'une categorie
// $catDel = CategoriesModel::delete([15]);

// tester findAll() de users
$users = UsersModel::findAll();

// var_dump($users);



// teste de findById user
// $user = UsersModel::findById([1]);
// var_dump($user);

// test de findByLogin user
$user = UsersModel::findByLogin(['admin@gmail.com']);
var_dump($user);

// test de la methode create() user
$pass = password_hash("1234", PASSWORD_BCRYPT);
// $data = ['test@gmail.com', $pass, 'prenomTest', 'nomTest','mon adresse', 75011, 'paris', '0147789852'];
// $newUser = UsersModel::create($data);

// Test de la methode update user
// $data = ['test@gmail.com', $pass, 'prenomTest', 'nomTest', 'rue de paris', 75011,'paris', '0645851232',4];
// $userUpadate = UsersModel::update($data);

// Test de la methode delete user
// UsersModel::delete([5]);


// Test de la methode findAll de annonces
// $order et $limit sont optionnel et le contenu s'ajoute à la requete SQL
$order = "price DESC";
$limit = "LIMIT 1";

$annonces = AnnoncesModel::findAll($order,$limit);


var_dump($annonces);

echo '<hr>';

// EXO Afficher 'la variable existe' si $maVariable existe
$maVariable = 'toto';

if($maVariable){
    echo 'la variable existe';
}

echo '<hr>';
echo $maVariable ? 'la variable existe' : null;

// test de la methode findById de annonce

$annonce = AnnoncesModel::findById([1]);
var_dump($annonce);

echo '<hr>';
echo 'les annonces d\'un utlisateur';
$annonces = AnnoncesModel::findByUser([3]);

var_dump($annonces);

echo '<hr>';
echo 'les annonces de la categorie véhicule';
$order = "price ASC";
$annoncesVehicule = AnnoncesModel::findByIdCat([3],$order);
var_dump($annoncesVehicule);

// $data = [1,4,'iphone XIII','128Go vert', 600, 'img/iphone.jpg'];
// AnnoncesModel::create($data);

// Test de update annonce
$data = [1,4,'iphone X','128Go vert', 600, 'img/iphone.jpg',4];
AnnoncesModel::update($data);

// test delete annonce
AnnoncesModel::delete([5]);