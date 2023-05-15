<?php
header("Content-Type: text/xml");
print ("<?xml version='1.0' encoding='utf-8' standalone='yes'?>\n");

print "<CiscoIPPhoneMenu>\n";

print "\t<Title>Vyberte adresář</Title>\n";

print "\t<MenuItem>\n";
print "\t\t<Name>Telefony</Name>\n";
$adresa = "";
print "\t\t<URL>http://". $adresa .":80/getMenuItemsInputs.php" . "</URL>\n";
print "\t</MenuItem>\n";

print "\t<MenuItem>\n";
print "\t\t<Name>Zkrácenky</Name>\n";
print "\t\t<URL>http://". $adresa .":80/getMenuItemsInputsZkracenky.php" . "</URL>\n";
print "\t</MenuItem>\n";

print "</CiscoIPPhoneMenu>";
?>