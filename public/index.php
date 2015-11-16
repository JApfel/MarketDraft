<?php
 
    try {
 
        $config = include __DIR__ . "/../app/config/config.php";
        include __DIR__ . "/../app/config/loader.php";
        include __DIR__ . "/../app/config/services.php";
         
        $application = new Phalcon\Mvc\Application($di);
        $application->useImplicitView(false);
        ini_set('phalcon.orm.exception_on_failed_save', true);
        echo $application->handle()->getContent();
 
    }   catch (\Exception $e) {
            echo $e->getMessage();
    }
?>
