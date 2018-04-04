--TEST--
Bug #34643 (wsdl default value)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
ini_set("moap.wsdl_cache_enabled", 0);

class fp {
	public function get_it($opt="zzz") {
		return $opt;
	}
}

class LocalmoapClient extends moapClient {

  function __construct($wsdl, $options) {
    parent::__construct($wsdl, $options);
    $this->server = new moapServer($wsdl, $options);
    $this->server->setClass('fp');
  }

  function __doRequest($request, $location, $action, $version, $one_way = 0) {
    ob_start();
    $this->server->handle($request);
    $response = ob_get_contents();
    ob_end_clean();
    return $response;
  }

}

$cl = new LocalmoapClient(dirname(__FILE__).'/bug34643.wsdl', array("trace"=>1));
print_r($cl->__getFunctions());
echo $cl->get_it("aaa")."\n";
echo $cl->get_it()."\n";
var_dump($cl->get_it(null));
?>
--EXPECT--
Array
(
    [0] => string get_it(string $opt)
)
aaa
zzz
NULL
