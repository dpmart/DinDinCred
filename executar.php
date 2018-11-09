<?php
set_time_limit(0);

/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 08/11/2018
 * Time: 20:28
 */

function domain_exists($email, $record = 'MX'){
    list($user, $domain) = explode('@', $email);
    return checkdnsrr($domain, $record);
}

$mysqli = new mysqli("localhost", "root", "root");
$mysqli->select_db("dindincred");

$sql = "Select * from email Where status is NULL";
$result = $mysqli->query($sql);

$valido = 0;
$invalido = 0;
$total = $mysqli->affected_rows;

while($row = $result->fetch_array(MYSQLI_ASSOC)) {
    if(domain_exists($row["email"])) {
        $store = "Update email set status = 1 Where email = '{$row['email']}' and nome = '{$row["nome"]}'";
        $valido++;
    } else {
        $store = "Update email set status = 2 Where email = '{$row['email']}' and nome = '{$row["nome"]}'";
        $invalido++;
    }
    $mysqli->query($store);
}
$result->close();
$mysqli->close();
?>

Total: <?=number_format($total, 0, ',', '.')?><br>
V&aacute;lido:  <?=number_format($valido, 0, ',', '.')?><br>
Inv&aacute;lido:  <?=number_format($invalido, 0, ',', '.')?>
