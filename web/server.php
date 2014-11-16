<?php
use Sabre\DAV;

require_once __DIR__ . '/../vendor/autoload.php';

$rootDirectory = new DAV\FS\Directory(__DIR__ . '/../tmp');

$server = new DAV\Server($rootDirectory);

$server->setBaseUri('/server.php');

$lockBackend = new DAV\Locks\Backend\File('data/locks');
$lockPlugin = new DAV\Locks\Plugin($lockBackend);
$server->addPlugin($lockPlugin);

$server->addPlugin(new DAV\Browser\Plugin());

$server->exec();