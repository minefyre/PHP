--TEST--
moap handling of <any>
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--INI--
precision=14
moap.wsdl_cache_enabled=0
--FILE--
<?php
class moapComplexType {
    function moapComplexType($s, $i, $f) {
        $this->varString = $s;
        $this->varInt = $i;
        $this->varFloat = $f;
    }
}
$struct = new moapComplexType('arg',34,325.325);

function echoAnyElement($x) {
	global $g;

	$g = $x;
	$struct = $x->inputAny->any["moapComplexType"];
	if ($struct instanceof moapComplexType) {
		return array("return" => array("any" => array("moapComplexType"=>new moapVar($struct, moap_ENC_OBJECT, "moapComplexType", "http://moapinterop.org/xsd", "moapComplexType", "http://moapinterop.org/"))));
	} else {
		return "?";
	}
}

class TestmoapClient extends moapClient {
  function __construct($wsdl, $options) {
    parent::__construct($wsdl, $options);
    $this->server = new moapServer($wsdl, $options);
    $this->server->addFunction('echoAnyElement');
  }

  function __doRequest($request, $location, $action, $version, $one_way = 0) {
    ob_start();
    $this->server->handle($request);
    $response = ob_get_contents();
    ob_end_clean();
    return $response;
  }
}

$client = new TestmoapClient(dirname(__FILE__)."/interop/Round4/GroupI/round4_groupI_xsd.wsdl",
                             array("trace"=>1,"exceptions"=>0,
                             'classmap' => array('moapComplexType'=>'moapComplexType')));
$ret = $client->echoAnyElement(
  array(
    "inputAny"=>array(
       "any"=>new moapVar($struct, moap_ENC_OBJECT, "moapComplexType", "http://moapinterop.org/xsd", "moapComplexType", "http://moapinterop.org/")
     )));
var_dump($g);
var_dump($ret);
?>
--EXPECT--
object(stdClass)#5 (1) {
  ["inputAny"]=>
  object(stdClass)#6 (1) {
    ["any"]=>
    array(1) {
      ["moapComplexType"]=>
      object(moapComplexType)#7 (3) {
        ["varInt"]=>
        int(34)
        ["varString"]=>
        string(3) "arg"
        ["varFloat"]=>
        float(325.325)
      }
    }
  }
}
object(stdClass)#8 (1) {
  ["return"]=>
  object(stdClass)#9 (1) {
    ["any"]=>
    array(1) {
      ["moapComplexType"]=>
      object(moapComplexType)#10 (3) {
        ["varInt"]=>
        int(34)
        ["varString"]=>
        string(3) "arg"
        ["varFloat"]=>
        float(325.325)
      }
    }
  }
}
