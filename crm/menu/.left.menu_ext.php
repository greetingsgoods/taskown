<?

use Bitrix\Main\ModuleManager;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

$crmVersion = ModuleManager::getVersion("crm");
if ($crmVersion === false || version_compare($crmVersion, "17.0.4", "<")) {
	return;
}

$result = $GLOBALS["APPLICATION"]->IncludeComponent(
	'bitrix:crm.control_panel',
	'',
	array(
		"MENU_MODE" => "Y"
	)
);

$aMenuLinks = $result["ITEMS"];
