<header>
    <title>Principal</title>
</header>
<font face="Courier">
<?php
$mysqli = new mysqli("localhost", "root", "root");
$mysqli->select_db("dindincred");

$alfabeto = "A";
while($alfabeto != "AA") {
    $sql = "Select count(*) total from email Where nome like '{$alfabeto}%' and status = 1";
    $result = $mysqli->query($sql);
    $row = $result->fetch_array(MYSQLI_ASSOC);
?>
    <a href="baixar.php?letra=<?=$alfabeto?>"> Letra <?=$alfabeto?></a> [ <?=$row["total"]?> ]<br>
<?
    $result->close();
    $alfabeto++;
}
$mysqli->close();
?>
</font>
