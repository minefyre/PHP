<?php
class moap_Interop_GroupH {

  function echomoapStructFault($input) {
    return new moapFault("Server", "Fault in response to 'echomoapStructFault'.", null, $input, "ComplexFault");
  }

  function echoBaseStructFault($input) {
    return new moapFault("Server", "Fault in response to 'echoBaseStructFault'.", null, $input, "ComplexFault");
  }

  function echoExtendedStructFault($input) {
    return new moapFault("Server", "Fault in response to 'echoExtendedStructFault'.", null, $input, "ComplexFault");
  }

  function echoMultipleFaults1($which, $s1, $s2) {
  	if ($which == 2) {
	    return new moapFault("Server", "Fault in response to 'echoMultipleFaults1'.", null, $s2, "ComplexFault2");
	  } else {
	    return new moapFault("Server", "Fault in response to 'echoMultipleFaults1'.", null, array("moapStruct"=>$s1), "ComplexFault1");
	  }
  }

  function echoMultipleFaults2($which, $s1, $s2, $s3) {
  	if ($which == 2) {
	    return new moapFault("Server", "Fault in response to 'echoMultipleFaults2'.", null, $s2, "ComplexFault2");
  	} else if ($which == 3) {
	    return new moapFault("Server", "Fault in response to 'echoMultipleFaults2'.", null, $s3, "ComplexFault3");
	  } else {
	    return new moapFault("Server", "Fault in response to 'echoMultipleFaults2'.", null, $s1, "ComplexFault1");
	  }
  }
}

$server = new moapServer(dirname(__FILE__)."/round4_groupH_complex_rpcenc.wsdl");
$server->setClass("moap_Interop_GroupH");
$server->handle($HTTP_RAW_POST_DATA);
?>
