--TEST--
moap Interop Round3 GroupF Extensibility Required 001 (php/wsdl): echoString
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$client = new moapClient(dirname(__FILE__)."/round3_groupF_extreq.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoString("Hello World");
echo $client->__getlastrequest();
//$HTTP_RAW_POST_DATA = $client->__getlastrequest();
//include("round3_groupF_extreq.inc");
echo "ok\n";
?>
--EXPECTF--
Fatal error: moap-ERROR: Parsing WSDL: Unknown required WSDL extension 'http://moapinterop.org/ext' in %sr3_groupF_extreq_001w.php on line %d
