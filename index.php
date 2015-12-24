<?php ob_start(); // Buffer output

/**
 * Configuration parameters (change as needed)
**/
// Template
$_TEMPLATE = 'portal';

// Template directory
$_TEMPLATE_DIR = 'template';

// Content directory
$_CONTENT_DIR = 'content';
$_CONTENT_PATH = null;
$_CONTENT_INDX = 'Home';
$_CLASS_DIR = 'classes';

// Database Default
$_DBH_DEFAULT = 'connect';

// Configuration Directory
$_CONF_DIR = 'conf';

//Environment 
// $_DEV = ($_SERVER['HTTP_HOST'] == "localhost");

/** Get and display content
 *  Don't need to change anything below
**/
// Set the include path
set_include_path('.' . PATH_SEPARATOR . './application' . PATH_SEPARATOR . './conf');

// 1. Find the page content
$_CONTENT = getRequestedUri();

// 2. Include the Template
include "{$_TEMPLATE_DIR}/{$_TEMPLATE}/Template.php";

// 3. Clean  he buffer (strip whitespace from outgoing html)
$_HTML = ob_get_clean();
echo trim($_HTML);

// 4. Send output to browser
ob_end_flush();

/** Functions **/
function getRequestedUri() {
	global $_CONTENT_DIR;
	global $_CONTENT_INDX;
	
	// Requested file
	$BASE = "/Portal";
	// I don't remember what we called this variable
	$URI = str_replace($BASE, '', $_SERVER['REQUEST_URI']);
	
	$URI = preg_replace("/[^\w\-\/]/", "", $URI);

	// Check if file exists
	if (!checkFileExists("{$_CONTENT_DIR}{$URI}.php")) {
		// Append index if requested file does not exist
		$b = trim(basename($URI));
		
		if ($b == "") {
			$URI .= (substr($URI, -1) == "/") ? "{$_CONTENT_INDX}" : "/{$_CONTENT_INDX}";
		}

		if (!checkFileExists("{$_CONTENT_DIR}{$URI}.php")) {
			$URI = true;
			
			if (!checkFileExists("{$_CONTENT_DIR}{$URI}.php")) {
				$URI = false;
			}
		}
	}
	
	return $URI;
}

function checkFileExists($file, $type = 'content') {
	switch (strtolower($type)) {
		case 'class':
			global $_CLASS_DIR;
			$file = (!empty($_CLASS_DIR))? "{$_CLASS_DIR}/{$file}" : $file;
			break;
			
		case 'conf':
			global $_CONF_DIR;
			$file = (!empty($_CONF_DIR))? "{$_CONF_DIR}/{$file}" : $file;
			break;
				
		case 'content':
		default:
			global $_CONTENT_PATH;
			$p = &$_CONTENT_PATH;
	}
	
	$path = checkFileExistsPath($file);
	 
	if (!$path) {
		return false;
	}

	switch(strtolower($type)) {
		case 'content':
			$p = $path;
			break;
	}
	
	return $path;
}

function checkFileExistsPath($file) {
	foreach (explode(PATH_SEPARATOR, get_include_path()) AS $path) {
		// Check if file_exists
		if (file_exists("{$path}/{$file}")) {
			return "{$path}/{$file}";
		}
	}
	
	return false;
}

function __autoload($class)	{
	$class = str_replace( "_", "/", $class );
	$file = strtolower("{$class}.php");
	if ($p = checkFileExists($file, 'class')) {
		include ($p);
	}
}

function debug($msg) {
	echo "<pre>";
	var_dump($msg);
	echo "</pre>";
}