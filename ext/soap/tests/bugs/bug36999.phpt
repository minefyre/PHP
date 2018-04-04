--TEST--
Bug #36999 (xsd:long values clamped to LONG_MAX instead of using double)
--SKIPIF--
<?php 
  if (!extension_loaded('moap')) die('skip moap extension not available');
?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php

function echoLong($num) {
  return $num;
}

class LocalmoapClient extends moapClient {

  function __construct($wsdl) {
    parent::__construct($wsdl);
    $this->server = new moapServer($wsdl);
    $this->server->addFunction('echoLong');
  }

  function __doRequest($request, $location, $action, $version, $one_way = 0) {
    ob_start();
    $this->server->handle($request);
    $response = ob_get_contents();
    ob_end_clean();
    return $response;
  }

}

$moap = new LocalmoapClient(dirname(__FILE__)."/bug36999.wsdl");

function test($num) {
  global $moap;
  try {
	  printf("%s %0.0f\n", gettype($num), $num);
	  $ret = $moap->echoLong($num);
	  printf("%s %0.0f\n", gettype($ret), $ret);
	} catch (moapFault $ex) {
	  var_dump($ex);
	}
}
test(3706790240);
?>
--EXPECTF--
%s 3706790240
%s 3706790240
