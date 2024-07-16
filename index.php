<!DOCTYPE html>
<html lang = 'it'>
    
<head>

	<?php 
		include dirname(__FILE__).'/./modules/head_style.php';
	?>
	
	<link rel = 'stylesheet' href = './modules/css/welcomeWrapper.css'>

	<title>
		Homepage
	</title>

</head>

<body>

	<?php
		require dirname(__FILE__).'/./modules/cookies_banner.php';
		require dirname(__FILE__).'/./modules/header.php';
	?>

	<!-- Corpo della pagina. -->
	<main>

		<div id = 'welcome-wrapper'>

            <h3>Benvenuti su STEMazing Education</h3>

            <p>
				STEMazing Education è la tua destinazione principale per l'apprendimento delle discipline scientifiche e tecnologiche. 
				Offriamo corsi di alta qualità in Scienza, Tecnologia, Ingegneria e Matematica, progettati per studenti e 
				professionisti di tutti i livelli.
			</p>

            <p>
				Con noi, puoi imparare a programmare, esplorare i fondamenti della scienza dei dati, approfondire le tue conoscenze 
				di ingegneria e padroneggiare concetti matematici avanzati. I nostri corsi sono tenuti da esperti del settore e sono 
				progettati per essere accessibili, coinvolgenti e pratici.
			</p>

            <p>
				Unisciti alla nostra comunità globale di appassionati di STEM e inizia il tuo viaggio verso l'eccellenza accademica e 
				professionale. Che tu stia cercando di avanzare nella tua carriera o di scoprire nuove passioni, STEMazing ti offre 
				gli strumenti e le conoscenze di cui hai bisogno per avere successo.
			</p>

            <p>
				Impara ovunque e in qualsiasi momento con STEMazing!
			</p>

        </div>

	</main>

	<?php 
		require dirname(__FILE__).'/./modules/footer.php'; 
	?>
	
</body>
</html>