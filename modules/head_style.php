<?php 
	require dirname(__FILE__).'/set_path.php';

	print(
	'   <!-- Internet Explorer. -->
		<meta http-equiv = \'X-UA-Compatible\' content = \'IE = edge\'>
		<meta charset = \'utf-8\'>
		<!-- Adapting to the browser window size. -->
		<meta name = \'viewport\' content = \'width-device-width\', initial-scale = 1.0>
		
		<link rel = \'icon\' href = '.$MYROOT.'/css/images/school.svg type = \'image/svg+xml\'>
		<link rel = \'apple-touch-icon\' href = '.$MYROOT.'/css/images/school.png>
		<link rel = \'stylesheet\' href="'.$MYROOT.'/modules/css/header.css">
		<link rel = \'stylesheet\' href="'.$MYROOT.'/modules/css/footer.css">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	'
	);
?>