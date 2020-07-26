<html>
	<head>
		<title> Code Test</title>
	</head>
	<body>
		<?php
			$sample1 = "[orderId] => 212939129
			[orderNumber] => INV10001
			[salesTax] => 1.00
			[amount] => 21.00
			[terminal] => 5
			[currency] => 1
			[type] => purchase
			[avsStreet] => 123 Road
			[avsZip] => A1A 2B2
			[customerCode] => CST1001
			[cardId] => 18951828182
			[cardHolderName] => John Smith
			[cardNumber] => 5454545454545454
			[cardExpiry] => 1025
			[cardCVV] => 100";
			
			$maskedSample1 = "[orderId] => 212939129
			[orderNumber] => INV10001
			[salesTax] => 1.00
			[amount] => 21.00
			[terminal] => 5
			[currency] => 1
			[type] => purchase
			[avsStreet] => 123 Road
			[avsZip] => A1A 2B2
			[customerCode] => CST1001
			[cardId] => 18951828182
			[cardHolderName] => John Smith
			[cardNumber] => ****************
			[cardExpiry] => ****
			[cardCVV] => ***";

			$sample2 = "Request=Credit Card.Auth Only&Version=4022&HD.Network_Status_Byte=*&HD.Application_ID=TZAHSK!&HD.Terminal_ID=12991kakajsjas&HD.Device_Tag=000123&07.POS_Entry_Capability=1&07.PIN_Entry_Capability=0&07.CAT_Indicator=0&07.Terminal_Type=4&07.Account_Entry_Mode=1&07.Partial_Auth_Indicator=0&07.Account_Card_Number=4242424242424242&07.Account_Expiry=1024&07.Transaction_Amount=142931&07.Association_Token_Indicator=0&17.CVV=200&17.Street_Address=123 Road SW&17.Postal_Zip_Code=90210&17.Invoice_Number=INV19291";
			
			$maskedSample2 = "Request=Credit Card.Auth Only&Version=4022&HD.Network_Status_Byte=*&HD.Application_ID=TZAHSK!&HD.Terminal_ID=12991kakajsjas&HD.Device_Tag=000123&07.POS_Entry_Capability=1&07.PIN_Entry_Capability=0&07.CAT_Indicator=0&07.Terminal_Type=4&07.Account_Entry_Mode=1&07.Partial_Auth_Indicator=0&07.Account_Card_Number=****************&07.Account_Expiry=****&07.Transaction_Amount=142931&07.Association_Token_Indicator=0&17.CVV=***&17.Street_Address=123 Road SW&17.Postal_Zip_Code=90210&17.Invoice_Number=INV19291";
			
			$sample3 = '{
				"MsgTypId": 111231232300,
				"CardNumber": "4242424242424242",
				"CardExp": "1024",
				"CardCVV": "240",
				"TransProcCd": "004800",
				"TransAmt": "57608",
				"MerSysTraceAudNbr": "456211",
				"TransTs": "180603162242",
				"AcqInstCtryCd": "840",
				"FuncCd": "100",
				"MsgRsnCd": "1900",
				"MerCtgyCd": "5013",
				"AprvCdLgth": "6",
				"RtrvRefNbr": "1029301923091239"
			}';

			$maskedSample3 = '{
				"MsgTypId": 111231232300,
				"CardNumber": "****************",
				"CardExp": "****",
				"CardCVV": "***",
				"TransProcCd": "004800",
				"TransAmt": "57608",
				"MerSysTraceAudNbr": "456211",
				"TransTs": "180603162242",
				"AcqInstCtryCd": "840",
				"FuncCd": "100",
				"MsgRsnCd": "1900",
				"MerCtgyCd": "5013",
				"AprvCdLgth": "6",
				"RtrvRefNbr": "1029301923091239"
			}';
			
			$sample4 = "<?xml version='1.0' encoding='UTF-8'?>
			<Request>
				<NewOrder>
					<IndustryType>MO</IndustryType>
					<MessageType>AC</MessageType>
					<BIN>000001</BIN>
					<MerchantID>209238</MerchantID>
					<TerminalID>001</TerminalID>
					<CardBrand>VI</CardBrand>
					<CardDataNumber>5454545454545454</CardDataNumber>
					<Exp>1026</Exp>
					<CVVCVCSecurity>300</CVVCVCSecurity>
					<CurrencyCode>124</CurrencyCode>
					<CurrencyExponent>2</CurrencyExponent>
					<AVSzip>A2B3C3</AVSzip>
					<AVSaddress1>2010 Road SW</AVSaddress1>
					<AVScity>Calgary</AVScity>
					<AVSstate>AB</AVSstate>
					<AVSname>JOHN R SMITH</AVSname>
					<OrderID>23123INV09123</OrderID>
					<Amount>127790</Amount>
				</NewOrder>
			</Request>";
			
			$maskedSample4 = "<?xml version='1.0' encoding='UTF-8'?>
			<Request>
				<NewOrder>
					<IndustryType>MO</IndustryType>
					<MessageType>AC</MessageType>
					<BIN>000001</BIN>
					<MerchantID>209238</MerchantID>
					<TerminalID>001</TerminalID>
					<CardBrand>VI</CardBrand>
					<CardDataNumber>****************</CardDataNumber>
					<Exp>****</Exp>
					<CVVCVCSecurity>***</CVVCVCSecurity>
					<CurrencyCode>124</CurrencyCode>
					<CurrencyExponent>2</CurrencyExponent>
					<AVSzip>A2B3C3</AVSzip>
					<AVSaddress1>2010 Road SW</AVSaddress1>
					<AVScity>Calgary</AVScity>
					<AVSstate>AB</AVSstate>
					<AVSname>JOHN R SMITH</AVSname>
					<OrderID>23123INV09123</OrderID>
					<Amount>127790</Amount>
				</NewOrder>
			</Request>";

			$samples = [
				"array" => $sample1, 
				"url" => $sample2, 
				"json" => $sample3, 
				"xml" => $sample4,
				"maskedArray" => $maskedSample1,
				"maskedUrl" => $maskedSample2,
				"maskedJson" => $maskedSample3,
				"maskedXml" => $maskedSample4
			];

			/*
				Contains the sensitive information to be masked. Please ensure to follow
				the particular formatting for each type. This is the only change needed
				to change functionality, but you will need to update the maskedSamples
				or else the tests will fail.
			*/
			$sensitiveArray = ["[cardNumber] => ", "[cardExpiry] => ", "[cardCVV] => "];
			$sensitiveURL = ["07_Account_Card_Number", "07_Account_Expiry", "17_CVV"];
			$sensitiveJSON = ["CardNumber", "CardExp", "CardCVV"];
			$sensitiveXML = ["//CardDataNumber", "//Exp", "//CVVCVCSecurity"];
			

			/*	Used when masking array types ($sample1). I had difficulty finding a method to 
			    convert	the input file into a traversable object, so masking is done manually.
				These offsets determine how far the data is after a given sensitive key word.
				They are set at runtime to allow for additional sensitive key words to be added
				without needing to modify this offset array. 
			*/
			for($i = 0; $i < count($sensitiveArray); $i++)
				$arrayOffsets[$i] = strlen($sensitiveArray[$i]);

			// Enables test suite
			$DEBUG = true;
			if($DEBUG){
				getMaskTest();
				validatorTests();
				maskerTests();
				maskSensitiveDataTests();
			}

			/*
				The main method as outlined in the code test. Takes a string representation of
				one of the four data types and returns a string with the sensitive data masked. 
			*/
			function maskSensitiveData($data){
				if(arrayValidator($data))
					return arrayMasker($data);
				else if(urlValidator($data))
					return urlMasker($data);
				else if(jsonValidator($data))
					return jsonMasker($data);
				else if(xmlValidator($data))
					return xmlMasker($data);
				else
					return "Unknown File Type";
			}




/* 

					FILE TYPE VALIDATORS

*/
			/*	Returns true if $data is an array string, otherwise false. Relies on the
			    existance of "[cardNumber] => ". If this is no longer present, change must be
			    made below where indicated.
			*/
			function arrayValidator($data = NULL){
				global $sensitiveArray;
				if(!empty($data)){
					if(!empty(stripos($data, $sensitiveArray[0])))	// Looks for "[cardNumber] => "
						return true;
				}
				return false;
			}
			
			/* Returns true if $data is valid URL, otherwise false. Relies on the existance
			   of "07_Account_Card_Number". If this is no longer present, changes must be
			   made below.
			 */
			function urlValidator($data = NULL){
				global $sensitiveURL;
				if(!empty($data)){
					parse_str($data, $testValid);
					if(!empty($testValid[$sensitiveURL[0]])) // Looks for "07_Account_Card_Number"
						return true;
				}
				return false;
			}

			// Returns true if $data is valid JSON, otherwise false
			function xmlValidator($data = NULL){
				if(!empty($data))
					return @simplexml_load_string($data);
				return false;
			}
				
			// Returns true if $data is valid JSON, otherwise false
			function jsonValidator($data = NULL) {
				if(!empty($data))
					return @json_decode($data);	
				return false;
			}






/* 
			
					MASKERS AND POST-MASK FORMATTERS
	
*/
				
			// Returns a mask that is the same length as the $original string
			function getMask($original){
				$len = strlen($original);	// avoids unnecessary multiple calls to strlen()
				for ($i = 0; $i < $len; $i++)
					$mask .= "*";
				return $mask;
			}

			/* 
				Loads the (previously confirmed valid) array string and for each element
				of sensitive information found in $sensitiveArray, replaces it with a mask.
			*/
			function urlMasker($data){
				global $sensitiveURL;

				parse_str($data, $url);
				for($i = 0; $i < count($sensitiveURL); $i++)
					$url[$sensitiveURL[$i]] = getMask($url[$sensitiveURL[$i]]);

				return urlFormatter($url);
			}

			/* 
				Provides post-mask formatting to ensure output is identical to input aside from masks.
			   
			    I believe that parse_str() in urlMasker() applies url_decode to the string
			    and some characters ('&' and '.' in particular) are decoded to spaces.
			*/
			function urlFormatter($url){
				$keys = array_keys($url);

				for($i = 0; $i < count($url); $i++)
					$out .= "&" . $keys[$i] . "=" . $url[$keys[$i]];

				$out = substr($out, 1); // removes the first unnecessary &

				$pattern1 = "/HD_/u";
				$replace1 = "HD.";
				$pattern2 = "/07_/u";
				$replace2 = "07.";
				$pattern3 = "/17_/u";
				$replace3 = "17.";
			
				$out = preg_replace($pattern1, $replace1, $out);
				$out = preg_replace($pattern2, $replace2, $out);
				$out = preg_replace($pattern3, $replace3, $out);
				
				return $out;
			}

			/* 
				Loads the (previously confirmed valid) array string and for each element
				of sensitive information found in $sensitiveArray, replaces it with a mask.

				I had difficulty finding a method to convert the input file into a traversable
				object, so masking is done manually with strpos(). Uses $arrayOffsets to
				determine how far the data is after a given sensitive key word. 

				ONLY CURRENTLY WORKS FOR NUMERICAL DATA - this is due to the way the end
				of the sensitive data is determined.
			*/
			function arrayMasker($data){
				global $sensitiveArray, $arrayOffsets;
				
				for($i = 0; $i < count($sensitiveArray); $i++){
					$index = strpos($data, $sensitiveArray[$i]);
					$offset = $index + $arrayOffsets[$i];
					
					while(is_numeric($data[$offset])){	// this needs to be changed to handle non-numeric data
						$data[$offset] = "*";
						$offset++;
					}
				}

				return $data;
			}


			/* 
				Loads the (previously confirmed valid) JSON document and for each element
				of sensitive information found in $sensitiveJSON, replaces it with a mask.
			*/
			function jsonMasker($data){
				global $sensitiveJSON;

				$json = json_decode($data);
				for($i=0; $i<count($sensitiveJSON); $i++)
					$json->$sensitiveJSON[$i] = getMask($json->$sensitiveJSON[$i]);	

				$json = json_encode($json);

				return jsonFormatter($json);
			}

			/* 
				Replaces spaces after ':' that are removed during the json_decode function
			    in jsonMasker(). 

			    This does NOT replace the tabs which were included in the sample file, so the
			    output is given on a single line. It's possible there is a 'pretty print' method 
			    available that I'm unaware of. I believe it's syntactically insignificant though.
			*/
			function jsonFormatter($json){
				$pattern = "/:/u";
				$replace = ": ";
				return preg_replace($pattern, $replace, $json);
			}

			/* Loads the (previously confirmed valid) XML document and for each element
				of sensitive information found in $sensitiveXML, replaces it with a mask.
			*/
			function xmlMasker($data){
				global $sensitiveXML;

				$xml = simplexml_load_string($data);
				for($i=0; $i<count($sensitiveXML); $i++){
					$result = $xml->xpath($sensitiveXML[$i])[0];
					$result[0] = getMask($result);
				}

				$xml = $xml->asXML();
				
				return xmlFormatter($xml);
			}
			
			/* 
			   Replaces double quotes with single quotes to match the input file.

			   Does NOT perfectly match tabs, but I believe it's not syntactically significant.
			*/
			function xmlFormatter($xml){
				$pattern = "/\"/u";
				$replace = "'";
				$xml = preg_replace($pattern, $replace, $xml);

				return $xml;
			}

/* 

					TESTS AND TESTING UTILITY METHODS

*/

			/* Attempts to remove all space information so the masked and unmasked copies
			   can be simply compared. The actual output does not have this performed.
			*/
			function removeSpaces($data){
				$data = preg_replace("/[\t]+/", "", $data);
				$data = preg_replace("/[\r\n]+/", "", $data);
				return preg_replace("/\s+/", " ", $data);
			}


			/* Returns the difference in lengths between strings, or TRUE if identical.
			   
			   Is dynamically returning different types bad form, or standard PHP practice?
			   It sure feels strange to me!
			*/
			function sameLength($s1, $s2){
				if(strlen($s1) !== strlen($s2))
					return strlen($s1) - strlen($s2);
				return true;
			}


			// Asserts masks and strings are both of the same length
			function getMaskTest(){
				$testInput = ["", "   ", "abc", "abc123", "***", "   ***   ", "!@#$%^&*()_+/*-+1234567890`~xyz"];
				for($i=0; $i<sizeof($testInput); $i++)
					assert(strlen($testInput[$i]) === strlen(getMask($testInput[$i])));
			}

			// Asserts [type]Validator() correctly identifies only it's respective type
			function validatorTests(){
				global $samples;

				assert(arrayValidator($samples["array"]));
				assert(!arrayValidator($samples["url"]));					
				assert(!arrayValidator($samples["json"]));
				assert(!arrayValidator($samples["xml"]));

				assert(urlValidator($samples["url"]));					
				assert(!urlValidator($samples["array"]));
				assert(!urlValidator($samples["json"]));
				assert(!urlValidator($samples["xml"]));

				assert(xmlValidator($samples["xml"]));
				assert(!xmlValidator($samples["array"]));
				assert(!xmlValidator($samples["url"]));					
				assert(!xmlValidator($samples["json"]));

				assert(jsonValidator($samples["json"]));
				assert(!jsonValidator($samples["array"]));
				assert(!jsonValidator($samples["url"]));				
				assert(!jsonValidator($samples["xml"]));
			}

			/* Simple check that $unmasked and $masked are identical, or only differ by
			   the masked information if $allowMask is true. 
			   
			   It does NOT check that the masked information is only
			   what was wanted to be masked in the $sensitive[type] arrays.
			*/
			function sameOutput($unmasked, $masked, $type, $allowMask){
				$unmasked = removeSpaces($unmasked);
				$masked = removeSpaces($masked);

				assert(sameLength($unmasked, $masked));
				
				$numDiff = 0;
				$len = strlen($masked);		// avoids multiple calls to strlen() in for loop
				for($i = 0; $i < $len; $i++){
					if($unmasked[$i] !== $masked[$i]){
						if($allowMask && is_numeric($unmasked[$i]) && $masked[$i] === "*"){
							// Expected difference (masked), do nothing
						}
						else{
							//echo $unmasked[$i];
							$numDiff++;
						}
					}
				}
				echo nl2br($type . " numDiff: " . $numDiff . "\n");		// Remove to keep testing without output
				return $numDiff === 0;
			}

			function maskerTests(){
				global $samples;

				$allowMask = true;
				
				// Sanity Check compares given input with manually masked outputs, accounting for masks
				assert(sameOutput($samples["url"], $samples["maskedUrl"], "url: given with manual", $allowMask));
				assert(sameOutput($samples["array"], $samples["maskedArray"], "array: given with manual", $allowMask));
				assert(sameOutput($samples["json"], $samples["maskedJson"], "json: given with manual", $allowMask));
				assert(sameOutput($samples["xml"], $samples["maskedXml"], "xml: given with manual", $allowMask));
				
				// Compares given output with generated masked outputs, accounting for masks
				assert(sameOutput($samples["url"], urlMasker($samples["url"]), "url: given with generated", $allowMask));
				assert(sameOutput($samples["array"], arrayMasker($samples["array"]), "array: given with generated", $allowMask));
				assert(sameOutput($samples["json"], jsonMasker($samples["json"]), "json: given with generated", $allowMask));
				assert(sameOutput($samples["xml"], xmlMasker($samples["xml"]), "xml: given with generated", $allowMask));
				
				$allowMask = false;

				// Compares generated masked outputs with manually masked
				assert(sameOutput(urlMasker($samples["url"]), $samples["maskedUrl"], "url: generated with manual", $allowMask));
				assert(sameOutput(arrayMasker($samples["array"]), $samples["maskedArray"], "array: generated with manual", $allowMask));
				assert(sameOutput(jsonMasker($samples["json"]), $samples["maskedJson"], "json: generated with manual", $allowMask));
				assert(sameOutput(xmlMasker($samples["xml"]), $samples["maskedXml"], "xml: generated with manual", $allowMask));

			}

			/* 
				Asserts that maskSensitiveData() is selecting the appropriate data masker, and that
				the data is masked properly.
			*/
			function maskSensitiveDataTests(){
				global $samples;

				$allowMask = true;

				assert(sameOutput($samples["url"], maskSensitiveData($samples["url"]), "url: given with generated", $allowMask));
				assert(sameOutput($samples["array"], maskSensitiveData($samples["array"]), "array: given with generated", $allowMask));
				assert(sameOutput($samples["json"], maskSensitiveData($samples["json"]), "json: given with generated", $allowMask));
				assert(sameOutput($samples["xml"], maskSensitiveData($samples["xml"]), "xml: given with generated", $allowMask));
			}
		
			// UNUSED - Quick method for visually inspecting output.
			function writeFile($out, $fileName){
				$myfile = fopen($fileName, "w") or exit("Unable to open file: " . $fileName);
				fwrite($myfile, $out);
				fclose($myfile);
			}
		?>
	</body>
</html>
