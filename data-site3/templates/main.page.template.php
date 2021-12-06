<?php
/**
 * Define default file paths for the header, nav, footer,
 * but allow individual pages to override those file paths, 
 * so you can include a different header, nav, or footer
 * on a given page
 */
new Base;

$headerPath 	= $values->header ? TEMPLATE_PATH . $values->header : TEMPLATE_PATH . 'main.header.template.php';
$navPath 		= $values->nav ? TEMPLATE_PATH . $values->nav : TEMPLATE_PATH . 'main.nav.template.php';
$footerPath 	= $values->footer ? TEMPLATE_PATH . $values->footer : TEMPLATE_PATH . 'main.footer.template.php';

$page->header 	= Base::renderExternalFile($headerPath);
$page->nav 		= Base::renderExternalFile($navPath);
$page->footer 	= Base::renderExternalFile($footerPath);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $page->title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT; ?>styles/styles.css">
	<link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT; ?>styles/deque-patterns.min.css">
	<script src="https://kit.fontawesome.com/3dff656c65.js" crossorigin="anonymous"></script>
	<script src="<?PHP echo URL_ROOT . 'javascript/jquery-3.6.0.min.js'; ?>" type="text/javascript"></script>
	<script src="<?PHP echo URL_ROOT . 'javascript/deque-patterns.min.js'; ?>" type="text/javascript"></script>
    <script src="<?PHP echo URL_ROOT . 'javascript/script.js'; ?>" type="text/javascript"></script>
	
	<?php echo $page->cssFiles;?>
	<?php echo $page->headStyles;?>
</head>

<body>

<div id="container">

<?php 
if ($page->header) {
	echo "<header>\n<div class=\"innerContainer\">\n$page->header</div></header>\n";
}?>

<?php 
if ($page->nav) {
	echo "<nav>\n<div class=\"innerContainer\">\n$page->nav</div></nav>\n";
}?>

<main>
<div class="innerContainer">
<?php 
if ($page->heading) {
	echo "<h1>$page->heading</h1>\n";
}?>
<?php echo $page->content;?>
</div>
</main>

<?php 
if ($page->footer) {
	echo "<footer>\n<div class=\"innerContainer\">\n$page->footer</div></footer>\n";
}?>

</div>

</body>
</html>