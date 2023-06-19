<?php
include_once './config/config.php';
include_once './classes/create.php';
include_once './classes/read.php';
include_once './classes/update.php';
include_once './classes/delete.php';

//create instance de la classe de la BDD

$database = new Database();
$db = $database->getConnection();

//create instance class CRUD

$create = new Create ($db);
$Read = new Read ($db);
$Delete = new Delete ($db);
$Update = new Update ($db);


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];

    if($delete->deleteData($id)) {
        echo "bien delete";
    } else {
        echo "Erreur";
    }
};

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    
    if($create->CreateData($nom, $email)) {
        echo "bien add";
    } else {
        echo "Erreur";
    }
};

$stmt = $read->readData();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "ID : " ;$row['id']. "<br>";
    echo " Nom: " ;$row['nom']. "<br>";
    echo " Email: " ;$row['email']. "<br>";

//update
    echo "<form action='' method='POST'>";
    echo "<input type='hidden' name='id' value= '".$row['id']."'>";
    echo "<input type='text' name='nom' value= '".$row['nom']."'>";
    echo "<input type='text' name='email' value= '".$row['email']."'>";
    echo "<input type='submit' value='Mettre à jour'>";
    echo "</form>";

    //delete
    echo "<form action='".$_SERVER['PHP_SELF']. "' method='POST'>";
    echo "<input type='hidden' name='id' value= '".$row['id']."'>";
    echo "<input type='submit'  name='delete' value='sup'>";
    echo "<br>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELFT'] ?>" method="POST">
        <input type="text" name="nom" placeholder="nom">
        <input type="email" name="email" placeholder="email">
        <input type="submit" value="Go">
</body>
</html>