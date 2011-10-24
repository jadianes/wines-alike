<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'wa_admin');
define('DB_PASSWORD','WinesAlike#321');
define('DB_NAME', 'winesalike');

define('WA_WEBSITE_NAME', 'WinesAlikeMAC');
define('WA_ADMIN_NAME', 'Jose A.');
define('WA_ADMIN_EMAIL', 'jadianes@gmail.com');
define('WA_SUPPORT_EMAIL', 'jadianes@gmail.com');

require('/usr/local/lib/Smarty-3.1.4/libs/Smarty.class.php');

class Smarty_WinesAlike extends Smarty {

   function __construct()
   {

        // Class Constructor.
        // These automatically get set with each new instance.

        parent::__construct();

        $this->setTemplateDir(dirname ( __FILE__ ).'/../templates/');
        $this->setCompileDir(dirname ( __FILE__ ).'/../templates_c/');
        $this->setConfigDir(dirname ( __FILE__ ).'/../configs/');
        $this->setCacheDir(dirname ( __FILE__ ).'/../cache/');

        $this->caching = Smarty::CACHING_LIFETIME_CURRENT;
        $this->assign('app_name', 'WinesAlike');
   }

}

?>