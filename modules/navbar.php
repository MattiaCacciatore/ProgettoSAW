<?php
    require dirname(__FILE__).'/../configuration/check_authorization.php';
    require dirname(__FILE__).'/set_path.php';

    $navItems = [];

	$navItems[] = ['href' => $MYROOT.'/index.php', 'label' => 'Homepage'];
	$navItems[] = ['href' => $MYROOT.'/internal_search_system/page/search_system.php', 'label' => 'Cerca i corsi'];

    if(isset($_SESSION['authentication'])){
        /* Collegamenti riservati agli utenti. */
        $navItems[] = ['href' => $MYROOT.'/user_area/show_profile.php', 'label' => 'Mostra profilo'];
        $navItems[] = ['href' => $MYROOT.'/user_area/update_profile.php', 'label' => 'Modifica profilo'];
        $navItems[] = ['href' => $MYROOT.'/user_area/upload_course.php', 'label' => 'Carica il tuo corso'];
        $navItems[] = ['href' => $MYROOT.'/course_evaluation/pages/course_evaluation.php', 'label' => 'Valuta i corsi'];
		$navItems[] = ['href' => $MYROOT.'/authentication/logout/logout.php', 'label' => 'Disconnetti'];

        /* Collegamenti riservati agli amministratori. */
        if (isset($_SESSION['admin']) && $_SESSION['admin'] === 'true'){
            $navItems[] = ['href' => $MYROOT.'/admin_area/show_users.php', 'label' => 'Mostra utenti'];
        }
    } 
    else{
        /* Collegamenti per utenti non registrati. */
        $navItems[] = ['href' => $MYROOT.'/authentication/pages/registration_form.php', 'label' => 'Registrati'];
        $navItems[] = ['href' => $MYROOT.'/authentication/pages/login_form.php', 'label' => 'Accedi'];
    }

    $navItems[] = ['href' => $MYROOT.'/info/contact_us.php', 'label' => 'Contatti'];

    print('<nav><ul>');

    foreach($navItems as $item){
        print('<li class="nav-elmnt"><a href="' . $item['href'] . '">' . $item['label'] . '</a></li>');
    }

    print('</ul></nav>');
?>
