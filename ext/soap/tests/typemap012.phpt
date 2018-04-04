--TEST--
moap Typemap 12: moapClient support for typemap's to_xml() (moapFault)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
class TestmoapClient extends moapClient{
  function __doRequest($request, $location, $action, $version, $one_way = 0) {
  		echo $request;
  		exit;
	}	
}

class book{
	public $a="a";
	public $b="c";
		
}

function book_to_xml($book) {
	throw new moapFault("Client", "Conversion Error");
}

$options=Array(
		'actor' =>'http://schemas.nothing.com',
		'typemap' => array(array("type_ns"   => "http://schemas.nothing.com",
		                         "type_name" => "book",
		                         "to_xml"  => "book_to_xml"))
		);

$client = new TestmoapClient(dirname(__FILE__)."/classmap.wsdl",$options);
$book = new book();
$book->a = "foo";
$book->b = "bar";
try {
	$ret = $client->dotest($book);
} catch (moapFault $e) {
	$ret = "moapFault = " . $e->faultcode . " - " . $e->faultstring;
}
var_dump($ret);
echo "ok\n";
?>
--EXPECT--
string(37) "moapFault = Client - Conversion Error"
ok
