<?php

define('DB_HOST', 'localhost');
define('DB_USER', '');
define('DB_PASSWORD','');
define('DB_NAME', '');

define('WA_WEBSITE_NAME', '');
define('WA_ADMIN_NAME', '');
define('WA_ADMIN_EMAIL', '');
define('WA_SUPPORT_EMAIL', '');

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