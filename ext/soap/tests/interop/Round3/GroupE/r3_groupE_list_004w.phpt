--TEST--
moap Interop Round3 GroupE List 004 (php/wsdl): echoLinkedList
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
class moapList {
    function moapList($s, $i, $c) {
        $this->varString = $s;
        $this->varInt = $i;
        $this->child = $c;
    }
}
$struct = NULL;
$client = new moapClient(dirname(__FILE__)."/round3_groupE_list.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoLinkedList($struct);
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round3_groupE_list.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/WSDLInteropTestRpcEnc" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoLinkedList><param0 xsi:nil="true" xsi:type="ns2:List"/></ns1:echoLinkedList></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/WSDLInteropTestRpcEnc" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoLinkedListResponse><return xsi:nil="true" xsi:type="ns2:List"/></ns1:echoLinkedListResponse></moap-ENV:Body></moap-ENV:Envelope>
NULL
ok
