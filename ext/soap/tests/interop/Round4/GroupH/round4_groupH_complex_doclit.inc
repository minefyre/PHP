<?php
class moap_Interop_GroupH {

  function echomoapStructFault($input) {
    return new moapFault("Server", "Fault in response to 'echomoapStructFault'.", null, array("moapStruct"=>$input), "ComplexFault");
  }

  function echoBaseStructFault($input) {
    return new moapFault("Server", "Fault in response to 'echoBaseStructFault'.", null, $input, "ComplexFault");
  }

  function echoExtendedStructFault($input) {
    return new moapFault("Server", "Fault in response to 'echoExtendedStructFault'.", null, $input, "ComplexFault");
  }

  function echoMultipleFaults1($input) {
  	if ($input->whichFault == 2) {
	    return new moapFault("Server", "Fault in response to 'echoMultipleFaults1'.", null, $input->param2, "ComplexFault2");
	  } else {
	    return new moapFault("Server", "Fault in response to 'echoMultipleFaults1'.", null, array("moapStruct"=>$input->param1), "ComplexFault1");
	  }
  }

  function echoMultipleFaults2($input) {
  	if ($input->whichFault == 2) {
	    return new moapFault("Server", "Fault in response to 'echoMultipleFaults2'.", null, $input->param2, "ComplexFault2");
  	} else if ($input->whichFault == 3) {
	    return new moapFault("Server", "Fault in response to 'echoMultipleFaults2'.", null, $input->param3, "ComplexFault3");
	  } else {
	    return new moapFault("Server", "Fault in response to 'echoMultipleFaults2'.", null, $input->param1, "ComplexFault1");
	  }
  }
}

$server = new moapServer(dirname(__FILE__)."/round4_groupH_complex_doclit.wsdl");
$server->setClass("moap_Interop_GroupH");
$server->handle($HTTP_RAW_POST_DATA);
?>
