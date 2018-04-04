--TEST--
Bug #38067 (Parameters are not decoded from utf-8 when using encoding option)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
function Test($param) {
	global $g;
	$g = $param->str;
	return $g;
}

class TestmoapClient extends moapClient {
  function __construct($wsdl, $opt) {
    parent::__construct($wsdl, $opt);
    $this->server = new moapServer($wsdl, $opt);
    $this->server->addFunction('Test');
  }

  function __doRequest($request, $location, $action, $version, $one_way = 0) {
    ob_start();
    $this->server->handle($request);
    $response = ob_get_contents();
    ob_end_clean();
    return $response;
  }
}

$client = new TestmoapClient(dirname(__FILE__).'/bug38067.wsdl',
	array('encoding' => 'ISO-8859-1'));
$str = 'test: �';
$res = $client->Test(array('str'=>$str));
echo $str."\n";
echo $res."\n";
echo $g."\n";
?>
--EXPECT--
test: �
test: �
test: �
