<?

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Loader;

Loader::registerAutoLoadClasses('local.honour', array(
	'Local\Honour\ElementProperyTable' => 'lib/elementproperytable.php',
));
