<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/crm/configs/status/index.php");
$APPLICATION->SetTitle(GetMessage("CRM_TITLE"));
?><? $APPLICATION->IncludeComponent(
	"bitrix:crm.config.status",
	"",
	array(),
	false
); ?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
