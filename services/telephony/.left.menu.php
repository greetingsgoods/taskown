<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/services/telephony/.left.menu.php");
if (CModule::IncludeModule('voximplant')) {
	$aMenuLinks = array(
		array(
			GetMessage("SERVICES_MENU_TELEPHONY_CONNECT"),
			"/services/telephony/lines.php",
			array("/services/telephony/edit.php"),
			array("menu_item_id" => "menu_telephony_lines"),
			'Bitrix\Voximplant\Security\Helper::isLinesMenuEnabled()'
		),
		array(
			GetMessage("SERVICES_MENU_TELEPHONY_BALANCE"),
			"/services/telephony/index.php",
			array("/services/telephony/detail.php"),
			array("menu_item_id" => "menu_telephony_balance"),
			'Bitrix\Voximplant\Security\Helper::isBalanceMenuEnabled()'
		),
		array(
			GetMessage("SERVICES_MENU_TELEPHONY_USERS"),
			"/services/telephony/users.php",
			array(),
			array("menu_item_id" => "menu_telephony_users"),
			'Bitrix\Voximplant\Security\Helper::isUsersMenuEnabled()'
		),
		array(
			GetMessage("SERVICES_MENU_TELEPHONY_GROUPS"),
			"/services/telephony/groups.php",
			array('/services/telephony/editgroup.php'),
			array("menu_item_id" => "menu_telephony_groups"),
			'Bitrix\Voximplant\Security\Helper::isUsersMenuEnabled()'
		),
		array(
			GetMessage("SERVICES_MENU_TELEPHONY_PHONES"),
			"/services/telephony/phones.php",
			array(),
			array("menu_item_id" => "menu_telephony_phones"),
			""
		),
		array(
			GetMessage("SERVICES_MENU_TELEPHONY_PERMISSIONS"),
			"/services/telephony/permissions.php",
			array("/services/telephony/editrole.php"),
			array("menu_item_id" => "menu_telephony_permissions"),
			'Bitrix\Voximplant\Security\Helper::isSettingsMenuEnabled()'
		),
		array(
			GetMessage("SERVICES_MENU_TELEPHONY_IVR"),
			"/services/telephony/ivr.php",
			array("/services/telephony/editivr.php"),
			array("menu_item_id" => "menu_telephony_ivr"),
			'Bitrix\Voximplant\Security\Helper::isSettingsMenuEnabled()'
		),
		array(
			GetMessage("SERVICES_MENU_TELEPHONY"),
			"/services/telephony/configs.php",
			array(),
			array("menu_item_id" => "menu_telephony_configs"),
			'Bitrix\Voximplant\Security\Helper::isSettingsMenuEnabled()'
		),

	);
}
?>
