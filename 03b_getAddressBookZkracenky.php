<?php
header("Content-Type: text/xml");
print ("<?xml version='1.0' encoding='utf-8' standalone='yes'?>\n");

$servername = "";
$username = "";
$password = "";
$db = "";

$conn = mysqli_connect($servername, $username, $password, $db) or die("Couldn't connect to server");

if(!$conn){
die("Connection failed"
	. mysqli_connect_error());
}

$self = $_SERVER['PHP_SELF'];


 print "<CiscoIPPhoneDirectory>\n";
 print "\t<Title>Adresář zkrácenky</Title>\n";
 
 $select_querry = 'select coalesce(nullif(jmeno,""), nullif(misto,""), nullif(odbornost,"")) as jmeno, 
 concat("*", zkracena_volba) as telefonni_cislo 
 from shorts_phone_book  ';
// $select_querry .= ' where show_telefon_cislo = 1 and length(telefonni_cislo) > 3';
$select_querry .= ' where length(telefonni_cislo) > 3';

$count_querry = 'select count(*) as pocet
from shorts_phone_book  ';
// $select_querry .= 'where show_telefon_cislo = 1 and length(telefonni_cislo) > 3';
$count_querry .= ' where length(telefonni_cislo) > 3';

if(isset($_GET["n"]) && htmlspecialchars($_GET["n"]) != ""){
	$select_querry .= " and concat(coalesce(nullif(jmeno,\"\"), nullif(misto,\"\"), nullif(odbornost,\"\")), \" - \" , zkracena_volba) like '%". $_GET["n"]."%'";
	$count_querry .= " and concat(coalesce(nullif(jmeno,\"\"), nullif(misto,\"\"), nullif(odbornost,\"\")), \" - \" , zkracena_volba) like '%". $_GET["n"]."%'";
}
$select_querry .= " order by 1 ASC";

$limit = 32;
if(isset($_GET["start"]) && htmlspecialchars($_GET["start"]) != ""){
	$limit = $_GET["start"];
	$select_querry .= " limit " . $limit . ",32";
	$limit += 32;
}else{
	$select_querry .= " limit " . $limit;
}
//$select_querry .= " limit 32";
 

$adresa = "";

print '<SoftKeyItem>
<Name>Volat</Name>
<Position>1</Position>
<URL>SoftKey:Dial</URL>
</SoftKeyItem>
<SoftKeyItem>
<Name>Zpět</Name>
<Position>2</Position>
<URL>SoftKey:Exit</URL>
</SoftKeyItem>';


$pocet_data = mysqli_query($conn, $count_querry);
$pocet = mysqli_fetch_array($pocet_data);

if($pocet['pocet'] > 32){
print'<SoftKeyItem>
<Name>Další</Name>
<Position>4</Position>
<URL>http://' . $adresa .':80/getAddressBookZkracenky.php?n='.htmlspecialchars("&").'start='.$limit.'</URL>
</SoftKeyItem>';
}

 $data = mysqli_query ($conn, $select_querry) 
 		or die(mysqli_error($conn));

 while($info = mysqli_fetch_array( $data )) {
 	Print "\t<DirectoryEntry>\n";
 	Print "\t\t<Name>".$info['jmeno']."</Name>\n";
 	Print "\t\t<Telephone>".$info['telefonni_cislo']."</Telephone>\n";
 	Print "\t</DirectoryEntry>\n";
 }
 
 print('</CiscoIPPhoneDirectory>');
 ?>

