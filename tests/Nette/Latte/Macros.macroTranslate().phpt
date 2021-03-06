<?php

/**
 * Test: Nette\Latte\DefaultMacros::macroTranslate()
 *
 * @author     David Grudl
 * @package    Nette\Latte
 * @subpackage UnitTests
 */

use Nette\Latte\DefaultMacros;



require __DIR__ . '/../bootstrap.php';


$macros = new DefaultMacros;

// {_...}
Assert::same( '$template->translate(\'var\')',  $macros->macroTranslate('var', '') );
Assert::same( '$template->filter($template->translate(\'var\'))',  $macros->macroTranslate('var', '|filter') );
