<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/.bottom.menu.php");

$aMenuLinks = array(
	array(
		GetMessage("BOTTOM_MENU_PRINT_VERSION"),
		"#print",
		array(),
		array(),
		""
	),
	array(
		GetMessage("BOTTOM_MENU_CONTACTS"),
		"/about/company/contacts.php",
		array(),
		array(),
		""
	),
	array(
		GetMessage("BOTTOM_MENU_SEARCH"),
		"/search/",
		array(),
		array(),
		""
	),
	array(
		GetMessage("BOTTOM_MENU_MAP"),
		"/search/map.php",
		array(),
		array(),
		""
	),
	array(
		GetMessage("BOTTOM_MENU_HELP"),
		"/services/help/",
		array(),
		array(),
		""
	),
);
?>
