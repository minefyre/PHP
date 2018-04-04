<?php
class moap_Interop_GroupF {

    function echoString($inputString)
    {
      return $inputString;
    }

}

$server = new moapServer(dirname(__FILE__)."/round3_groupF_ext.wsdl");
$server->setClass("moap_Interop_GroupF");
$server->handle($HTTP_RAW_POST_DATA);
?>