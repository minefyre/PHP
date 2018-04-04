<?php
//
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2003 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.02 of the PHP license,      |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at                              |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Shane Caraveo <Shane@Caraveo.com>                           |
// +----------------------------------------------------------------------+
//
// $Id: client_round2_params.php 242949 2007-09-26 15:44:16Z cvs2svn $
//

define('moap_TEST_ACTOR_OTHER','http://some/other/actor');

class moap_Test {
    var $type = 'php';
    var $test_name = NULL;
    var $method_name = NULL;
    var $method_params = NULL;
    var $cmp_func = NULL;
    var $expect = NULL;
    var $expect_fault = FALSE;
    var $headers = NULL;
    var $headers_expect = NULL;
    var $result = array();
    var $show = 1;
    var $debug = 0;
    var $encoding = 'UTF-8';

    function moap_Test($methodname, $params, $expect = NULL, $cmp_func = NULL) {
        # XXX we have to do this to make php-moap happy with NULL params
        if (!$params) $params = array();

        if (strchr($methodname,'(')) {
            preg_match('/(.*)\((.*)\)/',$methodname,$matches);
            $this->test_name = $methodname;
            $this->method_name = $matches[1];
        } else {
            $this->test_name = $this->method_name = $methodname;
        }
        $this->method_params = $params;
        if ($expect !== NULL) {
          $this->expect = $expect;
        }
        if ($cmp_func !== NULL) {
          $this->cmp_func = $cmp_func;
        }

        // determine test type
        if ($params) {
        $v = array_values($params);
        if (gettype($v[0]) == 'object' &&
            (get_class($v[0]) == 'moapVar' || get_class($v[0]) == 'moapParam'))
            $this->type = 'moapval';
        }
    }

    function setResult($ok, $result, $wire, $error = '', $fault = NULL)
    {
        $this->result['success'] = $ok;
        $this->result['result'] = $result;
        $this->result['error'] = $error;
        $this->result['wire'] = $wire;
        $this->result['fault'] = $fault;
    }

    /**
    *  showMethodResult
    * print simple output about a methods result
    *
    * @param array endpoint_info
    * @param string method
    * @access public
    */
    function showTestResult($debug = 0, $html = 0) {
        // debug output
        if ($debug) $this->show = 1;
        if ($debug) {
            echo str_repeat("-",50).$html?"<br>\n":"\n";
        }

        echo "testing $this->test_name : ";

        if ($debug) {
            print "method params: ";
            print_r($this->params);
            print "\n";
        }

        $ok = $this->result['success'];
        if ($ok) {
            if ($html) {
                print "<font color=\"#00cc00\">SUCCESS</font>\n";
            } else {
                print "SUCCESS\n";
            }
        } else {
            $fault = $this->result['fault'];
            if ($fault) {
            		$res = $fault->faultcode;
                $pos = strpos($res,':');
                if ($pos !== false) {
                	$res = substr($res,$pos+1);                	
                }
                if ($html) {
                    print "<font color=\"#ff0000\">FAILED: [$res] {$fault->faultstring}</font>\n";
                } else {
                    print "FAILED: [$res] {$fault->faultstring}\n";
                }
            } else {
                if ($html) {
                    print "<font color=\"#ff0000\">FAILED: ".$this->result['result']."</font>\n";
                } else {
                    print "FAILED: ".$this->result['result']."\n";
                }
            }
        }
        if ($debug) {
            if ($html) {
                echo "<pre>\n".htmlentities($this->result['wire'])."</pre>\n";
            } else {
                echo "\n".htmlentities($this->result['wire'])."\n";
            }
        }
    }
}

# XXX I know this isn't quite right, need to deal with this better
function make_2d($x, $y)
{
    for ($_x = 0; $_x < $x; $_x++) {
        for ($_y = 0; $_y < $y; $_y++) {
            $a[$_x][$_y] = "x{$_x}y{$_y}";
        }
    }
    return $a;
}

function moap_value($name, $value, $type, $type_name=NULL, $type_ns=NULL) {
    return new moapParam(new moapVar($value,$type,$type_name,$type_ns),$name);
}

class moapStruct {
    var $varString;
    var $varInt;
    var $varFloat;
    function moapStruct($s, $i, $f) {
        $this->varString = $s;
        $this->varInt = $i;
        $this->varFloat = $f;
    }
}

//***********************************************************
// Base echoString

$moap_tests['base'][] = new moap_Test('echoString', array('inputString' => 'hello world!'));
$moap_tests['base'][] = new moap_Test('echoString', array('inputString' => moap_value('inputString','hello world',XSD_STRING)));
$moap_tests['base'][] = new moap_Test('echoString(empty)', array('inputString' => ''));
$moap_tests['base'][] = new moap_Test('echoString(empty)', array('inputString' => moap_value('inputString','',XSD_STRING)));
$moap_tests['base'][] = new moap_Test('echoString(null)', array('inputString' => NULL));
$moap_tests['base'][] = new moap_Test('echoString(null)', array('inputString' => moap_value('inputString',NULL,XSD_STRING)));
//$moap_tests['base'][] = new moap_Test('echoString(entities)', array('inputString' => ">,<,&,\",',0:\x00",1:\x01,2:\x02,3:\x03,4:\x04,5:\x05,6:\x06,7:\x07,8:\x08,9:\x09,10:\x0a,11:\x0b,12:\x0c,13:\x0d,14:\x0e,15:\x0f,16:\x10,17:\x11,18:\x12,19:\x13,20:\x14,21:\x15,22:\x16,23:\x17,24:\x18,25:\x19,26:\x1a,27:\x1b,28:\x1c,29:\x1d,30:\x1e,31:\x1f"));
//$moap_tests['base'][] = new moap_Test('echoString(entities)', array('inputString' => moap_value('inputString',">,<,&,\",',0:\x00",1:\x01,2:\x02,3:\x03,4:\x04,5:\x05,6:\x06,7:\x07,8:\x08,9:\x09,10:\x0a,11:\x0b,12:\x0c,13:\x0d,14:\x0e,15:\x0f,16:\x10,17:\x11,18:\x12,19:\x13,20:\x14,21:\x15,22:\x16,23:\x17,24:\x18,25:\x19,26:\x1a,27:\x1b,28:\x1c,29:\x1d,30:\x1e,31:\x1f",XSD_STRING)));
$moap_tests['base'][] = new moap_Test('echoString(entities)', array('inputString' => ">,<,&,\",',\\,\n"));
$moap_tests['base'][] = new moap_Test('echoString(entities)', array('inputString' => moap_value('inputString',">,<,&,\",',\\,\n",XSD_STRING)));
$test = new moap_Test('echoString(utf-8)', array('inputString' => utf8_encode('ỗÈéóÒ₧⅜ỗỸ')));
$test->encoding = 'UTF-8';
$moap_tests['base'][] = $test;
$test = new moap_Test('echoString(utf-8)', array('inputString' => moap_value('inputString',utf8_encode('ỗÈéóÒ₧⅜ỗỸ'),XSD_STRING)));
$test->encoding = 'UTF-8';
$moap_tests['base'][] = $test;

//***********************************************************
// Base echoStringArray

$moap_tests['base'][] = new moap_Test('echoStringArray',
        array('inputStringArray' => array('good','bad')));
$moap_tests['base'][] = new moap_Test('echoStringArray',
        array('inputStringArray' =>
            moap_value('inputStringArray',array('good','bad'),moap_ENC_ARRAY,"ArrayOfstring","http://moapinterop.org/xsd")));

$moap_tests['base'][] = new moap_Test('echoStringArray(one)',
        array('inputStringArray' => array('good')));
$moap_tests['base'][] = new moap_Test('echoStringArray(one)',
        array('inputStringArray' =>
            moap_value('inputStringArray',array('good'),moap_ENC_ARRAY,"ArrayOfstring","http://moapinterop.org/xsd")));

// empty array test
$moap_tests['base'][] = new moap_Test('echoStringArray(empty)', array('inputStringArray' => array()));
$moap_tests['base'][] = new moap_Test('echoStringArray(empty)', array('inputStringArray' => moap_value('inputStringArray',array(),moap_ENC_ARRAY,"ArrayOfstring","http://moapinterop.org/xsd")));

# XXX NULL Arrays not supported
// null array test
$moap_tests['base'][] = new moap_Test('echoStringArray(null)', array('inputStringArray' => NULL));
$moap_tests['base'][] = new moap_Test('echoStringArray(null)', array('inputStringArray' => moap_value('inputStringArray',NULL,moap_ENC_ARRAY,"ArrayOfstring","http://moapinterop.org/xsd")));

//***********************************************************
// Base echoInteger
$x = new moap_Test('echoInteger', array('inputInteger' => 34345));
$moap_tests['base'][] = new moap_Test('echoInteger', array('inputInteger' => 34345));
$moap_tests['base'][] = new moap_Test('echoInteger', array('inputInteger' => moap_value('inputInteger',12345,XSD_INT)));

//***********************************************************
// Base echoIntegerArray

$moap_tests['base'][] = new moap_Test('echoIntegerArray', array('inputIntegerArray' => array(1,234324324,2)));
$moap_tests['base'][] = new moap_Test('echoIntegerArray',
        array('inputIntegerArray' =>
            moap_value('inputIntegerArray',
                       array(new moapVar(12345,XSD_INT),new moapVar(654321,XSD_INT)),
                    moap_ENC_ARRAY,"ArrayOfint","http://moapinterop.org/xsd")));

//***********************************************************
// Base echoFloat

$moap_tests['base'][] = new moap_Test('echoFloat', array('inputFloat' => 342.23));
$moap_tests['base'][] = new moap_Test('echoFloat', array('inputFloat' => moap_value('inputFloat',123.45,XSD_FLOAT)));

//***********************************************************
// Base echoFloatArray

$moap_tests['base'][] = new moap_Test('echoFloatArray', array('inputFloatArray' => array(1.3223,34.2,325.325)));
$moap_tests['base'][] = new moap_Test('echoFloatArray',
        array('inputFloatArray' =>
            moap_value('inputFloatArray',
                       array(new moapVar(123.45,XSD_FLOAT),new moapVar(654.321,XSD_FLOAT)),
                    moap_ENC_ARRAY,"ArrayOffloat","http://moapinterop.org/xsd")));
//***********************************************************
// Base echoStruct

$moapstruct = new moapStruct('arg',34,325.325);
# XXX no way to set a namespace!!!
$moapmoapstruct = moap_value('inputStruct',$moapstruct,moap_ENC_OBJECT,"moapStruct","http://moapinterop.org/xsd");
$moap_tests['base'][] = new moap_Test('echoStruct', array('inputStruct' =>$moapstruct));
$moap_tests['base'][] = new moap_Test('echoStruct', array('inputStruct' =>$moapmoapstruct));

//***********************************************************
// Base echoStructArray

$moap_tests['base'][] = new moap_Test('echoStructArray', array('inputStructArray' => array(
        $moapstruct,$moapstruct,$moapstruct)));
$moap_tests['base'][] = new moap_Test('echoStructArray', array('inputStructArray' =>
         moap_value('inputStructArray',array(
           new moapVar($moapstruct,moap_ENC_OBJECT,"moapStruct","http://moapinterop.org/xsd"),
           new moapVar($moapstruct,moap_ENC_OBJECT,"moapStruct","http://moapinterop.org/xsd"),
           new moapVar($moapstruct,moap_ENC_OBJECT,"moapStruct","http://moapinterop.org/xsd")),
         moap_ENC_ARRAY,"ArrayOfmoapStruct","http://moapinterop.org/xsd")));


//***********************************************************
// Base echoVoid

$moap_tests['base'][] = new moap_Test('echoVoid', NULL);
$test = new moap_Test('echoVoid', NULL);
$test->type = 'moapval';
$moap_tests['base'][] = $test;

//***********************************************************
// Base echoBase64

$moap_tests['base'][] = new moap_Test('echoBase64', array('inputBase64' => 'TmVicmFza2E='));
$moap_tests['base'][] = new moap_Test('echoBase64', array('inputBase64' =>
        moap_value('inputBase64','TmVicmFza2E=',XSD_BASE64BINARY)));

//***********************************************************
// Base echoHexBinary

$moap_tests['base'][] = new moap_Test('echoHexBinary', array('inputHexBinary' => '736F61707834'),'736F61707834','hex_compare');
$moap_tests['base'][] = new moap_Test('echoHexBinary', array('inputHexBinary' =>
        moap_value('inputHexBinary','736F61707834',XSD_HEXBINARY)),'736F61707834','hex_compare');

//***********************************************************
// Base echoDecimal

# XXX test fails because php-moap incorrectly sets decimal to long rather than float
$moap_tests['base'][] = new moap_Test('echoDecimal', array('inputDecimal' => '12345.67890'));
$moap_tests['base'][] = new moap_Test('echoDecimal', array('inputDecimal' =>
        moap_value('inputDecimal','12345.67890',XSD_DECIMAL)));

//***********************************************************
// Base echoDate

# php-moap doesn't handle datetime types properly yet
$moap_tests['base'][] = new moap_Test('echoDate', array('inputDate' => '2001-05-24T17:31:41Z'), null, 'date_compare');
$moap_tests['base'][] = new moap_Test('echoDate', array('inputDate' =>
        moap_value('inputDate','2001-05-24T17:31:41Z',XSD_DATETIME)), null, 'date_compare');

//***********************************************************
// Base echoBoolean

# php-moap sends boolean as zero or one, which is ok, but to be explicit, send true or false.
$moap_tests['base'][] = new moap_Test('echoBoolean(true)', array('inputBoolean' => TRUE));
$moap_tests['base'][] = new moap_Test('echoBoolean(true)', array('inputBoolean' =>
        moap_value('inputBoolean',TRUE,XSD_BOOLEAN)));
$moap_tests['base'][] = new moap_Test('echoBoolean(false)', array('inputBoolean' => FALSE));
$moap_tests['base'][] = new moap_Test('echoBoolean(false)', array('inputBoolean' =>
        moap_value('inputBoolean',FALSE,XSD_BOOLEAN)));
$moap_tests['base'][] = new moap_Test('echoBoolean(1)', array('inputBoolean' => 1),true);
$moap_tests['base'][] = new moap_Test('echoBoolean(1)', array('inputBoolean' =>
        moap_value('inputBoolean',1,XSD_BOOLEAN)),true);
$moap_tests['base'][] = new moap_Test('echoBoolean(0)', array('inputBoolean' => 0),false);
$moap_tests['base'][] = new moap_Test('echoBoolean(0)', array('inputBoolean' =>
        moap_value('inputBoolean',0,XSD_BOOLEAN)),false);



//***********************************************************
// GROUP B


//***********************************************************
// GroupB echoStructAsSimpleTypes

$expect = array(
        'outputString'=>'arg',
        'outputInteger'=>34,
        'outputFloat'=>325.325
    );
$moap_tests['GroupB'][] = new moap_Test('echoStructAsSimpleTypes',
    array('inputStruct' => (object)array(
        'varString'=>'arg',
        'varInt'=>34,
        'varFloat'=>325.325
    )), $expect);
$moap_tests['GroupB'][] = new moap_Test('echoStructAsSimpleTypes',
    array('inputStruct' =>
          moap_value('inputStruct',
            (object)array('varString' => 'arg',
                					'varInt'    => 34,
                          'varFloat'  => 325.325
            ), moap_ENC_OBJECT, "moapStruct","http://moapinterop.org/xsd")), $expect);

//***********************************************************
// GroupB echoSimpleTypesAsStruct

$expect =
    (object)array(
        'varString'=>'arg',
        'varInt'=>34,
        'varFloat'=>325.325
    );
$moap_tests['GroupB'][] = new moap_Test('echoSimpleTypesAsStruct',
    array(
        'inputString'=>'arg',
        'inputInteger'=>34,
        'inputFloat'=>325.325
    ), $expect);
$moap_tests['GroupB'][] = new moap_Test('echoSimpleTypesAsStruct',
    array(
        moap_value('inputString','arg', XSD_STRING),
        moap_value('inputInteger',34, XSD_INT),
        moap_value('inputFloat',325.325, XSD_FLOAT)
    ), $expect);

//***********************************************************
// GroupB echo2DStringArray

$moap_tests['GroupB'][] = new moap_Test('echo2DStringArray',
    array('input2DStringArray' => make_2d(3,3)));

$multidimarray =
    moap_value('input2DStringArray',
        array(
            array('row0col0', 'row0col1', 'row0col2'),
            array('row1col0', 'row1col1', 'row1col2')
        ), moap_ENC_ARRAY
    );
//$multidimarray->options['flatten'] = TRUE;
$moap_tests['GroupB'][] = new moap_Test('echo2DStringArray',
    array('input2DStringArray' => $multidimarray));

//***********************************************************
// GroupB echoNestedStruct

$strstr = (object)array(
        'varString'=>'arg',
        'varInt'=>34,
        'varFloat'=>325.325,
        'varStruct' => (object)array(
            'varString'=>'arg',
            'varInt'=>34,
            'varFloat'=>325.325
        ));
$moap_tests['GroupB'][] = new moap_Test('echoNestedStruct',
    array('inputStruct' => $strstr));
$moap_tests['GroupB'][] = new moap_Test('echoNestedStruct',
    array('inputStruct' =>
        moap_value('inputStruct',
						(object)array(
				        'varString'=>'arg',
        				'varInt'=>34,
				        'varFloat'=>325.325,
        				'varStruct' => new moapVar((object)array(
				            'varString'=>'arg',
        				    'varInt'=>34,
				            'varFloat'=>325.325
        				), moap_ENC_OBJECT, "moapStruct","http://moapinterop.org/xsd")
            ), moap_ENC_OBJECT, "moapStructStruct","http://moapinterop.org/xsd"
        )),$strstr);

//***********************************************************
// GroupB echoNestedArray

$arrstr = (object)array(
        'varString'=>'arg',
        'varInt'=>34,
        'varFloat'=>325.325,
        'varArray' => array('red','blue','green')
    );
$moap_tests['GroupB'][] = new moap_Test('echoNestedArray',
    array('inputStruct' => $arrstr));
$moap_tests['GroupB'][] = new moap_Test('echoNestedArray',
    array('inputStruct' =>
        moap_value('inputStruct',
            (object)array('varString' => 'arg',
                          'varInt'    => 34,
                          'varFloat'  => 325.325,
                          'varArray'  =>
                    new moapVar(array("red", "blue", "green"), moap_ENC_ARRAY, "ArrayOfstring","http://moapinterop.org/xsd")
                ), moap_ENC_OBJECT, "moapArrayStruct","http://moapinterop.org/xsd"
        )),$arrstr);


//***********************************************************
// GROUP C header tests

//***********************************************************
// echoMeStringRequest

// echoMeStringRequest with endpoint as header destination, doesn't have to understand
$test = new moap_Test('echoVoid(echoMeStringRequest mustUnderstand=0 actor=next)', NULL);
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeStringRequest', 'hello world', 0, moap_ACTOR_NEXT);
$test->headers_expect = array('echoMeStringResponse'=>'hello world');
$moap_tests['GroupC'][] = $test;

$test = new moap_Test('echoVoid(echoMeStringRequest mustUnderstand=0 actor=next)', NULL);
$test->type = 'moapval';
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeStringRequest', new moapVar('hello world',XSD_STRING), 0, moap_ACTOR_NEXT);
$test->headers_expect = array('echoMeStringResponse'=>'hello world');
$moap_tests['GroupC'][] = $test;

// echoMeStringRequest with endpoint as header destination, must understand
$test = new moap_Test('echoVoid(echoMeStringRequest mustUnderstand=1 actor=next)', NULL);
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeStringRequest', 'hello world', 1, moap_ACTOR_NEXT);
$test->headers_expect = array('echoMeStringResponse'=>'hello world');
$moap_tests['GroupC'][] = $test;

$test = new moap_Test('echoVoid(echoMeStringRequest mustUnderstand=1 actor=next)', NULL);
$test->type = 'moapval';
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeStringRequest', new moapVar('hello world',XSD_STRING), 1, moap_ACTOR_NEXT);
$test->headers_expect = array('echoMeStringResponse'=>'hello world');
$moap_tests['GroupC'][] = $test;

// echoMeStringRequest with endpoint NOT header destination, doesn't have to understand
$test = new moap_Test('echoVoid(echoMeStringRequest mustUnderstand=0 actor=other)', NULL);
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeStringRequest', 'hello world', 0, moap_TEST_ACTOR_OTHER);
$test->headers_expect = array();
$moap_tests['GroupC'][] = $test;

$test = new moap_Test('echoVoid(echoMeStringRequest mustUnderstand=0 actor=other)', NULL);
$test->type = 'moapval';
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeStringRequest', new moapVar('hello world',XSD_STRING), 0, moap_TEST_ACTOR_OTHER);
$test->headers_expect = array();
$moap_tests['GroupC'][] = $test;

// echoMeStringRequest with endpoint NOT header destination, must understand
$test = new moap_Test('echoVoid(echoMeStringRequest mustUnderstand=1 actor=other)', NULL);
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeStringRequest', 'hello world', 1, moap_TEST_ACTOR_OTHER);
$test->headers_expect = array();
$moap_tests['GroupC'][] = $test;

$test = new moap_Test('echoVoid(echoMeStringRequest mustUnderstand=1 actor=other)', NULL);
$test->type = 'moapval';
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeStringRequest', new moapVar('hello world', XSD_STRING), 1, moap_TEST_ACTOR_OTHER);
$test->headers_expect = array();
$moap_tests['GroupC'][] = $test;

// echoMeStringRequest with endpoint header destination, must understand,
// invalid namespace, should recieve a fault
$test = new moap_Test('echoVoid(echoMeStringRequest invalid namespace)', NULL);
$test->headers[] = new moapHeader('http://unknown.org/echoheader/','echoMeStringRequest', 'hello world', 1, moap_ACTOR_NEXT);
$test->headers_expect = array();
$test->expect_fault = TRUE;
$moap_tests['GroupC'][] = $test;

$test = new moap_Test('echoVoid(echoMeStringRequest invalid namespace)', NULL);
$test->type = 'moapval';
$test->headers[] = new moapHeader('http://unknown.org/echoheader/','echoMeStringRequest', new moapVar('hello world', XSD_STRING), 1, moap_ACTOR_NEXT);
$test->headers_expect = array();
$test->expect_fault = TRUE;
$moap_tests['GroupC'][] = $test;

//***********************************************************
// echoMeStructRequest

// echoMeStructRequest with endpoint as header destination, doesn't have to understand
$test = new moap_Test('echoVoid(echoMeStructRequest mustUnderstand=0 actor=next)', NULL);
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeStructRequest',
        new moapStruct('arg',34,325.325), 0, moap_ACTOR_NEXT);
$test->headers_expect =
    array('echoMeStructResponse'=> (object)array('varString'=>'arg','varInt'=>34,'varFloat'=>325.325));
$moap_tests['GroupC'][] = $test;

$test = new moap_Test('echoVoid(echoMeStructRequest mustUnderstand=0 actor=next)', NULL);
$test->type = 'moapval';
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeStructRequest',
            new moapVar(new moapStruct('arg',34,325.325),moap_ENC_OBJECT,"moapStruct","http://moapinterop.org/xsd"),
            0, moap_ACTOR_NEXT);
$test->headers_expect =
    array('echoMeStructResponse'=> (object)array('varString'=>'arg','varInt'=>34,'varFloat'=>325.325));
$moap_tests['GroupC'][] = $test;

// echoMeStructRequest with endpoint as header destination, must understand
$test = new moap_Test('echoVoid(echoMeStructRequest mustUnderstand=1 actor=next)', NULL);
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeStructRequest',
        new moapStruct('arg',34,325.325), 1, moap_ACTOR_NEXT);
$test->headers_expect =
    array('echoMeStructResponse'=> (object)array('varString'=>'arg','varInt'=>34,'varFloat'=>325.325));
$moap_tests['GroupC'][] = $test;

$test = new moap_Test('echoVoid(echoMeStructRequest mustUnderstand=1 actor=next)', NULL);
$test->type = 'moapval';
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeStructRequest',
            new moapVar(new moapStruct('arg',34,325.325),moap_ENC_OBJECT,"moapStruct","http://moapinterop.org/xsd"),
            1, moap_ACTOR_NEXT);
$test->headers_expect =
    array('echoMeStructResponse'=> (object)array('varString'=>'arg','varInt'=>34,'varFloat'=>325.325));
$moap_tests['GroupC'][] = $test;

// echoMeStructRequest with endpoint NOT header destination, doesn't have to understand
$test = new moap_Test('echoVoid(echoMeStructRequest mustUnderstand=0 actor=other)', NULL);
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeStructRequest',
        new moapStruct('arg',34,325.325), 0, moap_TEST_ACTOR_OTHER);
$test->headers_expect = array();
$moap_tests['GroupC'][] = $test;

$test = new moap_Test('echoVoid(echoMeStructRequest mustUnderstand=0 actor=other)', NULL);
$test->type = 'moapval';
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeStructRequest',
            new moapVar(new moapStruct('arg',34,325.325),moap_ENC_OBJECT,"moapStruct","http://moapinterop.org/xsd"),
            0, moap_TEST_ACTOR_OTHER);
$test->headers_expect = array();
$moap_tests['GroupC'][] = $test;

// echoMeStructRequest with endpoint NOT header destination, must understand
$test = new moap_Test('echoVoid(echoMeStructRequest mustUnderstand=1 actor=other)', NULL);
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeStructRequest',
        new moapStruct('arg',34,325.325), 1, moap_TEST_ACTOR_OTHER);
$test->headers_expect = array();
$moap_tests['GroupC'][] = $test;

$test = new moap_Test('echoVoid(echoMeStructRequest mustUnderstand=1 actor=other)', NULL);
$test->type = 'moapval';
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeStructRequest',
            new moapVar(new moapStruct('arg',34,325.325),moap_ENC_OBJECT,"moapStruct","http://moapinterop.org/xsd"),
            1, moap_TEST_ACTOR_OTHER);
$test->headers_expect = array();
$moap_tests['GroupC'][] = $test;

//***********************************************************
// echoMeUnknown

// echoMeUnknown with endpoint as header destination, doesn't have to understand
$test = new moap_Test('echoVoid(echoMeUnknown mustUnderstand=0 actor=next)', NULL);
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeUnknown', 'nobody understands me!',0,moap_ACTOR_NEXT);
$test->headers_expect = array();
$moap_tests['GroupC'][] = $test;

$test = new moap_Test('echoVoid(echoMeUnknown mustUnderstand=0 actor=next)', NULL);
$test->type = 'moapval';
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeUnknown', new moapVar('nobody understands me!',XSD_STRING),0,moap_ACTOR_NEXT);
$test->headers_expect = array();
$moap_tests['GroupC'][] = $test;

// echoMeUnknown with endpoint as header destination, must understand
$test = new moap_Test('echoVoid(echoMeUnknown mustUnderstand=1 actor=next)', NULL);
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeUnknown', 'nobody understands me!',1,moap_ACTOR_NEXT);
$test->headers_expect = array();
$test->expect_fault = TRUE;
$moap_tests['GroupC'][] = $test;

$test = new moap_Test('echoVoid(echoMeUnknown mustUnderstand=1 actor=next)', NULL);
$test->type = 'moapval';
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeUnknown', new moapVar('nobody understands me!',XSD_STRING),1,moap_ACTOR_NEXT);
$test->headers_expect = array();
$test->expect_fault = TRUE;
$moap_tests['GroupC'][] = $test;

// echoMeUnknown with endpoint NOT header destination, doesn't have to understand
$test = new moap_Test('echoVoid(echoMeUnknown mustUnderstand=0 actor=other)', NULL);
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeUnknown', 'nobody understands me!',0,moap_TEST_ACTOR_OTHER);
$test->headers_expect = array();
$moap_tests['GroupC'][] = $test;

$test = new moap_Test('echoVoid(echoMeUnknown mustUnderstand=0 actor=other)', NULL);
$test->type = 'moapval';
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeUnknown', new moapVar('nobody understands me!',XSD_STRING),0,moap_TEST_ACTOR_OTHER);
$test->headers_expect = array();
$moap_tests['GroupC'][] = $test;

// echoMeUnknown with endpoint NOT header destination, must understand
$test = new moap_Test('echoVoid(echoMeUnknown mustUnderstand=1 actor=other)', NULL);
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeUnknown', 'nobody understands me!',1,moap_TEST_ACTOR_OTHER);
$test->headers_expect = array();
$moap_tests['GroupC'][] = $test;

$test = new moap_Test('echoVoid(echoMeUnknown mustUnderstand=1 actor=other)', NULL);
$test->type = 'moapval';
$test->headers[] = new moapHeader('http://moapinterop.org/echoheader/','echoMeUnknown', new moapVar('nobody understands me!',XSD_STRING),1,moap_TEST_ACTOR_OTHER);
$test->headers_expect = array();
$moap_tests['GroupC'][] = $test;
?>
