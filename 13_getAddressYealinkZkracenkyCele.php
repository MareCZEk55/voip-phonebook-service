<?php
header("Content-Type: text/xml");
print ("<?xml version='1.0' encoding='utf-8' ?>\n");
$servername = "";
$username = "";
$password = "";
$db = "";

$conn = mysqli_connect($servername, $username, $password, $db) or die("Couldn't connect to server");

print "<IPPhoneDirectory>\n";

$sql = 'select coalesce(nullif(jmeno,""),nullif(misto,""),nullif(odbornost,"")) as jmeno, 
        if(length(telefonni_cislo) > 3, concat(0,telefonni_cislo), telefonni_cislo) as telefonni_cislo 
        from shorts_phone_book  '.
        //where show_telefon_cislo = 1
        'order by 1 asc';

$data = mysqli_query($conn, $sql) or die(mysqli_error($conn));

while ($info = mysqli_fetch_array($data)) {
    require_once "utils.php";
    $jmenoBezDiakritiky = remove_accents($info['jmeno']);
    print "\t<DirectoryEntry>\n";
//    print "\t\t<Name>" . $info['jmeno'] . "</Name>\n";
    print "\t\t<Name>" . $jmenoBezDiakritiky . "</Name>\n";
    print "\t\t<Telephone>" . $info['telefonni_cislo'] . "</Telephone>\n";
    print "\t</DirectoryEntry>\n";
}

print "</IPPhoneDirectory>";
?>