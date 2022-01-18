<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $file=fopen("fichier1.txt","r");
    $contenu = fread($file,filesize("fichier1.txt"));

    fclose($file);
    $contenu = explode("\n",$contenu);

    unset($contenu[$id]);
    $contenu = array_values($contenu);
    $contenu = implode("\n", $contenu);
    $upData = fopen("fichier1.txt", "w");
    fwrite($upData, $contenu);

    header("location:view.php");
}
?>
</body>
</html>