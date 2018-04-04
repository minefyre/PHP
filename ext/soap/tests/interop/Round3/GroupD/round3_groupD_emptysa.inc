<?php
class moap_Interop_GroupD {

    function echoString($inputString)
    {
      return $inputString;
    }

}

$server = new moapServer(dirname(__FILE__)."/round3_groupD_emptysa.wsdl");
$server->setClass("moap_Interop_GroupD");
$server->handle($HTTP_RAW_POST_DATA);
?>