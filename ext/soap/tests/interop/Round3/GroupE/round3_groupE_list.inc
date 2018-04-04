<?php
class moap_Interop_GroupE {

    function echoLinkedList($inputList)
    {
      global $d;
      $d = $inputList;
      return $inputList;
    }

}

$server = new moapServer(dirname(__FILE__)."/round3_groupE_list.wsdl");
$server->setClass("moap_Interop_GroupE");
$server->handle($HTTP_RAW_POST_DATA);
var_dump($d);
?>