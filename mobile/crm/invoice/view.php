<?php
// file for compatibility, need to delete after for a while
require($_SERVER['DOCUMENT_ROOT'] . '/mobile/headers.php');
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

if (!CModule::IncludeModule("crm"))
	return;

$APPLICATION->IncludeComponent(
	'bitrix:mobile.crm.invoice.edit',
	'',
	array(
		"RESTRICTED_MODE" => true,
		"USER_PROFILE_URL_TEMPLATE" => SITE_DIR . 'mobile/users/?user_id=#user_id#',
		'COMPANY_SHOW_URL_TEMPLATE' => SITE_DIR . 'mobile/crm/company/?page=view&company_id=#company_id#',
		'CONTACT_SHOW_URL_TEMPLATE' => SITE_DIR . 'mobile/crm/contact/?page=view&contact_id=#contact_id#',
		'INVOICE_EDIT_URL_TEMPLATE' => SITE_DIR . 'mobile/crm/invoice/?page=edit&invoice_id=#invoice_id#',
		'DEAL_SHOW_URL_TEMPLATE' => SITE_DIR . 'mobile/crm/deal/?page=view&deal_id=#deal_id#',
		'QUOTE_SHOW_URL_TEMPLATE' => SITE_DIR . 'mobile/crm/quote/?page=view&quote_id=#quote_id#'
	)
);
?>

<? require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
