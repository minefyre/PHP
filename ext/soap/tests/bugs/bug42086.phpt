--TEST--
Bug #42086 (moapServer return Procedure '' not present for WSIBasic compliant wsdl)
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
moap.wsdl_cache_enabled=0
--FILE--
<?php
$request = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/"><moap-ENV:Body><firstFunctionWithoutParam/></moap-ENV:Body></moap-ENV:Envelope>
EOF;

class firstFunctionWithoutParamResponse {
	public $param;
}

function firstFunctionWithoutParam() {
	$ret = new firstFunctionWithoutParamResponse();
	$ret->param	=	"firstFunctionWithoutParam";
	return $ret;
}
	
$server = new moapServer(dirname(__FILE__).'/bug42086.wsdl',
	array('features'=>moap_SINGLE_ELEMENT_ARRAYS));
$server->addFunction('firstFunctionWithoutParam');
$server->handle($request);
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?>
<moap-ENV:Envelope xmlns:moap-ENV="http://schemas.xmlmoap.org/moap/envelope/"><moap-ENV:Body><firstFunctionWithoutParamReturn><param>firstFunctionWithoutParam</param></firstFunctionWithoutParamReturn></moap-ENV:Body></moap-ENV:Envelope>
