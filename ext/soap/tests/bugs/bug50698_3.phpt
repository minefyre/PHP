--TEST--
Request #50698_3 (moapClient should handle wsdls with some incompatiable endpoints -- EDGECASE: Large set of endpoints all incompatiable.)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
try {
    new moapClient(dirname(__FILE__) . '/bug50698_3.wsdl');
    echo "Call: \"new moapClient(dirname(__FILE__).'/bug50698_3.wsdl');\" should throw an exception of type 'moapFault'";
} catch (moapFault $e) {
    if ($e->faultcode == 'WSDL' && $e->faultstring == 'moap-ERROR: Parsing WSDL: Could not find any usable binding services in WSDL.') {
        echo "ok\n";
    } else {
        echo "Call: \"new moapClient(dirname(__FILE__).'/bug50698_3.wsdl');\" threw a moapFault with an incorrect faultcode or faultmessage.";
        print_r($e);
    }    
}
?>
--EXPECT--
ok
