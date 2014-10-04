<?php

class Atlasp_Xml_Xmltrans
{
    /**
     * @param SimpleXMLElement $xml - should only be used recursively
     */


    public static function toXML( $data, $rootNodeName = 'data', &$xml=null ) {

	if ( ini_get('zend.ze1_compatibility_mode') == 1 ) ini_set ( 'zend.ze1_compatibility_mode', 0 );
	if ( is_null( $xml ) ) #$xml = simplexml_load_string( "" );
	    $xml = simplexml_load_string("<$rootNodeName />");

	foreach( $data as $key => $value ) {

	    $numeric=0;
	    if ( is_numeric( $key ) ) {
		$numeric = 1;
		$key = $rootNodeName;
	    }

	    $key = preg_replace('/[^a-z0-9\-\_\.\:]/i', '', $key);

	    if ( is_array( $value ) ) {
		$node = Atlasp_Xml_Xmltrans::isAssoc( $value ) || $numeric ? $xml->addChild( $key ) : $xml;
		if ( $numeric ) $key = 'anon';
		Atlasp_Xml_Xmltrans::toXml( $value, $key, $node );
	    } else {
		$value = htmlentities( $value );
		$xml->addChild( $key, $value );
	    }
	}
	return $xml->asXML();

	// if you want the XML to be formatted, use the below instead to return the XML
	//$doc = new DOMDocument('1.0');
	//$doc->preserveWhiteSpace = false;
	//$doc->loadXML( $xml->asXML() );
	//$doc->formatOutput = true;
	//return $doc->saveXML();
    }
    
    // determine if a variable is an associative array
    public static function isAssoc( $array ) {
	return (is_array($array) && 0 !== count(array_diff_key($array, array_keys(array_keys($array)))));
    }

    public static function toArray( $xml ) {
	if ( is_string( $xml ) ) $xml = new SimpleXMLElement( $xml );
	$children = $xml->children();
	if ( !$children ) return (string) $xml;
	$arr = array();
	foreach ( $children as $key => $node ) {
	    $node = Atlasp_Xml_Xmltrans::toArray( $node );

	    // support for 'anon' non-associative arrays
	    if ( $key == 'anon' ) $key = count( $arr );

	    // if the node is already set, put it into an array
	    if ( isset( $arr[$key] ) ) {
		if ( !is_array( $arr[$key] ) || $arr[$key][0] == null ) $arr[$key] = array( $arr[$key] );
		$arr[$key][] = $node;
	    } else {
		$arr[$key] = $node;
	    }
	}
	return $arr;
    }
}


?>
