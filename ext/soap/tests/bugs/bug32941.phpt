--TEST--
Bug #32941 (Sending structured exception kills a php)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
class TestmoapClient extends moapClient {
  function __doRequest($request, $location, $action, $version, $one_way = 0) {
  	return <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<moapenv:Envelope
xmlns:moapenv="http://schemas.xmlmoap.org/moap/envelope/"
xmlns:xsd="http://www.w3.org/2001/XMLSchema"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
	<moapenv:Body>
		<moapenv:Fault>
			<faultcode>moapenv:Server.userException</faultcode>
			<faultstring>service.EchoServiceException</faultstring>
			<detail>
				<service.EchoServiceException xsi:type="ns1:EchoServiceException" xmlns:ns1="urn:service.EchoService">
					<intParameter xsi:type="xsd:int">105</intParameter>
					<parameter xsi:type="moapenc:string" xmlns:moapenc="http://schemas.xmlmoap.org/moap/encoding/">string param</parameter>
				</service.EchoServiceException>
				<ns2:hostname xmlns:ns2="http://xml.apache.org/axis/">steckovic</ns2:hostname>
			</detail>
		</moapenv:Fault>
	</moapenv:Body>
</moapenv:Envelope>
EOF;
	}
}

ini_set("moap.wsdl_cache_enabled", 1);
$client = new TestmoapClient(dirname(__FILE__).'/bug32941.wsdl', array("trace" => 1, 'exceptions' => 0));
$ahoj = $client->echoString('exception');
$client = new TestmoapClient(dirname(__FILE__).'/bug32941.wsdl', array("trace" => 1, 'exceptions' => 0));
$ahoj = $client->echoString('exception');
echo "ok\n";
?>
--EXPECT--
ok
