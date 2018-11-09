<?php
header('Content-Type: text/csv; charset=utf-8');

$letra = $_REQUEST["letra"];

header("Content-Disposition: attachment; filename=letra_{$letra}.csv");

$mysqli = new mysqli("localhost", "root", "root");
$mysqli->select_db("dindincred");

$sql = "Select * from email Where nome like '{$letra}%' and status = 1";
$result = $mysqli->query($sql);

while($row = $result->fetch_array(MYSQLI_ASSOC)) {
    printf("%s;%s\n", $row["email"], $row["nome"] );
}

$result->close();
$mysqli->close();

