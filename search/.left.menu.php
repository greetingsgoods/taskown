<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/search/.left.menu.php");

$aMenuLinks = array(
	array(
		GetMessage("SEARCH_MAIN"),
		"/search/index.php",
		array(),
		array(),
		""
	),
	array(
		GetMessage("SEARCH_MAP"),
		"/search/map.php",
		array(),
		array(),
		""
	)
);
?>
