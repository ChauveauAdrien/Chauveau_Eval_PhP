<?php

// Paramètres de connexion à la base de données (à adapter en fonction de votre environnement);

define('HOST', 'localhost');
define('USER', 'root');
define('DBNAME', 'links_manager_dev');
define('PASSWORD', ''); // windows (Mamp le mot de passe c'est 'root')

/**
 * Fonction de connexion à la base de données
 *
 * @return \PDO
 */
function db_connect(): PDO
{
    try {
        /**
         * Data Source Name : chaine de connexion à la base de données
         * Elle permet de renseigner le domaine du serveur de la base de données, le nom de la base de données cible et l'encodage de données pendant leur transport
         * @var string
         */
        $dsn =  'mysql:host=' . HOST . ';dbname=' . DBNAME . ';charset=utf8';

        return new PDO($dsn, USER, PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } catch (\PDOException $ex) {
        echo sprintf('La demande de connexion à la base de donnée a échouée avec le message %s', $ex->getMessage());
        exit(0);
    }
}


/**
 * Fonction qui permet de récupérer le tableau des enregistrements de la table des liens
 * @return array
 */
function get_all_link()
{

    $db = db_connect();

    $sql = <<<EOD
    SELECT
        *
    FROM
        `links`
    EOD;
    $linksStmt = $db->query($sql);
    $links = $linksStmt->fetchAll(PDO::FETCH_ASSOC);
    return $links;
}

/**
 * Fonction qui permet de récupérer un enregistrement à partir de son identifiant dans la table des liens
 * @param integer $link_id
 * @return array
 */
function get_link_by_id($link_id)
{
    // TODO implement function
}


/**
 * Fonction qui permet de modifier un enregistrement dans la table des liens
 * @param array $data: ['link_id' => 1, 'title' => 'MDN', 'url' => 'https://developer.mozilla.org/fr/']
 * @return bool
 */
function update_link()
{
    if ((!empty($_POST['new_title']) and isset($_POST['new_title'])) and (!empty($_POST['new_url']) and isset($_POST['new_url']))) {
        $db = db_connect();
        $sql = "UPDATE links
        SET title = '$_POST[new_title]',
            url = '$_POST[new_url]'
        WHERE id = $_GET[link_id]";
        $db->exec($sql);
        header('Location: ./index.php ');
    }
    
}
update_link();

/**
 * Fonction qui permet de d'enregistrer un nouveau lien dans la table des liens
 * @param array $data: ['title' => 'MDN', 'url' => 'https://developer.mozilla.org/fr/']
 * @return bool
 */
function create_link(){

    function verify_link(){
        return((!empty($_POST['title']) and isset($_POST['title'])) and (!empty($_POST['url']) and isset($_POST['url'])));
    }

    if(verify_link()){
        $db = db_connect();
        $sql = "INSERT INTO links (title, url)
        VALUES ('$_POST[title]', '$_POST[url]')";
        $db->exec($sql);
        header('Location: ./index.php ');
        
    }

}
create_link();

/**
 * Fonction qui permet de supprimer l'enregistrement dont l'identifiant est $linl_id dans la table des liens
 *@param integer $link_id
 * @return bool
 */
function delete_link($link_id){

    $db = db_connect();
    $sql = "DELETE FROM `links`
    WHERE `link_id` = $link_id";
    $db->exec($sql);
    $_GET['id']  = "undefined";
    header('Location: ./index.php ');
    
}
if (isset($_GET['id'])) {
    delete_link($_GET['id']);
}
