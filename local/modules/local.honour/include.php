<?

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Loader;

Loader::registerAutoLoadClasses('local.honour', [
	'Local\Honour\ElementProperyTable' => 'lib/elementproperytable.php',
	'Local\Honour\HMain' => 'lib/hmain.php',
]);
