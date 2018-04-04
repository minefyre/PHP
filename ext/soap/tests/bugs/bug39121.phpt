--TEST--
Bug #39121 (Incorrect return array handling in non-wsdl moap client)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
class LocalmoapClient extends moapClient {
  function __doRequest($request, $location, $action, $version, $one_way = 0) {
    return <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<moap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:moapenc="http://schemas.xmlmoap.org/moap/encoding/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" moap:encodingStyle="http://schemas.xmlmoap.org/moap/encoding/" xmlns:moap="http://schemas.xmlmoap.org/moap/envelope/">
        <moap:Body>
                <getDIDAreaResponse xmlns="http://didx.org/GetList">
                        <moapenc:Array moapenc:arrayType="xsd:string[2]" xsi:type="moapenc:Array">
                                <item xsi:type="xsd:string">StateCode</item>
                                <item xsi:type="xsd:string">description</item>
                        </moapenc:Array>
                        <moapenc:Array moapenc:arrayType="xsd:anyType[2]" xsi:type="moapenc:Array">
                                <item xsi:type="xsd:int">241</item>
                                <item xsi:type="xsd:string">Carabobo</item>
                        </moapenc:Array>
                        <moapenc:Array moapenc:arrayType="xsd:anyType[2]" xsi:type="moapenc:Array">
                                <item xsi:type="xsd:int">243</item>
                                <item xsi:type="xsd:string">Aragua and Carabobo</item>
                        </moapenc:Array>
                        <moapenc:Array moapenc:arrayType="xsd:anyType[2]" xsi:type="moapenc:Array">
                                <item xsi:type="xsd:int">261</item>
                                <item xsi:type="xsd:string">Zulia</item>
                        </moapenc:Array>
                </getDIDAreaResponse>
        </moap:Body>
</moap:Envelope>
EOF;
  }
}

$client = new LocalmoapClient(NULL, array('location'=>'test://','uri'=>'test://'));
print_r($client->getDIDAreaResponse());
?>
--EXPECT--
Array
(
    [Array] => Array
        (
            [0] => Array
                (
                    [0] => StateCode
                    [1] => description
                )

            [1] => Array
                (
                    [0] => 241
                    [1] => Carabobo
                )

            [2] => Array
                (
                    [0] => 243
                    [1] => Aragua and Carabobo
                )

            [3] => Array
                (
                    [0] => 261
                    [1] => Zulia
                )

        )

)
