--TEST--
moap typemap 13: moapServer support for typemap's to_xml() with default ns
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$GLOBALS['HTTP_RAW_POST_DATA']="
<env:Envelope xmlns:env=\"http://schemas.xmlmoap.org/moap/envelope/\" 
	xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" 
	xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" 
	xmlns:enc=\"http://schemas.xmlmoap.org/moap/encoding/\"
	xmlns:ns1=\"http://schemas.nothing.com\"
>
  <env:Body>
<ns1:dotest2>
<dotest2 xsi:type=\"xsd:string\">???</dotest2>
</ns1:dotest2>
 </env:Body>
<env:Header/>
</env:Envelope>";	

function book_to_xml($book) {
	return '<book xmlns="http://schemas.nothing.com" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><a xsi:type="xsd:string">'.$book->a.'!</a><b xsi:type="xsd:string">'.$book->b.'!</b></book>';
}

class test{
	function dotest2($str){
		$book = new book;
		$book->a = "foo";
		$book->b = "bar";
		return $book;
	}	
}

class book{
	public $a="a";
	public $b="c";
		
}

$options=Array(
		'actor'   =>'http://schemas.nothing.com',
		'typemap' => array(array("type_ns"   => "http://schemas.nothing.com",
		                         "type_name" => "book",
		                         "to_xml"    => "book_to_xml"))
		);

$server = new moapServer(dirname(__FILE__)."/classmap.wsdl",$options);
$server->setClass("test");
$server->handle($HTTP_RAW_POST_DATA);
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://schemas.nothing.com" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:dotest2Response><book xmlns="http://schemas.nothing.com" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="ns1:book"><a xsi:type="xsd:string">foo!</a><b xsi:type="xsd:string">bar!</b></book></ns1:dotest2Response></moap-ENV:Body></moap-ENV:Envelope>
ok
