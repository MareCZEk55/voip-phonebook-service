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
 print "\t<Title>Adresář telefony</Title>\n";
// print "\t<Prompt>Výsledky hledání</Prompt>\n";
 
 
$select_querry = "select concat(d.oddeleni, ' - ', p.jmeno) as jmeno, p.telefon 
	from phone_book p 
	join departments d on d.id = p.department_id";

$pocet_querry = "select count(*) as pocet 
	from phone_book p 
	join departments d on d.id = p.department_id";

if(isset($_GET["n"]) && htmlspecialchars($_GET["n"]) != ""){
	$select_querry .= " where concat(d.oddeleni, ' - ', p.jmeno) like '%". $_GET["n"]."%' or p.telefon like '%". $_GET["n"] ."%'";
	$pocet_querry .= " where concat(d.oddeleni, ' - ', p.jmeno) like '%". $_GET["n"]."%' or p.telefon like '%". $_GET["n"] ."%'";
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

$pocet_data = mysqli_query($conn, $pocet_querry);
$pocet = mysqli_fetch_array($pocet_data);

if($pocet['pocet'] > 32){
print'<SoftKeyItem>
<Name>Další</Name>
<Position>4</Position>
<URL>http://' . $adresa .':80/getAddressBook.php?n='.htmlspecialchars("&").'start='.$limit.'</URL>
</SoftKeyItem>';
}


$data = mysqli_query ($conn, $select_querry)
 
 or die(mysqli_error($conn));
 while($info = mysqli_fetch_array( $data )) {
 	Print "\t<DirectoryEntry>\n";
 	Print "\t\t<Name>".$info['jmeno']."</Name>\n";
 	Print "\t\t<Telephone>".$info['telefon']."</Telephone>\n";
 	Print "\t</DirectoryEntry>\n";
 }
 
 print('</CiscoIPPhoneDirectory>');
 ?>
