--TEST--
Bug #42692 (Procedure 'int1' not present with doc/lit moapServer)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
ini_set('moap.wsdl_cache_enabled','0');

function checkAuth($peid,$auth) {
	return $peid;
}

class Testmoap extends moapClient {

	function __construct($wsdl, $options) {
		parent::__construct($wsdl, $options);
		$this->server = new moapServer($wsdl, $options);
		$this->server->addFunction("checkAuth");
	}

	function __doRequest($request, $location, $action, $version, $one_way = 0) {
		ob_start();
		$this->server->handle($request);
		$response = ob_get_contents();
		ob_end_clean();
		return $response;
	}
}

$client = new Testmoap(dirname(__FILE__) . "/bug42692.wsdl", array("trace"=>1));
try {
	$result = $client->checkAuth(1,"two");
	echo "Auth for 1 is $result\n";
} catch (Exception $e) {
	echo $e->getMessage();
}
?>
--EXPECT--
Auth for 1 is 1
