<?php
include_once '../geshi/geshi.php';

if (isset($_GET['file'])){
	$filename=$_GET['file'];
	//echo $filename;

	$geshi = new GeSHi();
	$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, 10);

//	$geshi->set_header_content($content);
//	$geshi->set_footer_content($content);
//	$geshi->set_header_content_style($styles);
//	$geshi->set_footer_content_style($styles);

	$geshi->load_from_file('../../examples/'.$filename);
	echo $geshi->parse_code();
}
?>