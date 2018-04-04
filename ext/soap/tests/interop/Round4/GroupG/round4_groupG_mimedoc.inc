<?php
class moap_Interop_GroupG {

  function EchoBase64AsAttachment($in) {
    return $in;
  }

  function EchoAttachmentAsBase64($in) {
    return $in;
  }

  function EchoAttachment($in) {
    return $in;
  }

  function EchoAttachments($in) {
    return $in;
  }

}

$server = new moapServer(dirname(__FILE__)."/round4_groupG_dimedoc.wsdl");
$server->setClass("moap_Interop_GroupG");
$server->handle($HTTP_RAW_POST_DATA);
?>
