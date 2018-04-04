<?php
class moap_Interop_GroupH {

    function echoVersionMismatchFault()
    {
    }

    function echoMustUnderstandFault()
    {
    }

    function HeaderRequest($string)
    {
    }


}

$server = new moapServer(dirname(__FILE__)."/round4_groupH_moapfault.wsdl");
$server->setClass("moap_Interop_GroupH");
$server->handle($HTTP_RAW_POST_DATA);
?>
