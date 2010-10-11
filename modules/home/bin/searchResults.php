<?php
header('Content-Type: text/xml');
/*
 * Note: Header needs to be at top
 * Created on 30-Dec-2005
 *
 * Dynamic product lookup
 */
 
 //sleep(5);
 
 $xml = "";
 
//ADDED THIS LATER
if(isset($_GET['sinput'])) $sinput = mysql_escape_string(substr(trim($_GET['sinput']),0,255));
else $sinput = "";
 
 if($sinput=="cars")
 {
 	$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n" .
 			"<search-results><total>2</total>" .
 			"<result><code>1</code><name>Ford Focus</name><price>10000.00</price></result>" .
 			"<result><code>2</code><name>Audi A4</name><price>20000.00</price></result></search-results>";
 }
 else if($sinput=="computers")
 {
 	$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<search-results>
	<total>2</total>
	<result>
		<code>3</code>
		<name>Dell Inspiron</name>
		<price>500.00</price>
	</result>
	<result>
		<code>4</code>
		<name>IBM</name>
		<price>800.00</price>
	</result>
	</search-results>";
 }
 echo $xml;  
?>
