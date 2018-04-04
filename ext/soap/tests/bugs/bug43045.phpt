--TEST--
Bug #43045i (moap encoding violation on "INF" for type double/float)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
function test($x) {
  return $x;
}

class TestmoapClient extends moapClient {
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

    echo $request;
    return '<moap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xmlns:moapenc="http://schemas.xmlmoap.org/moap/encoding/"
xmlns:xsd="http://www.w3.org/2001/XMLSchema"
moap:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"
xmlns:moap="http://schemas.xmlmoap.org/moap/envelope/">
<moap:Body><testResponse xmlns="urn:Testmoap">
<s-gensym3>
<doubleInfinity xsi:type="xsd:double">INF</doubleInfinity>
</s-gensym3>
</testResponse>
</moap:Body></moap:Envelope>';
  }
}
$client = new TestmoapClient(NULL, array(
			"location" => "test://",
			"uri"      => 'urn:Testmoap',
			"style"    => moap_RPC,
			"use"      => moap_ENCODED                        
			));
var_dump($client->test(0.1));
var_dump($client->test(NAN));
var_dump($response = $client->test(INF));
var_dump($response = $client->test(-INF));
--EXPECT--
float(0.1)
float(NAN)
float(INF)
float(-INF)
