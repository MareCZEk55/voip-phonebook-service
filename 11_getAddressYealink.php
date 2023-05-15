<?php
header("Content-Type: text/xml");
print ("<?xml version='1.0' encoding='utf-8' ?>\n");
$servername = "";
$username = "";
$password = "";
$db = "";

$conn = mysqli_connect($servername, $username, $password, $db) or die("Couldn't connect to server");

print "<IPPhoneDirectory>\n";

$sql = 'select concat(d.oddeleni, " - " , p.jmeno) as jmeno, p.telefon 
        from phone_book p 
        join departments d on d.id = p.department_id 
        order by 1 asc';

$data = mysqli_query($conn, $sql) or die(mysqli_error($conn));

while ($info = mysqli_fetch_array($data)) {
    print "\t<DirectoryEntry>\n";
    print "\t\t<Name>" . $info['jmeno'] . "</Name>\n";
    print "\t\t<Telephone>" . $info['telefon'] . "</Telephone>\n";
    print "\t</DirectoryEntry>\n";
}

print "</IPPhoneDirectory>";
?>