<?php
/**
 * FILE: Init.php
 *
 * @AUTHOR: LTD shalvasoft
 * @AUTHOR: Shalva Kvaratskhelia
 * PROJECT: MVC
 * VERSION: 1.0.0
 */

require_once 'config/defines.php';
require_once 'config/processors.php';
$confFile = dirname(dirname(__FILE__)).'/application/config/config.php';
if(file_exists($confFile)) {
    /** @noinspection PhpIncludeInspection */
    require_once $confFile;
}
require_once 'Api/AutoloadManager/autoloadManager_interface.php';
require_once 'Api/AutoloadManager/autoloadManager.php';
$autoloadManager = new autoloadManager();
/** @noinspection PhpInternalEntityUsedInspection */
$autoloadManager->setSaveFile(system_dir().'/Cache/autoload.php');
$autoloadManager->register();
$autoloadManager->addFolder(system_dir());
$autoloadManager->excludeFolder(system_dir().'/Api/AutoloadManager');
$autoloadManager->generate();

$app = new bootstrap();
$app->Init();