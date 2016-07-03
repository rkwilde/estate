<?php
/**
 * Standard Library Functions
 * Useful functions that do not belong in specific projects.
 */

function parse_return_path_email($email) {
	if (preg_match("/\<.*\>$/i", $email, $matches)) {
		return $matches[0];
	} else {
		return $email;
	}
}

function sendmail($to, $from, $subject, $message,$type_html=false){

	$headers =  'From: '.$from. "\r\n";
	$headers .= 'Reply-To: '.$from.''."\r\n";
	$headers .= 'Sender: ' . $from."\r\n";

	if($type_html){
		$headers .= 'MIME-Version: 1.0' . "\r\n" .
			'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	}
	$headers .= 'X-Mailer: PHP/' . phpversion();

	$additional_parameters = "-f".parse_return_path_email($from);

	$result=mail($to, $subject, $message, $headers, $additional_parameters);
	return $result;
}

/**
 * check if an input is set and return the value or a default
 * @param string $field
 * @param string|integer $default
 * @param boolean $numeric
 * @param boolean $allow_decimal
 * @param boolean $allow_negative
 * @return string|integer|array
 */
function request($field, $default='', $numeric=false, $allow_decimal=false, $allow_negative=false){
	$value = $default;
	if(isset($_REQUEST[$field])){
		$value = $_REQUEST[$field];
		if($numeric){
			$value = is_numeric_default($value, $default, $allow_decimal, $allow_negative);
		}
		if(!is_array($value)){
			$value = trim($value);
		}
	}
	return $value;
}

// check if a value is numeric and return a default value if it is not
function is_numeric_default($value, $default=0, $allow_decimal=false, $allow_negative=false){
	$result=$value;
	if(is_numeric($result)){
		if(!$allow_decimal && strpos($result,'.')!==false){ // has a decimal
			$result=$default;
		}
		if(!$allow_negative && $result<0){ // is negative
			$result=$default;
		}
		if(strpos($result,'x')!==false){ // is hexidecimal
			$result=$default;
		}
		if(strpos($result,'e')!==false){ // is scientific notation
			$result=$default;
		}
	}else{
		$result=$default;
	}
	return $result;
}

// return only the number characters from a string
// allow one decimal point if $allow_decimal is true
// allow a leading minus sign if $allow_negative is true
function get_digits_from_string($str, $allow_decimal=false, $allow_negative=false){
	$res='';
	$str=trim($str);
	$len=strlen($str);
	$valid_chars="0123456789";
	$decimal_point_ctr=0;
	for($i=0; $i<$len; $i++){
		$c=substr($str,$i,1);
		if ($c>='0' && $c<='9'){
			$res.=$c;
		}
		if($c=='-' && $allow_negative && $res==''){
			$res.=$c;
		}
		if($c=='.' && $allow_decimal && $decimal_point_ctr==0){
			$res.=$c;
			$decimal_point_ctr++;
		}
	}
	return $res;
}

// Generate a random code of lenth $str_length using the characters in $char_set
function get_random_code($str_length, $char_set='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'){
	$code='';
	$len=strlen($char_set)-1;
	for($i=0; $i<$str_length; $i++){
		$code.=substr($char_set,rand(0,$len),1);
	}
	return $code;
}

// encrypt a string
function base_encrypt($string, $key, $enc_type){
	$which = constant($enc_type);
	$iv_size = mcrypt_get_iv_size($which,MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size,MCRYPT_DEV_URANDOM);
	$string = mcrypt_encrypt($which,$key,$string,MCRYPT_MODE_ECB,$iv);
	return base64_encode($string);
}
//decrypt an encrypted string
function base_decrypt($cypher, $key, $enc_type){
	$which = constant($enc_type);
	$iv_size = mcrypt_get_iv_size($which,MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size,MCRYPT_DEV_URANDOM);
	$out = mcrypt_decrypt($which,$key,base64_decode($cypher),MCRYPT_MODE_ECB,$iv);
	return trim($out);
}
// default encryption
function default_encrypt($string, $key) {
	return base_encrypt($string, $key, 'MCRYPT_RIJNDAEL_256');
}
// default decryption
function default_decrypt($cypher, $key) {
	return base_decrypt($cypher, $key, 'MCRYPT_RIJNDAEL_256');
}

function get_array_xml($rs, $set_tag, $record_tag, $indent){
	$xml=$indent."<$set_tag>\n";
	$xml.=$indent."\t<count>".count($rs)."</count>\n";
	foreach($rs as $idx=>$row){
		$xml.=$indent."\t<$record_tag>\n";
		foreach($row as $n=>$v){
			$xml.=$indent."\t\t<$n>$v</$n>\n";
		}
		$xml.=$indent."\t</$record_tag>\n";
	}
	$xml.=$indent."</$set_tag>\n";
	return $xml;
}

/**
 * Make long strings fit to a set length with ellipsis as needed
 * @param string $input
 * @param integer $length
 * @return string
 */
 function ellipsis($input, $length){
	$output = substr($input,0, $length);
	if(strlen($input)>$length){
		$output.= '...';
	}
	return $output;
}

/**
 * Format a print_r output using the <pre> tag
 * @param string $p: an object or array to display.
 */
function ppr($p, $caption = ''){
	echo ($caption? $caption.": \n": '')."<pre>"; print_r($p); echo "</pre>";
}

function valid_email($email_address){
	$valid = false;
	if(filter_var($email_address, FILTER_VALIDATE_EMAIL) !== false){
		$valid = true;
	}

	return $valid;
}

/**
 * Example Call:
 * verify_create_directory($current_path, 0775);
 *
 * Preceding 775 with a 0 lets PHP know this is an Octal number.
 *
 * @param string $directory_path
 * @param octal integer $permissions
 * @param boolean $recursive
 *
 * If $recursive is true, it will create any previous subfolders that are missing.
 **/
function verify_create_directory($directory_path, $permissions, $recursive=true){
	if(!file_exists($directory_path)){
		$successful=mkdir($directory_path, $permissions, $recursive);
		if (!$successful) {
			error_log("PHP Warning: failed to create $directory_path ($permissions)");
		}
		chmod($directory_path, $permissions);
	}
}

/**
 * Write the contents of the $html variable as a javascript document.write
 *
 * @param string $html
 **/
function javascript_document_write($html){
	$html = str_replace("\r", '', $html); // strip out line feeds
	$html = str_replace('\\', '\\\\', $html); // escape \

	$lines = explode("\n", $html); // split on new lines
	foreach($lines as $index=>$line){
		$line = str_replace("'", "\'", $line); // escape ' marks
		echo "document.writeln('".$line."');\n";
	}
}

function flush_buffers(){
	ob_end_flush();
	ob_flush();
	flush();
	ob_start();
}

/**
 * Dynamically load the array into the object on matching fields.
 * For example, if the object has fields $object->first_name and $object->last_name and if the array
 * has fields 'first_name'=>'value1', 'last_name'=>'value2', then value1 and value2 will be
 * loaded into $object->first_name and $object->last_name respectively.
 * @param object $object
 * @param array $array
 */
function apply_array_values_to_object($object, $array) {
	if ($array && $object) {
		$class_name = get_class($object);
		foreach ($array as $key=>$value) {
			if (property_exists($class_name, $key)) {
				$reflection_property = new ReflectionProperty($class_name, $key);
				$reflection_property->setValue($object, $value);
			}
		}
	}
}

// if you want to pass a string to javascript, line breaks and close script tags need to be replaced
function safe_js_string($value){
	$value = preg_replace('/<\/script>/i', '{CLOSE_SCRIPT_TAG}', $value);
	$value = str_replace("\r\n", '{LINE_RETURN}', $value);
	$value = str_replace("\r", '{LINE_RETURN}', $value);
	$value = str_replace("\n", '{LINE_RETURN}', $value);
	return $value;
}

// this does the standard urlencode except for the / does not go to %2F. Apache does not like %2F
function good_urlencode($str){
	return str_replace('%2F', '/', urlencode($str));
}

// split names on a space
function split_name($name){
	$names = array('first_name' => '', 'last_name' => '');
	$last_name = strrchr($name, ' ');
	if($last_name){
		$names['first_name'] = trim(substr($name, 0, strlen($name)-strlen($last_name)));
		$names['last_name'] = trim($last_name);
	}else{
		$names['first_name'] = $name;
	}
	return $names;
}

/**
 * This function is intended to help you look up the file extension by looking at the image data.
 * There are simpler ways if you have the file's actual name.
 * Example: $ext = pathinfo('/var/www/myfile.jpg', PATHINFO_EXTENSION);
 *
 * If you have a file name and path without a extension, you can get the $type as follows:
 * $file = '/tmp/phpbnTwss';
 * $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
 * $type = finfo_file($finfo, $file); // Customer facing description of file
 *
 * @param string $type, File type
 * @return string
 */
function get_image_extension_by_type($type){
	$ext = '';
	if($type){
		switch($type){
			case 'image/bmp': $ext = 'bmp'; break;
			case 'image/cis-cod': $ext = 'cod'; break;
			case 'image/gif': $ext = 'gif'; break;
			case 'image/ief': $ext = 'ief'; break;
			case 'image/jpeg': $ext = 'jpg'; break;
			case 'image/pipeg': $ext = 'jfif'; break;
			case 'image/tiff': $ext = 'tif'; break;
			case 'image/png': $ext = 'png'; break;
			case 'image/x-cmu-raster': $ext = 'ras'; break;
			case 'image/x-cmx': $ext = 'cmx'; break;
			case 'image/x-icon': $ext = 'ico'; break;
			case 'image/x-portable-anymap': $ext = 'pnm'; break;
			case 'image/x-portable-bitmap': $ext = 'pbm'; break;
			case 'image/x-portable-graymap': $ext = 'pgm'; break;
			case 'image/x-portable-pixmap': $ext = 'ppm'; break;
			case 'image/x-rgb': $ext = 'rgb'; break;
			case 'image/x-xbitmap': $ext = 'xbm'; break;
			case 'image/x-xpixmap': $ext = 'xpm'; break;
			case 'image/x-xwindowdump': $ext = 'xwd'; break;
			case 'image/png': $ext = 'png'; break;
			case 'image/x-jps': $ext = 'jps'; break;
			case 'image/x-freehand': $ext = 'fh'; break;
		}
	}

	return $ext;
}

/**
 * This function creates a image file using the variables passed.
 * After creating the file, it obtains information about the image.
 * It returns the image info.
 * Since this function is just intended to get information about the file, you do not need to keep the file.
 * However, there is a $clean option. If you want to keep the file, set $clean=false.
 *
 * @param string $imgbase64, data:image/png;base64,... image file via text, usually created by canvas
 * @param string $file_name
 * @param boolean $clean
 * @return array $file_info
 */
function get_image_information($imgbase64, $file_name='', $clean=true){
		$img = str_replace('data:image/png;base64,', '', $imgbase64);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		//$temp = tmpfile();
		$temp_name = tempnam ('/tmp', 'temp_img_');
		$temp = fopen($temp_name, 'w');
		fwrite($temp, $data);
		$meta_data = stream_get_meta_data($temp);
		$file = $meta_data['uri'];;
		// FileInfo Constants: http://php.net/manual/en/fileinfo.constants.php
		$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
		$file_type = finfo_file($finfo, $file); // Customer facing description of file
		if(!$file_name){
			$file_name = $file.'.'.get_image_extension_by_type($file_type);
		}

		$file_info = array();
		$file_info['name'] = $file_name;
		$file_info['type'] = $file_type;
		$file_info['tmp_name'] = $file;
		$file_info['error'] = 0;
		$file_info['size'] = filesize($file);
		if($clean){ unlink($file_info['tmp_name']); }

		return $file_info;
}

?>
