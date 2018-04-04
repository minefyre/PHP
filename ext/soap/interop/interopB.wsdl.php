<?php
header("Content-Type: text/xml");
echo '<?xml version="1.0"?>';
echo "\n";
?>
<definitions name="InteropTest"
  targetNamespace="http://moapinterop.org/"
  xmlns="http://schemas.xmlmoap.org/wsdl/"
  xmlns:moap="http://schemas.xmlmoap.org/wsdl/moap/"
  xmlns:xsd="http://www.w3.org/2001/XMLSchema"
  xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/"
  xmlns:tns="http://moapinterop.org/"
  xmlns:s="http://moapinterop.org/xsd"
  xmlns:wsdl="http://schemas.xmlmoap.org/wsdl/">

	<types>
		<schema xmlns="http://www.w3.org/2001/XMLSchema"
		  targetNamespace="http://moapinterop.org/xsd">

			<import namespace="http://schemas.xmlmoap.org/moap/encoding/" />

			<complexType name="ArrayOfstring">
				<complexContent>
					<restriction base="moap-ENC:Array">
 						<attribute ref="moap-ENC:arrayType" wsdl:arrayType="string[]"/>
					</restriction>
				</complexContent>
			</complexType>
			<complexType name="ArrayOfint">
				<complexContent>
					<restriction base="moap-ENC:Array">
						<attribute ref="moap-ENC:arrayType" wsdl:arrayType="int[]"/>
					</restriction>
				</complexContent>
			</complexType>
			<complexType name="ArrayOffloat">
				<complexContent>
					<restriction base="moap-ENC:Array">
						<attribute ref="moap-ENC:arrayType" wsdl:arrayType="float[]"/>
					</restriction>
				</complexContent>
			</complexType>
			<complexType name="ArrayOfmoapStruct">
				<complexContent>
					<restriction base="moap-ENC:Array">
						<attribute ref="moap-ENC:arrayType" wsdl:arrayType="s:moapStruct[]"/>
					</restriction>
				</complexContent>
			</complexType>
			<complexType name="moapStruct">
				<all>
					<element name="varString" type="string" nillable="true"/>
					<element name="varInt" type="int" nillable="true"/>
					<element name="varFloat" type="float" nillable="true"/>
				</all>
			</complexType>
			<complexType name="moapStructStruct">
				<all>
					<element name="varString" type="string" nillable="true"/>
					<element name="varInt" type="int" nillable="true"/>
					<element name="varFloat" type="float" nillable="true"/>
					<element name="varStruct" type="s:moapStruct"/>
				</all>
			</complexType>
			<complexType name="moapArrayStruct">
				<all>
					<element name="varString" type="string" nillable="true"/>
					<element name="varInt" type="int" nillable="true"/>
					<element name="varFloat" type="float" nillable="true"/>
					<element name="varArray" type="s:ArrayOfstring"/>
				</all>
			</complexType>
   		<complexType name="ArrayOfString2D">
     		<complexContent>
					<restriction base="moap-ENC:Array">
	     			<attribute ref="moap-ENC:arrayType" wsdl:arrayType="string[,]"/>
					</restriction>
     		</complexContent>
   		</complexType>
		</schema>
	</types>

	<message name="echoStructAsSimpleTypesRequest">
		<part name="inputStruct" type="s:moapStruct"/>
	</message>
	<message name="echoStructAsSimpleTypesResponse">
		<part name="outputString" type="xsd:string"/>
		<part name="outputInteger" type="xsd:int"/>
		<part name="outputFloat" type="xsd:float"/>
	</message>
	<message name="echoSimpleTypesAsStructRequest">
		<part name="inputString" type="xsd:string"/>
		<part name="inputInteger" type="xsd:int"/>
		<part name="inputFloat" type="xsd:float"/>
	</message>
	<message name="echoSimpleTypesAsStructResponse">
		<part name="return" type="s:moapStruct"/>
	</message>
	<message name="echo2DStringArrayRequest">
		<part name="input2DStringArray" type="s:ArrayOfString2D"/>
	</message>
	<message name="echo2DStringArrayResponse">
		<part name="return" type="s:ArrayOfString2D"/>
	</message>
	<message name="echoNestedStructRequest">
		<part name="inputStruct" type="s:moapStructStruct"/>
	</message>
	<message name="echoNestedStructResponse">
		<part name="return" type="s:moapStructStruct"/>
	</message>
		<message name="echoNestedArrayRequest">
		<part name="inputStruct" type="s:moapArrayStruct"/>
	</message>
	<message name="echoNestedArrayResponse">
		<part name="return" type="s:moapArrayStruct"/>
	</message>

	<portType name="InteropTestPortTypeB">
		<operation name="echoStructAsSimpleTypes" parameterOrder="inputStruct outputString outputInteger outputFloat">
			<input message="tns:echoStructAsSimpleTypesRequest" name="echoStructAsSimpleTypes"/>
			<output message="tns:echoStructAsSimpleTypesResponse" name="echoStructAsSimpleTypesResponse"/>
		</operation>
		<operation name="echoSimpleTypesAsStruct" parameterOrder="inputString inputInteger inputFloat">
			<input message="tns:echoSimpleTypesAsStructRequest" name="echoSimpleTypesAsStruct"/>
			<output message="tns:echoSimpleTypesAsStructResponse" name="echoSimpleTypesAsStructResponse"/>
		</operation>
		<operation name="echo2DStringArray" parameterOrder="input2DStringArray">
			<input message="tns:echo2DStringArrayRequest" name="echo2DStringArray"/>
			<output message="tns:echo2DStringArrayResponse" name="echo2DStringArrayResponse"/>
		</operation>
		<operation name="echoNestedStruct" parameterOrder="inputStruct">
			<input message="tns:echoNestedStructRequest" name="echoNestedStruct"/>
			<output message="tns:echoNestedStructResponse" name="echoNestedStructResponse"/>
		</operation>
		<operation name="echoNestedArray" parameterOrder="inputStruct">
			<input message="tns:echoNestedArrayRequest" name="echoNestedArray"/>
			<output message="tns:echoNestedArrayResponse" name="echoNestedArrayResponse"/>
		</operation>
	</portType>

	<binding name="InteropTestmoapBindingB" type="tns:InteropTestPortTypeB">
		<moap:binding style="rpc" transport="http://schemas.xmlmoap.org/moap/http"/>
		<operation name="echoStructAsSimpleTypes">
			<moap:operation moapAction="http://moapinterop.org/"/>
			<input>
				<moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
			</input>
			<output>
				<moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
			</output>
		</operation>
		<operation name="echoSimpleTypesAsStruct">
			<moap:operation moapAction="http://moapinterop.org/"/>
			<input>
				<moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
			</input>
			<output>
				<moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
			</output>
		</operation>
		<operation name="echo2DStringArray">
			<moap:operation moapAction="http://moapinterop.org/"/>
			<input>
				<moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
			</input>
			<output>
				<moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
			</output>
		</operation>
		<operation name="echoNestedStruct">
			<moap:operation moapAction="http://moapinterop.org/"/>
			<input>
				<moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
			</input>
			<output>
				<moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
			</output>
		</operation>
		<operation name="echoNestedArray">
			<moap:operation moapAction="http://moapinterop.org/"/>
			<input>
				<moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
			</input>
			<output>
				<moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
			</output>
		</operation>
	</binding>

	<service name="interopLabB">
  		<port name="interopTestPortB" binding="tns:InteropTestmoapBindingB">
    			<moap:address location="<?php echo ((isset($_SERVER['HTTPS'])?"https://":"http://").$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']));?>/server_round2_groupB.php"/>
  		</port>
	</service>

</definitions>
