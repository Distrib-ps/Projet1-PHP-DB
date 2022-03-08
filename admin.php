<?php
session_start();
if ($_SESSION['autoriser']!="oui") {
    header("location:index.php");
}
else {
    $bienvenue = "Bienvenue ".$_SESSION['nom']." <br>";
    $nom = $_SESSION['nom'];
?>
    <!DOCTYPE html>
    <html>
    <head>
    <link rel="stylesheet" type="text/css" href="style.css"></head>
    <body>
    <form class="form-style-9"  method="POST" action="modif.php">
    <ul>
    <li>
        <?= $bienvenue ?>
        <a href="http://localhost/projet1-php-db/index.php"><input type="button" value="Ajout" /></a>
        <a href="http://localhost/projet1-php-db/listes.php"><input type="button" value="Liste des utilisateurs" /></a>
        <br><br>
    <?php
    // Ici, on va faire une vérif si li'utilisateur est admin alors il va avoir accès à la suite.
    $username = 'lou';
    $password = 'lou';

    $pdo = new PDO("mysql:host=localhost;dbname=projet_1", $username, $password);

    $sql_verif_admin="SELECT admin FROM clients WHERE nom_client= ?";

    $req = $pdo->prepare($sql_verif_admin);

    $req->execute (array($nom));

    $row = $req->fetchAll(PDO::FETCH_OBJ);

    $admin = $row[0]->admin;



    if ($admin==1){

    ?>

        <input type="text" name="idClient" value=""/>
        <input type="submit" value="Search" />
    </li>
    </form>
    <form  method="POST" action="db_liste_comte.php">
        <center><ul><li>
            <input type="submit" value="Liste des demandes de suppression" />
    </ul></li></center>
        </form>
    <?php
    }else {
        ?>
        Vous ne disposez pas des droits nécéssaire pour consulter les autres pages. Vous pouvez tout de même faire une demande de suppression de compte.<br><br>
        </form>
        <form  method="POST" action="db_supp_compte.php">
        <center><ul><li>
            <input type="submit" value="Demande suppression de compte" />
    </ul></li></center>
        </form>
        <?php




        ?>
        

    <?php
    }
}
    ?>

    <br><a href="deconnexion.php">Se déconnecter</a>
        </body>
    </html>