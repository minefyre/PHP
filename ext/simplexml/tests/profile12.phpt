--TEST--
SimpleXML [profile]: Accessing namespaced root and non namespaced children
--SKIPIF--
<?php if (!extension_loaded("simplexml")) print "skip"; ?>
--FILE--
<?php

$xml =<<<EOF
<?xml version="1.0" encoding="utf-8"?>
<moap:Envelope
xmlns:moap="http://schemas.xmlmoap.org/moap/envelope/" 
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
xmlns:xsd="http://www.w3.org/2001/XMLSchema"
>
<moap:Body>
<businessList foo="bar">
<businessInfo businessKey="bla"/>
</businessList>
</moap:Body> 
</moap:Envelope>
EOF;

$sxe = simplexml_load_string($xml);
$nsl = $sxe->getNamespaces();
var_dump($nsl);

$sxe = simplexml_load_string($xml, NULL, 0, $nsl['moap']);
var_dump($sxe->Body);
var_dump($sxe->Body->children(''));
var_dump($sxe->Body->children('')->businessList);

?>
===DONE===
--EXPECTF--
array(1) {
  ["moap"]=>
  string(41) "http://schemas.xmlmoap.org/moap/envelope/"
}
object(SimpleXMLElement)#%s (0) {
}
object(SimpleXMLElement)#%s (1) {
  ["businessList"]=>
  object(SimpleXMLElement)#%s (2) {
    ["@attributes"]=>
    array(1) {
      ["foo"]=>
      string(3) "bar"
    }
    ["businessInfo"]=>
    object(SimpleXMLElement)#%s (1) {
      ["@attributes"]=>
      array(1) {
        ["businessKey"]=>
        string(3) "bla"
      }
    }
  }
}
object(SimpleXMLElement)#%s (2) {
  ["@attributes"]=>
  array(1) {
    ["foo"]=>
    string(3) "bar"
  }
  ["businessInfo"]=>
  object(SimpleXMLElement)#%s (1) {
    ["@attributes"]=>
    array(1) {
      ["businessKey"]=>
      string(3) "bla"
    }
  }
}
===DONE===
