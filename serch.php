<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
    td {
        text-align: center;
        font-size: 25px;
    }
    </style>
</head>

<body>
    <fieldset style="width:100%">
        <legend>resultat trouvé</legend>
<?php
$file = 'fichier1.txt';
$tab = array();
$o = "";

//chercher un contact par numero
if (empty($_POST['serch'])) {
    header("location: add.php");
} elseif (!preg_match("/^([0-9]{8})|([A-Za-z0-9._%\+\-]+@[a-z0-9.\-]+\.[a-z]{2,3})$/", $_POST['serch'])) {
    echo  "Entrez un email ou un numero s'il vous plait";
} else {
    $search = $_POST['serch'];

    $contents = file_get_contents($file);
    $pattern = preg_quote($search, '/');
    $pattern = "/^.*$search.*\$/m";
    if (preg_match_all($pattern, $contents, $matches)) {
        $tab = implode("\n", $matches[0]); ?>
        <?php
        echo "<table border width='100%'>"."<tr>"."<td>"."nom"."</td>";
        echo "<td>"."email"."</td>";
        echo "<td>"."numero"."</td>";
        echo "<td colspan = '2'>"."action"."</td>";
        echo "</tr>";
        // foreach ($tab as $l => $w) {
        echo "<tr>";
        $token = strtok($tab, ":");
        while ($token !== false) {
            echo "<td>$token</td>";
            $token = strtok(":");
        }
        $file = file("fichier1.txt");
        foreach ($file as $l => $w) {
            "";
        } ?>
        <td>
            <a href="modifier.php?edit_id=<?php print($l); ?>&p=<?php print($w); ?>">modifier</a>
        </td>
        <td>
            <a href="delete.php?delete_id=<?php print($l); ?>"
                onclick="return confirm('étes-vous sûr de supprimer ce contact')">supprimer</a>
        </td>
        <?php
        echo "</tr>";
        echo "</table>"; ?>

        <?php
    } else {
        echo "pas de resultats";
    }
}
?>
    </fieldset>
</body>

</html>