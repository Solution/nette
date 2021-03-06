<?php

/**
 * Test: Nette\Config\IniAdapter section.
 *
 * @author     David Grudl
 * @package    Nette\Config
 * @subpackage UnitTests
 */

use Nette\Config\Config;



require __DIR__ . '/../bootstrap.php';

define('TEMP_FILE', TEMP_DIR . '/cfg.ini');


// Load INI
$config = Config::fromFile('config2.ini');
Assert::same( array(
	'common' => array(
		'variable' => array(
			'tempDir' => '%appDir%/cache',
			'foo' => '%bar% world',
			'bar' => 'hello',
		),
		'set' => array(
			'date.timezone' => 'Europe/Prague',
			'iconv.internal_encoding' => '%encoding%',
			'mbstring.internal_encoding' => '%encoding%',
			'include_path' => '%appDir%/../_trunk;%appDir%/libs',
		),
	),
	'production' => array(
		'service' => array(
			'Nette-Application-IRouter' => 'Nette\\Application\\MultiRouter',
			'User' => 'Nette\\Security\\User',
			'Nette-Autoloader' => 'Nette\\AutoLoader',
		),
		'webhost' => 'www.example.com',
		'database' => array(
			'params' => array(
				'host' => 'db.example.com',
				'username' => 'dbuser',
				'password' => 'secret',
				'dbname' => 'dbname',
			),
			'adapter' => 'pdo_mysql',
		),
		'variable' => array(
			'tempDir' => '%appDir%/cache',
			'foo' => '%bar% world',
			'bar' => 'hello',
		),
		'set' => array(
			'date.timezone' => 'Europe/Prague',
			'iconv.internal_encoding' => '%encoding%',
			'mbstring.internal_encoding' => '%encoding%',
			'include_path' => '%appDir%/../_trunk;%appDir%/libs',
		),
	),
	'development' => array(
		'database' => array(
			'params' => array(
				'host' => 'dev.example.com',
				'username' => 'devuser',
				'password' => 'devsecret',
				'dbname' => 'dbname',
			),
			'adapter' => 'pdo_mysql',
		),
		'service' => array(
			'Nette-Application-IRouter' => 'Nette\\Application\\MultiRouter',
			'User' => 'Nette\\Security\\User',
			'Nette-Autoloader' => 'Nette\\AutoLoader',
		),
		'webhost' => 'www.example.com',
		'variable' => array(
			'tempDir' => '%appDir%/cache',
			'foo' => '%bar% world',
			'bar' => 'hello',
		),
		'set' => array(
			'date.timezone' => 'Europe/Prague',
			'iconv.internal_encoding' => '%encoding%',
			'mbstring.internal_encoding' => '%encoding%',
			'include_path' => '%appDir%/../_trunk;%appDir%/libs',
		),
		'test' => array(
			'host' => 'localhost',
			'params' => array(
				'host' => 'dev.example.com',
				'username' => 'devuser',
				'password' => 'devsecret',
				'dbname' => 'dbname',
			),
			'adapter' => 'pdo_mysql',
		),
	),
	'extra' => array(
		'set' => array(
			'date.timezone' => 'Europe/Paris',
			'iconv.internal_encoding' => '%encoding%',
			'mbstring.internal_encoding' => '%encoding%',
			'include_path' => '%appDir%/../_trunk;%appDir%/libs',
		),
	),
), $config->toArray() );



// Save INI
$config->save(TEMP_FILE);
Assert::match( <<<EOD
; generated by Nette

[common]
variable.tempDir = "%appDir%/cache"
variable.foo = "%bar% world"
variable.bar = "hello"
set.date.timezone = "Europe/Prague"
set.iconv.internal_encoding = "%encoding%"
set.mbstring.internal_encoding = "%encoding%"
set.include_path = "%appDir%/../_trunk;%appDir%/libs"

[production]
service.Nette-Application-IRouter = "Nette\Application\MultiRouter"
service.User = "Nette\Security\User"
service.Nette-Autoloader = "Nette\AutoLoader"
webhost = "www.example.com"
database.params.host = "db.example.com"
database.params.username = "dbuser"
database.params.password = "secret"
database.params.dbname = "dbname"
database.adapter = "pdo_mysql"
variable.tempDir = "%appDir%/cache"
variable.foo = "%bar% world"
variable.bar = "hello"
set.date.timezone = "Europe/Prague"
set.iconv.internal_encoding = "%encoding%"
set.mbstring.internal_encoding = "%encoding%"
set.include_path = "%appDir%/../_trunk;%appDir%/libs"

[development]
database.params.host = "dev.example.com"
database.params.username = "devuser"
database.params.password = "devsecret"
database.params.dbname = "dbname"
database.adapter = "pdo_mysql"
service.Nette-Application-IRouter = "Nette\Application\MultiRouter"
service.User = "Nette\Security\User"
service.Nette-Autoloader = "Nette\AutoLoader"
webhost = "www.example.com"
variable.tempDir = "%appDir%/cache"
variable.foo = "%bar% world"
variable.bar = "hello"
set.date.timezone = "Europe/Prague"
set.iconv.internal_encoding = "%encoding%"
set.mbstring.internal_encoding = "%encoding%"
set.include_path = "%appDir%/../_trunk;%appDir%/libs"
test.host = "localhost"
test.params.host = "dev.example.com"
test.params.username = "devuser"
test.params.password = "devsecret"
test.params.dbname = "dbname"
test.adapter = "pdo_mysql"

[extra]
set.date.timezone = "Europe/Paris"
set.iconv.internal_encoding = "%encoding%"
set.mbstring.internal_encoding = "%encoding%"
set.include_path = "%appDir%/../_trunk;%appDir%/libs"
EOD
, file_get_contents(TEMP_FILE) );



// Load section from INI
$config = Config::fromFile('config2.ini', 'development');
Assert::same( array(
	'database' => array(
		'params' => array(
			'host' => 'dev.example.com',
			'username' => 'devuser',
			'password' => 'devsecret',
			'dbname' => 'dbname',
		),
		'adapter' => 'pdo_mysql',
	),
	'service' => array(
		'Nette-Application-IRouter' => 'Nette\Application\MultiRouter',
		'User' => 'Nette\Security\User',
		'Nette-Autoloader' => 'Nette\AutoLoader',
	),
	'webhost' => 'www.example.com',
	'variable' => array(
		'tempDir' => '%appDir%/cache',
		'foo' => '%bar% world',
		'bar' => 'hello',
	),
	'set' => array(
		'date.timezone' => 'Europe/Prague',
		'iconv.internal_encoding' => '%encoding%',
		'mbstring.internal_encoding' => '%encoding%',
		'include_path' => '%appDir%/../_trunk;%appDir%/libs',
	),
	'test' => array(
		'host' => 'localhost',
		'params' => array(
			'host' => 'dev.example.com',
			'username' => 'devuser',
			'password' => 'devsecret',
			'dbname' => 'dbname',
		),
		'adapter' => 'pdo_mysql',
	),
), $config->toArray() );
