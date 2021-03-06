<?php

/**
 * Test: Nette\Latte\DefaultMacros::macroControl()
 *
 * @author     David Grudl
 * @package    Nette\Latte
 * @subpackage UnitTests
 */

use Nette\Latte\DefaultMacros;



require __DIR__ . '/../bootstrap.php';


$macros = new DefaultMacros;

// {control ...}
Assert::match( '%a% $control->getWidget("form"); %a%->render()',  $macros->macroControl('form', '') );
Assert::match( '%a% $control->getWidget("form"); %a%->render()',  $macros->macroControl('form', 'filter') );
Assert::match( 'if (is_object($form)) %a% else %a% $control->getWidget($form); %a%->render()',  $macros->macroControl('$form', '') );
Assert::match( '%a% $control->getWidget("form"); %a%->renderType()',  $macros->macroControl('form:type', '') );
Assert::match( '%a% $control->getWidget("form"); %a%->{"render$type"}()',  $macros->macroControl('form:$type', '') );
Assert::match( '%a% $control->getWidget("form"); %a%->renderType(\'param\')',  $macros->macroControl('form:type param', '') );
Assert::match( '%a% $control->getWidget("form"); %a%->renderType(array(\'param\' => 123))',  $macros->macroControl('form:type param => 123', '') );
Assert::match( '%a% $control->getWidget("form"); %a%->renderType(array(\'param\' => 123))',  $macros->macroControl('form:type, param => 123', '') );
