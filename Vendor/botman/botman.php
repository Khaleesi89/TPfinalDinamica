<?php require_once 'vendor/autoload.php';

use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use BotMan\BotMan\Cache\SymfonyCache;

require_once('Conversaciones/charlaAmistosa.php');

$config = [];

DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

$adapter = new FilesystemAdapter();

$botman = BotManFactory::create($config, new SymfonyCache($adapter));

$botman->hears('Hola', function($bot){
    $bot->typesAndWaits(1);
    $bot->startConversation(new CharlaAmistosa());
})->skipsConversation();

$botman->fallback(function($bot){
    $bot->reply('No te entiendo bro');
});

$botman->listen();