--TEST--
Bug #46427 (moapClient() stumbles over its "stream_context" parameter)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
error_reporting(E_ALL|E_STRICT);

function getmoapClient_1() {
    $ctx = stream_context_create();
    return new moapClient(NULL, array(
    	'stream_context' => $ctx,
    	'location' => 'test://',
    	'uri' => 'test://',
    	'exceptions' => false));
}

getmoapClient_1()->__moapCall('Help', array());
echo "ok\n";
?>
--EXPECT--
ok
