<?php require dirname(__FILE__).'/set_path.php'; ?>

<?php
	print(
	'   <!-- Internet Explorer. -->
		<meta http-equiv = \'X-UA-Compatible\' content = \'IE = edge\'>
		<meta charset = \'utf-8\'>
		<!-- Adapting to the browser window size. -->
		<meta name = \'viewport\' content = \'width-device-width\', initial-scale = 1.0>
		<!-- Note: putting "/" before the relative path transform it to absolute path from the document root. -->
		<link rel = \'icon\' href = '.$MYROOT.'/css/images/school.svg type = \'image/svg+xml\'>
		<link rel = \'apple-touch-icon\' href = '.$MYROOT.'/css/images/school.png>
		<link rel = \'stylesheet\' href = '.$MYROOT.'/css/style.css>
	'
	);
?>