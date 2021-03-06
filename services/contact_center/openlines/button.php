<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

IncludeModuleLangFile($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/bitrix24/public/crm/button/index.php');
$APPLICATION->SetTitle(GetMessage('CRM_TITLE'));

?>
<? $APPLICATION->IncludeComponent(
	'bitrix:intranet.contact_center.menu.top',
	'',
	[
		'COMPONENT_BASE_DIR' => SITE_DIR . 'services/contact_center/',
	],
	false
); ?>
<? $APPLICATION->IncludeComponent(
	'bitrix:crm.button',
	'.default',
	array(
		'HIDE_CRM_MENU' => 'Y',
		'SEF_MODE' => 'Y',
		'PATH_TO_CONTACT_SHOW' => SITE_DIR . 'crm/contact/show/#contact_id#/',
		'PATH_TO_CONTACT_EDIT' => SITE_DIR . 'crm/contact/edit/#contact_id#/',
		'PATH_TO_COMPANY_SHOW' => SITE_DIR . 'crm/company/show/#company_id#/',
		'PATH_TO_COMPANY_EDIT' => SITE_DIR . 'crm/company/edit/#company_id#/',
		'PATH_TO_DEAL_SHOW' => SITE_DIR . 'crm/deal/show/#deal_id#/',
		'PATH_TO_DEAL_EDIT' => SITE_DIR . 'crm/deal/edit/#deal_id#/',
		'PATH_TO_USER_PROFILE' => SITE_DIR . 'company/personal/user/#user_id#/',
		'ELEMENT_ID' => $_REQUEST['id'],
		'SEF_FOLDER' => SITE_DIR . 'crm/button/',
		'SEF_URL_TEMPLATES' => array(
			'list' => 'list/',
			'edit' => 'edit/#id#/',
		),
		'VARIABLE_ALIASES' => array(
			'list' => array(),
			'edit' => array(),
		)
	)
); ?><? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
