<?php
    require dirname(__FILE__).'/../configuration/check_authorization.php';
    require dirname(__FILE__).'/set_path.php';

    $navItems = [];


	$navItems[] = ['href' => $MYROOT.'/index.php', 'label' => 'Homepage'];
	$navItems[] = ['href' => $MYROOT.'/internal_search_system/page/search_system.php', 'label' => 'Cerca i corsi'];


    if (isset($_SESSION['authentication'])) {
        // Add authenticated user links
        $navItems[] = ['href' => $MYROOT.'/user_area/show_profile.php', 'label' => 'Mostra profilo'];
        $navItems[] = ['href' => $MYROOT.'/user_area/update_profile.php', 'label' => 'Modifica profilo'];
        $navItems[] = ['href' => $MYROOT.'/user_area/upload_course.php', 'label' => 'Carica il tuo corso'];
        $navItems[] = ['href' => $MYROOT.'/course_evaluation/course_evaluation.php', 'label' => 'Valuta i corsi'];
		$navItems[] = ['href' => $MYROOT.'/authentication/logout/logout.php', 'label' => 'Disconnetti'];

        // Admin specific link
        if (isset($_SESSION['admin']) && $_SESSION['admin'] === 'true') {
            $navItems[] = ['href' => $MYROOT.'/admin_area/show_users.php', 'label' => 'Mostra utenti'];
        }
    } else {
        // Add non-authenticated user links
        $navItems[] = ['href' => $MYROOT.'/authentication/pages/registration_form.php', 'label' => 'Registrati'];
        $navItems[] = ['href' => $MYROOT.'/authentication/pages/login_form.php', 'label' => 'Accedi'];
    }

    // Add common links
    $navItems[] = ['href' => $MYROOT.'/info/contact_us.html', 'label' => 'Contatti'];
  

    // Sort the nav items if needed
    // usort($navItems, function($a, $b) { return strcmp($a['label'], $b['label']); });

    // Output the nav
    echo '<nav><ul>';
    foreach ($navItems as $item) {
        echo '<li class="nav-elmnt"><a href="' . $item['href'] . '">' . $item['label'] . '</a></li>';
    }
    echo '</ul></nav>';
?>
