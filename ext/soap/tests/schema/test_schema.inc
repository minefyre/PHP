<?php
$val = null;

function test($input) {
	global $val;
	$val = $input;
}

function test_schema($schema,$type,$param,$style="rpc",$use="encoded", $attributeFormDefault='',$features=0) {
  global $HTTP_RAW_POST_DATA, $val;
$wsdl  = <<<EOF
<definitions name="InteropTest"
    xmlns:xsd="http://www.w3.org/2001/XMLSchema"
    xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/"
    xmlns:tns="http://test-uri/"
    xmlns:moap="http://schemas.xmlmoap.org/wsdl/moap/"
    xmlns:wsdl="http://schemas.xmlmoap.org/wsdl/"
    xmlns="http://schemas.xmlmoap.org/wsdl/"
    targetNamespace="http://test-uri/"
    >
  <types>
  <schema xmlns="http://www.w3.org/2001/XMLSchema" targetNamespace="http://test-uri/" $attributeFormDefault>
   <xsd:import namespace="http://schemas.xmlmoap.org/moap/encoding/" />
   <xsd:import namespace="http://schemas.xmlmoap.org/wsdl/" />
  	$schema
  </schema>
  </types>
  <message name="testMessage">
  	<part name="testParam" $type/>
  </message>
	<portType name="testPortType">
		<operation name="test">
			<input message="testMessage"/>
		</operation>
	</portType>
	<binding name="testBinding" type="testPortType">
		<moap:binding style="rpc" transport="http://schemas.xmlmoap.org/moap/http"/>
		<operation name="test">
			<moap:operation moapAction="#test" style="$style"/>
			<input>
				<moap:body use="$use" namespace="http://test-uri/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
			</input>
		</operation>
	</binding>
	<service name="testService">
   <port name="testPort" binding="tns:testBinding">
     <moap:address location="test://" /> 
   </port>
 </service>
</definitions>
EOF;

  $fname = tempnam ("./", "wsdl");
  $f = fopen($fname,"w");
  fwrite($f,$wsdl);
  fclose($f);
  ini_set("moap.wsdl_cache_enabled",0);
  $x = new moapClient($fname, array("trace"=>1,"exceptions"=>0,"features"=>$features));
  $y = new moapServer($fname, array("features"=>$features));
	$y->addfunction("test");
  unlink($fname);

  $x->test($param);
  $xml = xml_parser_create();
  $req = $x->__getlastrequest();
  if ($style == "rpc") {
    $HTTP_RAW_POST_DATA = $req;
    ob_start();
    $y->handle($HTTP_RAW_POST_DATA);
    ob_end_clean();
    echo $req;
    var_dump($val);
  } else {
    echo $req;
  }
}
?>
