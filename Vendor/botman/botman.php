<?php require_once 'vendor/autoload.php';

use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use BotMan\BotMan\Cache\SymfonyCache;

$config = [];

DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

$adapter = new FilesystemAdapter();

$botman = BotManFactory::create($config, new SymfonyCache($adapter));

$botman->hears('Hola', function($bot){
    $bot->reply('Mundo');
});

$botman->fallback(function($bot){
    $bot->reply('No te entiendo bro');
});

$botman->listen();