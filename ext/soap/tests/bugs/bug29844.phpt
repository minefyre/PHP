--TEST--
Bug #29844 (moap doesn't return the result of a valid moap request)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php

class hello_world {   
  public function hello($to) {
    return 'Hello ' . $to;
  }    
}

class LocalmoapClient extends moapClient {

  function __construct($wsdl, $options) {
    parent::__construct($wsdl, $options);
    $this->server = new moapServer($wsdl, $options);
    $this->server->setClass('hello_world');;
  }

  function __doRequest($request, $location, $action, $version, $one_way = 0) {
    ob_start();
    $this->server->handle($request);
    $response = ob_get_contents();
    ob_end_clean();
    return $response;
  }

}

$client = new LocalmoapClient(dirname(__FILE__)."/bug29844.wsdl", array("trace"=>1)); 
var_dump($client->hello('davey'));
?>
--EXPECT--
string(11) "Hello davey"
