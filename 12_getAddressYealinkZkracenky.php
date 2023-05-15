<?php
header("Content-Type: text/xml");
print ("<?xml version='1.0' encoding='utf-8' ?>\n");
$servername = "";
$username = "";
$password = "";
$db = "";

$conn = mysqli_connect($servername, $username, $password, $db) or die("Couldn't connect to server");

print "<IPPhoneDirectory>\n";

$sql = 'select coalesce(nullif(jmeno,""),nullif(misto,""),nullif(odbornost,"")) as jmeno, concat("*", zkracena_volba) as zkracena_volba
        from shorts_phone_book 
        order by 1 asc';

$data = mysqli_query($conn, $sql) or die(mysqli_error($conn));

while ($info = mysqli_fetch_array($data)) {
    print "\t<DirectoryEntry>\n";
    print "\t\t<Name>" . $info['jmeno'] . "</Name>\n";
    print "\t\t<Telephone>" . $info['zkracena_volba'] . "</Telephone>\n";
    print "\t</DirectoryEntry>\n";
}

print "</IPPhoneDirectory>";
?>