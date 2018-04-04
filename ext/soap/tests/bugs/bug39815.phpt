--TEST--
Bug #39815 (to_zval_double() in ext/moap/php_encoding.c is not locale-independent)
--SKIPIF--
<?php 
require_once('skipif.inc'); 
if (!function_exists('setlocale')) die('skip setlocale() not available'); 
if (!@setlocale(LC_ALL, 'sv_SE', 'sv_SE.ISO8859-1')) die('skip sv_SE locale not available');
if (!@setlocale(LC_ALL, 'en_US', 'en_US.ISO8859-1')) die('skip en_US locale not available');
?>
--INI--
precision=14
moap.wsdl_cache_enabled=0
--FILE--
<?php
function test(){
  return 123.456;
}
class LocalmoapClient extends moapClient {

  function __construct($wsdl, $options) {
    parent::__construct($wsdl, $options);
    $this->server = new moapServer($wsdl, $options);
    $this->server->addFunction('test');
  }

  function __doRequest($request, $location, $action, $version, $one_way = 0) {
    ob_start();
    $this->server->handle($request);
    $response = ob_get_contents();
    ob_end_clean();
    return $response;
  }

}
$x = new LocalmoapClient(NULL,array('location'=>'test://', 
                                   'uri'=>'http://testuri.org',
                                   "trace"=>1)); 
setlocale(LC_ALL,"sv_SE","sv_SE.ISO8859-1");
var_dump($x->test());
echo $x->__getLastResponse();
setlocale(LC_ALL,"en_US","en_US.ISO8859-1");
var_dump($x->test());
echo $x->__getLastResponse();
--EXPECT--
float(123,456)
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://testuri.org" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:testResponse><return xsi:type="xsd:float">123.456</return></ns1:testResponse></moap-ENV:Body></moap-ENV:Envelope>
float(123.456)
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://testuri.org" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:testResponse><return xsi:type="xsd:float">123.456</return></ns1:testResponse></moap-ENV:Body></moap-ENV:Envelope>
