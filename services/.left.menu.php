<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/services/.left.menu.php");

$aMenuLinks = array(
	array(
		GetMessage("SERVICES_MENU_MEETING_ROOM"),
		"/services/index.php",
		array("/services/res_c.php"),
		array(),
		"CBXFeatures::IsFeatureEnabled('MeetingRoomBookingSystem')"
	),
	array(
		GetMessage("SERVICES_MENU_LISTS"),
		"/services/lists/",
		array(),
		array(),
		"CBXFeatures::IsFeatureEnabled('Lists')"
	),
	array(
		GetMessage("SERVICES_MENU_CONTACT_CENTER"),
		"/services/contact_center/",
		array(),
		array(),
		""
	),
	array(
		GetMessage("SERVICES_MENU_EVENTLIST"),
		"/services/event_list.php",
		array(),
		array(),
		"CBXFeatures::IsFeatureEnabled('EventList')"
	),
	array(
		GetMessage("SERVICES_MENU_SALARY"),
		"/services/salary/",
		array(),
		array(),
		"LANGUAGE_ID == 'ru' && CBXFeatures::IsFeatureEnabled('Salary')"
	),
	array(
		GetMessage("SERVICES_MENU_TELEPHONY"),
		"/services/telephony/",
		array(),
		array(),
		'CModule::IncludeModule("voximplant") && SITE_TEMPLATE_ID !== "bitrix24" && Bitrix\Voximplant\Security\Helper::isMainMenuEnabled()'
	),
	/*Array(
		GetMessage("SERVICES_MENU_OPENLINES"),
		"/services/openlines/",
		Array(),
		Array(),
		'CModule::IncludeModule("imopenlines") && SITE_TEMPLATE_ID !== "bitrix24" && Bitrix\ImOpenlines\Security\Helper::isMainMenuEnabled()'
	),*/
);
?>
