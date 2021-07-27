<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/crm/lead/index.php");
$APPLICATION->SetTitle(GetMessage("CRM_TITLE"));
?><? $APPLICATION->IncludeComponent(
	"bitrix:crm.lead",
	".default",
	array(
		"SEF_MODE" => "Y",
		"PATH_TO_CONTACT_SHOW" => "/crm/contact/show/#contact_id#/",
		"PATH_TO_CONTACT_EDIT" => "/crm/contact/edit/#contact_id#/",
		"PATH_TO_COMPANY_SHOW" => "/crm/company/show/#company_id#/",
		"PATH_TO_COMPANY_EDIT" => "/crm/company/edit/#company_id#/",
		"PATH_TO_DEAL_SHOW" => "/crm/deal/show/#deal_id#/",
		"PATH_TO_DEAL_EDIT" => "/crm/deal/edit/#deal_id#/",
		"PATH_TO_USER_PROFILE" => "/company/personal/user/#user_id#/",
		"PATH_TO_PRODUCT_EDIT" => "/crm/product/edit/#product_id#/",
		"PATH_TO_PRODUCT_SHOW" => "/crm/product/show/#product_id#/",
		"ELEMENT_ID" => $_REQUEST["lead_id"],
		"SEF_FOLDER" => "/crm/lead/",
		"SEF_URL_TEMPLATES" => array(
			"index" => "index.php",
			"list" => "list/",
			"edit" => "edit/#lead_id#/",
			"show" => "show/#lead_id#/",
			"convert" => "convert/#lead_id#/",
			"import" => "import/",
			"service" => "service/",
			"dedupe" => "dedupe/"
		),
		"VARIABLE_ALIASES" => array(
			"index" => array(),
			"list" => array(),
			"edit" => array(),
			"show" => array(),
			"convert" => array(),
			"import" => array(),
			"service" => array(),
			"dedupe" => array()
		)
	)
); ?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
