<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/crm/configs/external_sale/index.php");
$APPLICATION->SetTitle(GetMessage("CRM_TITLE"));
?><? $APPLICATION->IncludeComponent(
	"bitrix:crm.config.external_sale",
	"",
	array(),
	false
); ?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
