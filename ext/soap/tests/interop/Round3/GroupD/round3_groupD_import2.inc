<?php
class moap_Interop_GroupD {

    function echoStruct($inputStruct)
    {
      return $inputStruct;
    }

}

$server = new moapServer(dirname(__FILE__)."/round3_groupD_import2.wsdl");
$server->setClass("moap_Interop_GroupD");
$server->handle($HTTP_RAW_POST_DATA);
?>