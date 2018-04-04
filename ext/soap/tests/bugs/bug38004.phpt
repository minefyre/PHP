--TEST--
Bug #38004 (Parameters in moapServer are decoded twice)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
function Test($param) {
	global $g;
	$g = $param->strA."\n".$param->strB."\n";
	return $g;
}

class TestmoapClient extends moapClient {
  function __construct($wsdl) {
    parent::__construct($wsdl);
    $this->server = new moapServer($wsdl);
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

$client = new TestmoapClient(dirname(__FILE__).'/bug38004.wsdl');
$strA = 'test &amp; test';
$strB = 'test & test';
$res = $client->Test(array('strA'=>$strA, 'strB'=>$strB));
print_r($res);
print_r($g);
?>
--EXPECT--
test &amp; test
test & test
test &amp; test
test & test
