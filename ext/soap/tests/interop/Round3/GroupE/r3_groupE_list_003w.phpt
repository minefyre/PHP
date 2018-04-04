--TEST--
moap Interop Round3 GroupE List 003 (php/wsdl): echoLinkedList
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
$struct = new moapList('arg1',1,new moapList('arg2',2,new moapList('arg3',3,NULL)));
$client = new moapClient(dirname(__FILE__)."/round3_groupE_list.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoLinkedList($struct);
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round3_groupE_list.inc");
echo "ok\n";
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/WSDLInteropTestRpcEnc" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoLinkedList><param0 xsi:type="ns2:List"><varInt xsi:type="xsd:int">1</varInt><varString xsi:type="xsd:string">arg1</varString><child xsi:type="ns2:List"><varInt xsi:type="xsd:int">2</varInt><varString xsi:type="xsd:string">arg2</varString><child xsi:type="ns2:List"><varInt xsi:type="xsd:int">3</varInt><varString xsi:type="xsd:string">arg3</varString><child xsi:nil="true" xsi:type="ns2:List"/></child></child></param0></ns1:echoLinkedList></moap-ENV:Body></moap-ENV:Envelope>
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/" xmlns:ns1="http://moapinterop.org/WSDLInteropTestRpcEnc" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:ns2="http://moapinterop.org/xsd" xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/" moap-ENV:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"><moap-ENV:Body><ns1:echoLinkedListResponse><return xsi:type="ns2:List"><varInt xsi:type="xsd:int">1</varInt><varString xsi:type="xsd:string">arg1</varString><child xsi:type="ns2:List"><varInt xsi:type="xsd:int">2</varInt><varString xsi:type="xsd:string">arg2</varString><child xsi:type="ns2:List"><varInt xsi:type="xsd:int">3</varInt><varString xsi:type="xsd:string">arg3</varString><child xsi:nil="true" xsi:type="ns2:List"/></child></child></return></ns1:echoLinkedListResponse></moap-ENV:Body></moap-ENV:Envelope>
object(stdClass)#7 (3) {
  ["varInt"]=>
  int(1)
  ["varString"]=>
  string(4) "arg1"
  ["child"]=>
  object(stdClass)#8 (3) {
    ["varInt"]=>
    int(2)
    ["varString"]=>
    string(4) "arg2"
    ["child"]=>
    object(stdClass)#9 (3) {
      ["varInt"]=>
      int(3)
      ["varString"]=>
      string(4) "arg3"
      ["child"]=>
      NULL
    }
  }
}
ok
