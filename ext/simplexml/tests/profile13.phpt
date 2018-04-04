--TEST--
SimpleXML [profile]: Accessing by namespace prefix
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
var_dump($sxe->children('moap', 1));

$sxe = simplexml_load_string($xml, NULL, 0, 'moap', 1);
var_dump($sxe->Body);
var_dump($sxe->Body->children(''));
var_dump($sxe->Body->children('')->businessList);

?>
===DONE===
<?php exit(0); ?>
--EXPECTF--
object(SimpleXMLElement)#%d (1) {
  ["Body"]=>
  object(SimpleXMLElement)#%d (0) {
  }
}
object(SimpleXMLElement)#%d (0) {
}
object(SimpleXMLElement)#%d (1) {
  ["businessList"]=>
  object(SimpleXMLElement)#%d (2) {
    ["@attributes"]=>
    array(1) {
      ["foo"]=>
      string(3) "bar"
    }
    ["businessInfo"]=>
    object(SimpleXMLElement)#%d (1) {
      ["@attributes"]=>
      array(1) {
        ["businessKey"]=>
        string(3) "bla"
      }
    }
  }
}
object(SimpleXMLElement)#%d (2) {
  ["@attributes"]=>
  array(1) {
    ["foo"]=>
    string(3) "bar"
  }
  ["businessInfo"]=>
  object(SimpleXMLElement)#%d (1) {
    ["@attributes"]=>
    array(1) {
      ["businessKey"]=>
      string(3) "bla"
    }
  }
}
===DONE===
