<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/crm/configs/fields/index.php");
$APPLICATION->SetTitle(GetMessage("CRM_TITLE"));
?><? $APPLICATION->IncludeComponent(
	"bitrix:crm.config.fields",
	"",
	array(
		"SEF_MODE" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_NOTES" => "",
		"SEF_FOLDER" => "/crm/configs/fields/",
		"SEF_URL_TEMPLATES" => array(
			"ENTITY_LIST_URL" => "",
			"FIELDS_LIST_URL" => "#entity_id#/",
			"FIELD_EDIT_URL" => "#entity_id#/edit/#field_id#/"
		),
		"VARIABLE_ALIASES" => array(
			"ENTITY_LIST_URL" => array(),
			"FIELDS_LIST_URL" => array(),
			"FIELD_EDIT_URL" => array(),
		)
	)
); ?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
