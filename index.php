<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ToDo List</title>
</head>
<body>
    <h1>Ma liste des choses à faire</h1>
    <form action="index.php" method="POST">
        <input type="text" name="nom" placeholder="Veuillez saisir une tâche...">
        <button type="submit">Créer</button>
    </form>

<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=todo_list;charset=utf8;port=3308', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}



if(!empty($_POST['nom'])){

$name = $bdd->quote($_POST['nom']);
$requete = "INSERT INTO tache VALUES(id, $name)";
$tache = $bdd->exec($requete);


}
else{
    echo "";
}

if(isset($_GET['deltache'])){
    $id = $_GET['deltache'];
    $bdd->exec("DELETE FROM tache WHERE id = $id");
}



    echo"<section><table>
    <thead>
        <tr>
            <td>Id</td>
            <td>Nom</td>
            <td>Action</td>
        </tr>
    </thead>";

    $reponse = $bdd->query('SELECT * FROM tache');
    while($donnees = $reponse->fetch()){
        echo"<tbody>
        <tr>
        <td>
            $donnees[id]
        </td>
        <td>
            $donnees[nom]
        </td>
        <td>
           <a href=index.php?deltache=$donnees[id]>X</a>
        </td>
        </tr>
        </tbody>";
    }
     echo "</table><section>";

    
    

    


?>
</body>
</html>