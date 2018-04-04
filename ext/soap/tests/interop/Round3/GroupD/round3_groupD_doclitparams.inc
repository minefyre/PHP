<?php
class moap_Interop_GroupD {

    function echoString($inputString)
    {    	
      return array("return"=>$inputString->param0);
    }

    function echoStringArray($inputStringArray)
    {
      return array("return"=>$inputStringArray->param0);
    }

    function echoStruct($inputStruct)
    {
      return array("return"=>$inputStruct->param0);
    }

    function echoVoid()
    {
      return NULL;
    }

}

$server = new moapServer(dirname(__FILE__)."/round3_groupD_doclitparams.wsdl");
$server->setClass("moap_Interop_GroupD");
$server->handle($HTTP_RAW_POST_DATA);
?>