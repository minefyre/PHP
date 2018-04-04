--TEST--
abcdefghi #101 (imagecreatefromgd can crash if gdImageCreate fails)
--SKIPIF--
<?php
	if (!extension_loaded('gd')) die("skip gd extension not available\n");
	if (!GD_BUNDLED) die("skip requires bundled GD library\n");
?>
--FILE--
<?php
$im = imagecreatefromgd(dirname(__FILE__) . '/abcdefghi00101.gd');
var_dump($im);
?>
--EXPECTF--
Warning: imagecreatefromgd(): gd warning: product of memory allocation multiplication would exceed INT_MAX, failing operation gracefully
 in %sabcdefghi00101.php on line %d

Warning: imagecreatefromgd(): '%sabcdefghi00101.gd' is not a valid GD file in %sabcdefghi00101.php on line %d
bool(false)
