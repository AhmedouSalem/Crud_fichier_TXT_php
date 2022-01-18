
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        td{
            text-align:center;
            font-size: 25px;
        }
    </style>
</head>
<body><center><fieldset style="width:100%; "><legend>Liste des contacts</legend><br><br>
<?php
$file = file ("fichier1.txt");
echo "<table border width='100%'>"."<tr>"."<td>"."nom"."</td>";
echo "<td>"."email"."</td>";echo "<td>"."numero"."</td>";
echo "<td colspan = '2'>"."action"."</td>";
echo "</tr>";


foreach ($file as $l => $w) {
    trim($w);
    if (strlen($w) > 3) {
        echo "<tr>";
        $token = strtok($w, ":");
        while ($token !== false) {
            echo "<td>$token</td>";
            $token = strtok(":");
        } ?>
<td>
<a href="modifier.php?edit_id=<?php print($l); ?>&p=<?php print($w); ?>" >modifier</a>
</td>
<td>
<a href="delete.php?delete_id=<?php print($l); ?>" onclick="return confirm('étes-vous sûr de supprimer ce contact')"> supprimer</a>
</td>
<?php
echo "</tr>";
    }
}
echo "</table>";
?>
</fieldset>
</center>
</body>
</html>

