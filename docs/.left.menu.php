<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/docs/.left.menu.php");

$aMenuLinks = array(
	array(
		GetMessage("DOCS_MENU_ALL_DOCS"),
		"/docs/index.php",
		array(),
		array(),
		"CBXFeatures::IsFeatureEnabled('CommonDocuments')"
	),
	array(
		GetMessage("DOCS_MENU_SHARED"),
		"/docs/shared/",
		array(),
		array(),
		"CBXFeatures::IsFeatureEnabled('CommonDocuments')"
	),
	array(
		GetMessage("DOCS_MENU_SALE"),
		"/docs/sale/",
		array(),
		array(),
		"CBXFeatures::IsFeatureEnabled('CommonDocuments')"
	),
	array(
		GetMessage("DOCS_MENU_MANAGE"),
		"/docs/manage/",
		array(),
		array(),
		"CBXFeatures::IsFeatureEnabled('CommonDocuments')"
	)
);
?>
