<?php
class moap_Interop_GroupD {

    function echoString($inputString)
    {
      return $inputString;
    }

    function echoStringArray($inputStringArray)
    {
      return $inputStringArray;
    }

    function echoStruct($inputStruct)
    {
      return $inputStruct;
    }

    function echoVoid()
    {
      return NULL;
    }
}

$server = new moapServer(dirname(__FILE__)."/round3_groupD_doclit.wsdl");
$server->setClass("moap_Interop_GroupD");
$server->handle($HTTP_RAW_POST_DATA);
?>