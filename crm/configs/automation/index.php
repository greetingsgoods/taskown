<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/crm/configs/automation/index.php");

$APPLICATION->SetTitle(GetMessage("TITLE"));
?><?
$APPLICATION->IncludeComponent(
	"bitrix:crm.config.automation",
	"",
	array(
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/crm/configs/automation/",
		"SEF_URL_TEMPLATES" => array(
			"index" => "index.php",
			"edit" => "#entity#/#category#/",
		),
		"VARIABLE_ALIASES" => array(
			"index" => array(),
			"edit" => array(),
		)
	)
);

?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
