--TEST--
moap Typemap 11: moapClient support for typemap's from_xml() (moapFault)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
class TestmoapClient extends moapClient{
  function __doRequest($request, $location, $action, $version, $one_way = 0) {
		return <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://schemas.nothing.com" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body>
<ns1:dotest2Response><res xsi:type="ns1:book">
  <a xsi:type="xsd:string">foo</a>
  <b xsi:type="xsd:string">bar</b>
</res>
</ns1:dotest2Response></moap-ENV:Body></moap-ENV:Envelope>
EOF;
	}	
}

class book{
	public $a="a";
	public $b="c";
		
}

function book_from_xml($xml) {
	throw new moapFault("Client", "Conversion Error");
}

$options=Array(
		'actor' =>'http://schemas.nothing.com',
		'typemap' => array(array("type_ns"   => "http://schemas.nothing.com",
		                         "type_name" => "book",
		                         "from_xml"  => "book_from_xml"))
		);

$client = new TestmoapClient(dirname(__FILE__)."/classmap.wsdl",$options);
try {
	$ret = $client->dotest2("???");
} catch (moapFault $e) {
	$ret = "moapFault = " . $e->faultcode . " - " . $e->faultstring;
}
var_dump($ret);
echo "ok\n";
?>
--EXPECT--
string(37) "moapFault = Client - Conversion Error"
ok
