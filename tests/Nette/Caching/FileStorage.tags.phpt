<?php

/**
 * Test: Nette\Caching\Storages\FileStorage tags dependency test.
 *
 * @author     David Grudl
 * @package    Nette\Caching
 * @subpackage UnitTests
 */

use Nette\Caching\Storages\FileStorage,
	Nette\Caching\Storages\FileJournal,
	Nette\Caching\Cache;



require __DIR__ . '/../bootstrap.php';



TestHelpers::purge(TEMP_DIR);



$storage = new FileStorage(TEMP_DIR, new FileJournal(TEMP_DIR));
$cache = new Cache($storage);


// Writing cache...
$cache->save('key1', 'value1', array(
	Cache::TAGS => array('one', 'two'),
));

$cache->save('key2', 'value2', array(
	Cache::TAGS => array('one', 'three'),
));

$cache->save('key3', 'value3', array(
	Cache::TAGS => array('two', 'three'),
));

$cache['key4'] = 'value4';


// Cleaning by tags...
$cache->clean(array(
	Cache::TAGS => 'one',
));

Assert::false( isset($cache['key1']), 'Is cached key1?' );
Assert::false( isset($cache['key2']), 'Is cached key2?' );
Assert::true( isset($cache['key3']), 'Is cached key3?' );
Assert::true( isset($cache['key4']), 'Is cached key4?' );
