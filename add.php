<!DOCTYPE html>
<html>

<head>
    <style>
    .error {
        color: #FF0000;
    }
    </style>
    <script langage="javaScript">
    function reinit() {
        window.location.href = 'add.php';
    }
    </script>
</head>

<body>
    <center>
        <fieldset style="width:50%; height:25%;"><legend>Ajouter un contact</legend><br><br>

            <?php
$nom=$mail=$tel="";
$nomErr=$mailErr=$telErr="";
$err="";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //valider le nom
    if (empty($_POST['nom'])) {
        $nomErr = "Le nom est obligatoire";
    } else {
        $nom = test_input($_POST['nom']);
        if (!preg_match("/^[A-Za-z-' ]*$/", $nom)) {
            $nomErr = "Ce n'est pas un nom";
        }
    }//valider l'email
    if (empty($_POST['mail'])) {
        $mailErr = "L'email est obligatoire";
    } else {
        $mail=test_input($_POST['mail']);
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $mailErr = "Ce n'est pas un email";
        }
    }//valider le numero
    if (empty($_POST['tel'])) {
        $telErr="Le numero est obligatoire";
    } else {
        $tel=test_input($_POST['tel']);
        if (!preg_match("/^[342+][0-9]*$/", $tel)) {
            $telErr="Ce n'est pas un numero";
        }
    }
    
}
function test_input($x)
{
    $x=trim($x);
    $x=stripslashes($x);
    $x=htmlspecialchars($x);
    return $x;
}
?>
            
<?php
/////////////////////////////////////////////////
$file = file("fichier1.txt");
$contents = file_get_contents("fichier1.txt");
$pattern = preg_quote($mail, '/');
$pattern = "/^.*$mail.*\$/m";
if (preg_match_all($pattern, $contents, $matches)) {
    $tab = implode("\n", $matches[0]);
    // $file = file("fichier1.txt");
    $token = strtok($tab, ":");
    if ($token !== false) {
        $t = trim($token);
        $token = strtok(":");
        $y = trim($token);
        $token = strtok(":");
        $e = trim($token);
        $token = strtok(":");
    }
}else $y="";
$cont = file_get_contents("fichier1.txt");
$pat = preg_quote($tel, '/');
$pat = "/^.*$tel.*\$/m";
if (preg_match_all($pat, $cont, $matche)) {
    $g = implode("\n", $matche[0]);
    // $file = file("fichier1.txt");
    $tok = strtok($g, ":");
    if ($tok !== false) {
        $tt = trim($tok);
        $tok = strtok(":");
        $yy = trim($tok);
        $tok = strtok(":");
        $ee = trim($tok);
        $tok = strtok(":");
    }
}
//////////////////////////////////////////////////////////////////////////////
if (!$fp = fopen("fichier1.txt", "a")) {
    echo "Echec de l'ouverture du fichier";
} 
//si les variable sont vide alors fermer le fichier
elseif ((empty($_POST['mail']) || empty($_POST['nom']) || empty($_POST['tel'])) or ($mailErr || $nomErr || $telErr)) {
    fclose($fp);
} 
//si non fait ceci
else {
    if (!empty($y) || !empty($ee)) {

    if (($y == $mail) || ($ee == $tel)) {
        $err = ($y == $mail) ? "l'email existe deja" : "le numero existe deja";
        fclose($fp);
    }
    }
    else{
        fputs($fp, "\n"); // on va a la ligne
        fputs($fp, $nom." : ".$mail." : ".$tel); // on écrit le nom et email dans le fichier
        
    echo "<script>alert('Texte ajouté');</script>";
        fclose($fp);
    }
    
}

?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <span>Nom : <input type="text" name="nom" value="<?php echo $nom; ?>"></span>
                <p class="error">*<?php echo $nomErr; ?></p><br><br>
                <span>E-mail : <input type="text" name="mail" value="<?php echo $mail; ?>"></span>
                <p class="error">*<?php echo $mailErr; ?></p><br><br>
                <span>Numero : <input type="tel" name="tel" minlength="8" maxlength="8"
                        value="<?php echo $tel; ?>"></span>
                <p class="error">*<?php echo $telErr; ?></p><br><BR><span class="error"><?php echo $err; ?></span><br>
                <input type="submit" name="submit" value="Inserer" style="background-color:blue;">
                <input type="button" name="reset" value="Vider les champs" Onclick="reinit()" />
            </form><br><br>
            <a href="view.php">Afficher</a>
        </fieldset><br><br>
        <fieldset style="width:50%; height:25%;"><legend>chercher un contact</legend><br><br>
            <form method="post" action="serch.php">
                <label>chercher : </label> <input type="text" name="serch" pattern="^([0-9]{8})|([A-Za-z0-9._%\+\-]+@[a-z0-9.\-]+\.[a-z]{2,3})$">
                <input type="submit" value="chercher">
            </form>
        </fieldset>
    </center>
</body>

</html>