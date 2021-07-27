<?php

use Bitrix\Main\Application;

$siteId = '';
if (isset($_REQUEST['site_id']) && is_string($_REQUEST['site_id'])) {
	$siteId = mb_substr(preg_replace('/[^a-z0-9_]/i', '', $_REQUEST['site_id']), 0, 2);
}

if ($siteId) {
	define('SITE_ID', $siteId);
}

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

$request = Application::getInstance()->getContext()->getRequest();

$APPLICATION->IncludeComponent(
	'bitrix:ui.sidepanel.wrapper',
	'',
	[
		'POPUP_COMPONENT_NAME' => 'bitrix:salescenter.app',
		'POPUP_COMPONENT_TEMPLATE_NAME' => '',
		'POPUP_COMPONENT_PARAMS' => [
			'dialogId' => $request->get('dialogId'),
			'sessionId' => $request->get('sessionId'),
		],
		'USE_PADDING' => false,
	]
);

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');