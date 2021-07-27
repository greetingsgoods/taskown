<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/.top_links.menu.php");

$aMenuLinks = array(
	array(
		GetMessage("TOP_LINKS_CP"),
		"/",
		array(),
		array(),
		""
	),
	array(
		GetMessage("TOP_LINKS_SITE"),
		GetMessage("TOP_LINKS_SITE_LINK"),
		array(),
		array(),
		""
	),
);
?>
