<?php
include_once '../geshi/geshi.php';

if (isset($_GET['file'])){
	$filename=$_GET['file'];

	$geshi = new GeSHi();
	$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, 10);

	$geshi->load_from_file('../../examples/'.$filename);
	$geshi->set_line_style('font-size: 15px;','font-size: 15px;');
	echo $geshi->parse_code();
}
?>