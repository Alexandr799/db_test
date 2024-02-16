<?php

require_once "vendor/autoload.php";

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;
use Dotenv\Dotenv;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Symfony\Component\Cache\Adapter\RedisAdapter;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$paths = [__DIR__ . '/src/Entities/', __DIR__ . '/src/Repository/'];
$isDevMode = false;
$reportFieldsWhereDeclared = false;

$dbParams = [
    'driver' => 'pdo_mysql',
    'user' => $_ENV['MYSQL_LOGIN'],
    'password' => $_ENV['MYSQL_PASSWORD'],
    'dbname' => $_ENV['DB_NAME'],
    'host' => $_ENV['HOST'],
];

$proxyDir = sys_get_temp_dir();

$redis = new Redis();
$redis->connect($_ENV['REDIS_HOST'], $_ENV["REDIS_PORT"]);
$cache = new RedisAdapter($redis);

$config = new Configuration();
$config->setMetadataCache($cache);
$config->setQueryCache($cache);
$config->setResultCache($cache);
$config->setProxyDir($proxyDir);
$config->setProxyNamespace('DoctrineProxies');
$config->setAutoGenerateProxyClasses($isDevMode);
$config->setMetadataDriverImpl(new AttributeDriver($paths, $reportFieldsWhereDeclared));

$connection = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);
