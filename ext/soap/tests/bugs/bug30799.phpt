--TEST--
Bug #30799 (moapServer doesn't handle private or protected properties)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
class foo {
	public    $a="a";
	private   $b="b";
	protected $c="c";
		
}

$x = new moapClient(NULL,array("location"=>"test://",
                               "uri" => "test://",
                               "exceptions" => 0,
                               "trace" => 1 ));
$x->test(new foo());
echo $x->__getLastRequest();
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="test://" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test><param0 xsi:type="moap-ENC:Struct"><a xsi:type="xsd:string">a</a><b xsi:type="xsd:string">b</b><c xsi:type="xsd:string">c</c></param0></ns1:test></moap-ENV:Body></moap-ENV:Envelope>
ok
