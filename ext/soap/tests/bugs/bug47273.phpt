--TEST--
Bug #47273 (Encoding bug in moapServer->fault)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
unicode.script_encoding=ISO-8859-1
unicode.output_encoding=ISO-8859-1
--FILE--
<?php
$request1 = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://127.0.0.1:8080/test/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test1/></moap-ENV:Body></moap-ENV:Envelope>
EOF;
$request2 = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://127.0.0.1:8080/test/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test2/></moap-ENV:Body></moap-ENV:Envelope>
EOF;

class moapFaultTest
{
    public function test1() {
    	//  Test #1
        return 'Test #1 exception with some special chars: Äßö';
    }
    public function test2() {    
        //  Test #2
	//throw new moapFault('Server', 'Test #2 exception with some special chars: Äßö');
        throw new Exception('Test #2 exception with some special chars: Äßö');
    }
}

$server = new moapServer(null, array(
'uri' => "http://127.0.0.1:8080/test/",
'encoding' => 'ISO-8859-1'));
$server->setClass('moapFaultTest');

try {
	$server->handle($request1);
} catch (Exception $e) {
	$server->fault("Sender", $e->getMessage());
}
try {
        $server->handle($request2);
} catch (Exception $e) {
        $server->fault("Sender", $e->getMessage());
}
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://127.0.0.1:8080/test/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:test1Response><return xsi:type="xsd:string">Test #1 exception with some special chars: ÃÃÃ¶</return></ns1:test1Response></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/"><moap-ENV:Body><moap-ENV:Fault><faultcode>Sender</faultcode><faultstring>Test #2 exception with some special chars: ÃÃÃ¶</faultstring></moap-ENV:Fault></moap-ENV:Body></moap-ENV:Envelope>

