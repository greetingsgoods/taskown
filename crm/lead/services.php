<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/crm/lead/services.php");
$APPLICATION->SetTitle(GetMessage("CRM_TITLE"));
?><? $APPLICATION->IncludeComponent(
	"bitrix:crm.lead.webservice",
	"",
	array(),
	false
); ?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
