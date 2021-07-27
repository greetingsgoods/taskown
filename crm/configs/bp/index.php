<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/crm/configs/bp/index.php");
CModule::IncludeModule('bizproc');


$APPLICATION->SetTitle(GetMessage("CRM_TITLE"));
?>  <?
$APPLICATION->IncludeComponent(
	"bitrix:crm.config.bp",
	"",
	array(
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/crm/configs/bp/",
		"SEF_URL_TEMPLATES" => array(
			"ENTITY_LIST_URL" => "",
			"FIELDS_LIST_URL" => "#entity_id#/",
			"FIELD_EDIT_URL" => "#entity_id#/edit/#bp_id#/"
		),
		"VARIABLE_ALIASES" => array(
			"ENTITY_LIST_URL" => array(),
			"FIELDS_LIST_URL" => array(),
			"FIELD_EDIT_URL" => array(),
		)
	)
);

?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
