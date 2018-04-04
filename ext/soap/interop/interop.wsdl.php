<?php
header("Content-Type: text/xml");
echo '<?xml version="1.0"?>';
echo "\n";
?>
<definitions name="InteropTest"
    xmlns:xsd="http://www.w3.org/2001/XMLSchema"
    xmlns:moap-ENC="http://schemas.xmlmoap.org/moap/encoding/"
    xmlns:tns="http://moapinterop.org/"
    xmlns:s="http://moapinterop.org/xsd"
    xmlns:moap="http://schemas.xmlmoap.org/wsdl/moap/"
    xmlns:wsdl="http://schemas.xmlmoap.org/wsdl/"
    xmlns="http://schemas.xmlmoap.org/wsdl/"
    targetNamespace="http://moapinterop.org/">

  <types>
  <schema xmlns="http://www.w3.org/2001/XMLSchema" targetNamespace="http://moapinterop.org/xsd">
   <xsd:import namespace="http://schemas.xmlmoap.org/moap/encoding/" />
   <xsd:import namespace="http://schemas.xmlmoap.org/wsdl/" />
   <xsd:complexType name="ArrayOfstring">
    <xsd:complexContent>
     <xsd:restriction base="moap-ENC:Array">
      <xsd:attribute ref="moap-ENC:arrayType" wsdl:arrayType="string[]"/>
     </xsd:restriction>
    </xsd:complexContent>
   </xsd:complexType>
   <xsd:complexType name="ArrayOfint">
    <xsd:complexContent>
     <xsd:restriction base="moap-ENC:Array">
      <xsd:attribute ref="moap-ENC:arrayType" wsdl:arrayType="int[]"/>
     </xsd:restriction>
    </xsd:complexContent>
   </xsd:complexType>
   <xsd:complexType name="ArrayOffloat">
    <xsd:complexContent>
     <xsd:restriction base="moap-ENC:Array">
      <xsd:attribute ref="moap-ENC:arrayType" wsdl:arrayType="float[]"/>
     </xsd:restriction>
    </xsd:complexContent>
   </xsd:complexType>
   <xsd:complexType name="moapStruct">
    <xsd:all>
     <xsd:element name="varString" type="string"/>
     <xsd:element name="varInt" type="int"/>
     <xsd:element name="varFloat" type="float"/>
    </xsd:all>
   </xsd:complexType>
   <xsd:complexType name="ArrayOfmoapStruct">
    <xsd:complexContent>
     <xsd:restriction base="moap-ENC:Array">
      <xsd:attribute ref="moap-ENC:arrayType" wsdl:arrayType="s:moapStruct[]"/>
     </xsd:restriction>
    </xsd:complexContent>
   </xsd:complexType>
  </schema>
  </types>

  <message name="echoStringRequest">
    <part name="inputString" type="xsd:string" />
  </message>
  <message name="echoStringResponse">
    <part name="outputString" type="xsd:string" />
  </message>
  <message name="echoStringArrayRequest">
    <part name="inputStringArray" type="s:ArrayOfstring" />
  </message>
  <message name="echoStringArrayResponse">
    <part name="outputStringArray" type="s:ArrayOfstring" />
  </message>
  <message name="echoIntegerRequest">
    <part name="inputInteger" type="xsd:int" />
  </message>
  <message name="echoIntegerResponse">
    <part name="outputInteger" type="xsd:int" />
  </message>
  <message name="echoIntegerArrayRequest">
    <part name="inputIntegerArray" type="s:ArrayOfint" />
  </message>
  <message name="echoIntegerArrayResponse">
    <part name="outputIntegerArray" type="s:ArrayOfint" />
  </message>
  <message name="echoFloatRequest">
    <part name="inputFloat" type="xsd:float" />
  </message>
  <message name="echoFloatResponse">
    <part name="outputFloat" type="xsd:float" />
  </message>
  <message name="echoFloatArrayRequest">
    <part name="inputFloatArray" type="s:ArrayOffloat" />
  </message>
  <message name="echoFloatArrayResponse">
    <part name="outputFloatArray" type="s:ArrayOffloat" />
  </message>
  <message name="echoStructRequest">
    <part name="inputStruct" type="s:moapStruct" />
  </message>
  <message name="echoStructResponse">
    <part name="outputStruct" type="s:moapStruct" />
  </message>
  <message name="echoStructArrayRequest">
    <part name="inputStructArray" type="s:ArrayOfmoapStruct" />
  </message>
  <message name="echoStructArrayResponse">
    <part name="outputStructArray" type="s:ArrayOfmoapStruct" />
  </message>
  <message name="echoVoidRequest">
  </message>
  <message name="echoVoidResponse">
  </message>
  <message name="echoBase64Request">
    <part name="inputBase64" type="xsd:base64Binary" />
  </message>
  <message name="echoBase64Response">
    <part name="outputBase64" type="xsd:base64Binary" />
  </message>
  <message name="echoDateRequest">
    <part name="inputDate" type="xsd:dateTime" />
  </message>
  <message name="echoDateResponse">
    <part name="outputDate" type="xsd:dateTime" />
  </message>
  <message name="echoHexBinaryRequest">
    <part name="inputHexBinary" type="xsd:hexBinary" />
  </message>
  <message name="echoHexBinaryResponse">
    <part name="outputHexBinary" type="xsd:hexBinary" />
  </message>
  <message name="echoDecimalRequest">
    <part name="inputDecimal" type="xsd:decimal" />
  </message>
  <message name="echoDecimalResponse">
    <part name="outputDecimal" type="xsd:decimal" />
  </message>
  <message name="echoBooleanRequest">
    <part name="inputBoolean" type="xsd:boolean" />
  </message>
  <message name="echoBooleanResponse">
    <part name="outputBoolean" type="xsd:boolean" />
  </message>

  <portType name="InteropTestPortType">
    <operation name="echoString">
      <input message="tns:echoStringRequest"/>
      <output message="tns:echoStringResponse"/>
    </operation>
    <operation name="echoStringArray">
      <input message="tns:echoStringArrayRequest"/>
      <output message="tns:echoStringArrayResponse"/>
    </operation>
    <operation name="echoInteger">
      <input message="tns:echoIntegerRequest"/>
      <output message="tns:echoIntegerResponse"/>
    </operation>
    <operation name="echoIntegerArray">
      <input message="tns:echoIntegerArrayRequest"/>
      <output message="tns:echoIntegerArrayResponse"/>
    </operation>
    <operation name="echoFloat">
      <input message="tns:echoFloatRequest"/>
      <output message="tns:echoFloatResponse"/>
    </operation>
    <operation name="echoFloatArray">
      <input message="tns:echoFloatArrayRequest"/>
      <output message="tns:echoFloatArrayResponse"/>
    </operation>
    <operation name="echoStruct">
      <input message="tns:echoStructRequest"/>
      <output message="tns:echoStructResponse"/>
    </operation>
    <operation name="echoStructArray">
      <input message="tns:echoStructArrayRequest"/>
      <output message="tns:echoStructArrayResponse"/>
    </operation>
    <operation name="echoVoid">
      <input message="tns:echoVoidRequest"/>
      <output message="tns:echoVoidResponse"/>
    </operation>
    <operation name="echoBase64">
      <input message="tns:echoBase64Request"/>
      <output message="tns:echoBase64Response"/>
    </operation>
    <operation name="echoDate">
      <input message="tns:echoDateRequest"/>
      <output message="tns:echoDateResponse"/>
    </operation>
    <operation name="echoHexBinary">
      <input message="tns:echoHexBinaryRequest"/>
      <output message="tns:echoHexBinaryResponse"/>
    </operation>
    <operation name="echoDecimal">
      <input message="tns:echoDecimalRequest"/>
      <output message="tns:echoDecimalResponse"/>
    </operation>
    <operation name="echoBoolean">
      <input message="tns:echoBooleanRequest"/>
      <output message="tns:echoBooleanResponse"/>
    </operation>
  </portType>

  <binding name="InteropTestBinding" type="tns:InteropTestPortType">
    <moap:binding style="rpc" transport="http://schemas.xmlmoap.org/moap/http"/>
    <operation name="echoString">
      <moap:operation moapAction="http://" style="rpc"/>
      <input>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </input>
      <output>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </output>
    </operation>
    <operation name="echoStringArray">
      <moap:operation moapAction="http://" style="rpc"/>
      <input>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </input>
      <output>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </output>
    </operation>
    <operation name="echoInteger">
      <moap:operation moapAction="http://" style="rpc"/>
      <input>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </input>
      <output>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </output>
    </operation>
    <operation name="echoIntegerArray">
      <moap:operation moapAction="http://" style="rpc"/>
      <input>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </input>
      <output>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </output>
    </operation>
    <operation name="echoFloat">
      <moap:operation moapAction="http://" style="rpc"/>
      <input>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </input>
      <output>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </output>
    </operation>
    <operation name="echoFloatArray">
      <moap:operation moapAction="http://" style="rpc"/>
      <input>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </input>
      <output>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </output>
    </operation>
    <operation name="echoStruct">
      <moap:operation moapAction="http://" style="rpc"/>
      <input>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </input>
      <output>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </output>
    </operation>
    <operation name="echoStructArray">
      <moap:operation moapAction="http://" style="rpc"/>
      <input>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </input>
      <output>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </output>
    </operation>
    <operation name="echoVoid">
      <moap:operation moapAction="http://" style="rpc"/>
      <input>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </input>
      <output>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </output>
    </operation>
    <operation name="echoBase64">
      <moap:operation moapAction="http://" style="rpc"/>
      <input>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </input>
      <output>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </output>
    </operation>
    <operation name="echoDate">
      <moap:operation moapAction="http://" style="rpc"/>
      <input>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </input>
      <output>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </output>
    </operation>
    <operation name="echoHexBinary">
      <moap:operation moapAction="http://" style="rpc"/>
      <input>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </input>
      <output>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </output>
    </operation>
    <operation name="echoDecimal">
      <moap:operation moapAction="http://" style="rpc"/>
      <input>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </input>
      <output>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </output>
    </operation>
    <operation name="echoBoolean">
      <moap:operation moapAction="http://" style="rpc"/>
      <input>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </input>
      <output>
        <moap:body use="encoded" namespace="http://moapinterop.org/" encodingStyle="http://schemas.xmlmoap.org/moap/encoding/"/>
      </output>
    </operation>
  </binding>

  <service name="InteropTest">
    <port name="InteropTestPort" binding="tns:InteropTestBinding">
			<moap:address location="<?php echo ((isset($_SERVER['HTTPS'])?"https://":"http://").$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']));?>/server_round2_base.php"/>
    </port>
  </service>

</definitions>
