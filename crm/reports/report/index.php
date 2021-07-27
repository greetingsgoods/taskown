<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/crm/reports/report/index.php");
$APPLICATION->SetTitle(GetMessage("CRM_TITLE"));
?><? $APPLICATION->IncludeComponent(
	"bitrix:crm.report",
	"",
	array(
		"SEF_MODE" => "Y",
		"REPORT_ID" => $_REQUEST["report_id"],
		"SEF_FOLDER" => "/crm/reports/report/",
		"SEF_URL_TEMPLATES" => array(
			"index" => "index.php",
			"report" => "report/",
			"construct" => "construct/#report_id#/#action#/",
			"show" => "view/#report_id#/"
		),
		"VARIABLE_ALIASES" => array(
			"index" => array(),
			"report" => array(),
			"construct" => array(),
			"show" => array()
		)
	)
); ?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
