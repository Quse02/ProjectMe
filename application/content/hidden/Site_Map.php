<h1>Site Map</h1>

<ul>
<?php
	iterateDirectory("{$_CONTENT_PATH}/{$_CONTENT_DIR}/*");
?>
</ul>

<?php 

function iterateDirectory($dir) {
	foreach (glob($dir, GLOB_MARK) AS $f) {
		if (is_dir($f)) {
			// If directory then skip for now
			
		} elseif (is_file($f)) {
			list ($link, $title) = cleanFilename($f);
			echo "<li><a href=\"{$link}\">{$title}</a></li>" . PHP_EOL;
		}
	}
}

function cleanFilename($f) {
	$f = preg_replace('/^.+?\/content/', '', $f);

	$b = preg_replace(array(
		'/\..*$/',
		'/_/'
	), array('', ' '), basename($f));

	$f = preg_replace('/\..*$/', '', $f);
	
	return array($f , $b);
}