<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/telephony/.left.menu.php");
if (CModule::IncludeModule('voximplant')) {
	$aMenuLinks = array(
		array(
			GetMessage("SERVICES_MENU_TELEPHONY_CONNECT"),
			"/telephony/index.php",
			array(),
			array("menu_item_id" => "menu_telephony_start"),
			'Bitrix\Voximplant\Security\Helper::isMainMenuEnabled()'
		),
		array(
			GetMessage("SERVICES_MENU_TELEPHONY_DETAIL"),
			"/telephony/detail.php",
			array(),
			array("menu_item_id" => "menu_telephony_detail"),
			'Bitrix\Voximplant\Security\Helper::isBalanceMenuEnabled()'
		),
	);
}
?>
