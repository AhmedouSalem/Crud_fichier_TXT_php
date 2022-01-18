<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modifier</title>
    <style>
    .error {
        color: #FF0000;
    }
    </style>
</head>

<body>
    <?php
    $id='';
$file = file ("fichier1.txt");
if (isset($_GET['edit_id']) and isset($_GET['p'])) {
    $id=$_GET['edit_id'];
    $n = $_GET['p'];
}
    
    $token = strtok($n, ":");
    if ($token !== false) {
       $t = trim($token);
       $token = strtok(":");
       $y = trim($token);
       $token = strtok(":");
       $e = trim($token);
       $token = strtok(":");
    }
?>
<center>
        <fieldset style="width:50%; height:25%;"><LEGend>Modifier un contact</LEGend><br><br>

            <?php
            //declaration des variables
$nom=$z=$mail=$tel="";
$nomErr=$mailErr=$telErr="";
$tab = array();

//valider les formulaire
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //valider le nom
    if (empty($_POST['nom'])) {
        $nomErr = "Le nom est obligatoire";
    } else {
        $nom = test_input($_POST['nom']);
        if (!preg_match("/^[A-Za-z-' ]*$/", $nom)) {
            $nomErr = "Ce n'est pas un nom";
        }
    }
    //valider l'email
    if (empty($_POST['mail'])) {
        $mailErr = "L'email est obligatoire";
    } else {
        $mail=test_input($_POST['mail']);
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $mailErr = "Ce n'est pas un email";
        }
    }
    //valider le numero
    if (empty($_POST['tel'])) {
        $telErr="Le numero est obligatoire";
    } else {
        $tel=test_input($_POST['tel']);
        if (!preg_match("/^[342][0-9]*$/", $tel)) {
            $telErr="Ce n'est pas un numero";
        }
    }
   
    // $fp=fopen('fichier1.txt','w');
    
    // $z= "$nom : $mail : $tel";
    // $file[$id]=$z;
    // foreach ($file as $key => $value) {
    //     fputs($fp,$value);
    //     header("location: view.php");
    // }
    // fclose($fp);
    
    
}
function test_input($x)
{
    $x=trim($x);
    $x=stripslashes($x);
    $x=htmlspecialchars($x);
    return $x;
}
?>
            <form method="post" action="">
                <span>Nom : <input type="text" name="nom" value="<?php echo $t; ?>"></span>
                <p class="error">*<?php echo $nomErr; ?></p><br><br>
                <span>E-mail : <input type="text" name="mail" value="<?php echo $y; ?>"></span>
                <p class="error">*<?php echo $mailErr; ?></p><br><br>
                <span>Numero : <input type="tel" name="tel" minlength="8" maxlength="8"
                        value="<?php echo $e; ?>"></span>
                <p class="error">*<?php echo $telErr; ?></p><br>
                <input type="submit" name="submit" value="Modifier" style="background-color:blue;">
        </fieldset>
    </center>
</body>

</html>
<?php
if (($nom == $t) && ($mail == $y) && ($tel == $e)) {
    header("location: view.php");
}else{
    // valider la modification
    if (!$fp = fopen("fichier1.txt", "a")) {
        echo "Echec de l'ouverture du fichier";
    }
    //si les champ sont vide rien ne vas etre modifié
    elseif ((empty($_POST['mail']) || empty($_POST['nom']) || empty($_POST['tel'])) or ($mailErr || $nomErr || $telErr)) {
        fclose($fp);
    }
    //lancer la modification aprés avoir droit
    else {
        $fp = fopen("fichier1.txt", "w");
        $z= "$nom : $mail : $tel\n";
        $file[$id]=$z;
        foreach ($file as $key => $value) {
            fputs($fp, $value);
            header("location: view.php");
        }
        fclose($fp);
    }
}
?>