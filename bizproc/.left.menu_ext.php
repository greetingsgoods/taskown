<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/bizproc/.left.menu_ext.php");

$aMenuLinks = array(
	array(
		GetMessage("MENU_BIZPROC_TASKS"),
		SITE_DIR . "company/personal/bizproc/",
		array(),
		array("counter_id" => "bp_tasks", "menu_item_id" => "menu_bizproc"),
		""
	)
);
if (CModule::IncludeModule("lists") && CLists::isFeatureEnabled()) {
	$aMenuLinks[] = array(
		GetMessage("MENU_MY_PROCESS"),
		SITE_DIR . "company/personal/processes/",
		array(),
		array("menu_item_id" => "menu_my_processes"),
		""
	);
}
if (CModule::IncludeModule("lists") && CLists::isFeatureEnabled()) {
	$aMenuLinks[] = array(
		GetMessage("MENU_PROCESS_STREAM"),
		SITE_DIR . "bizproc/processes/",
		array(),
		array("menu_item_id" => "menu_processes"),
		""
	);
}
$aMenuLinks[] = array(
	GetMessage("MENU_BIZPROC_ACTIVE"),
	SITE_DIR . "bizproc/bizproc/",
	array(),
	array("menu_item_id" => "menu_bizproc_active"),
	""
);
?>
