<?php
header("Content-Type: text/xml");
print ("<?xml version='1.0' encoding='utf-8' standalone='yes'?>\n");

print "<CiscoIPPhoneInput>";
print "<Title>Hledání</Title>";
//print "<Prompt>Zadejte hledání</Prompt>";

print "<SoftKeyItem>";
print "<Name>Hledat</Name>";
print "<Position>1</Position>";
print "<URL>SoftKey:Submit</URL>";
print "</SoftKeyItem>";

print "<SoftKeyItem>";
$symbol = htmlspecialchars("<<");
print "<Name>" . $symbol . "</Name>";
print "<Position>2</Position>";
$symbol = htmlspecialchars("<<");
print "<URL>SoftKey:" . $symbol . "</URL>";
print "</SoftKeyItem>";

print "<SoftKeyItem>";
print "<Name>Zrušit</Name>";
print "<Position>3</Position>";
print "<URL>SoftKey:Cancel</URL>";
print "</SoftKeyItem>";

$adresa = "";
print '<URL>http://' . $adresa .':80/getAddressBookZkracenky.php' . '</URL>';

print "<InputItem>";
print "<DisplayName>Jméno</DisplayName>";
print "<QueryStringParam>n</QueryStringParam>";
print "<InputFlags>A</InputFlags>";
print "<DefaultValue/>";
print "</InputItem>";

print "</CiscoIPPhoneInput>";
?>