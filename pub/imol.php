<?php

use Bitrix\ImOpenLines\Session\Common;
use Bitrix\Intranet\Util;
use Bitrix\Main\Context;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

define('SKIP_TEMPLATE_AUTH_ERROR', true);
define('NOT_CHECK_PERMISSIONS', true);

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
Loc::loadMessages($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/pub/imol.php");

$arLang = Util::getLanguageList();
if (isset($_GET['user_lang']) && in_array($_GET['user_lang'], $arLang)) {
	define("LANGUAGE_ID", $_GET['user_lang']);
}

$APPLICATION->SetTitle(Loc::getMessage("IMOL_USERCONSENT_TITLE"));
$APPLICATION->SetPageProperty("BodyClass", "flexible-middle-width");
Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1.0">');

$request = Context::getCurrent()->getRequest();
if (CModule::IncludeModule('imopenlines')) {
	$agreementId = $request->get('id');
	$securityCode = $request->get('sec');
	$fields = Common::getAgreementFields();

	if ($request->get('iframe') == 'Y') {
		$APPLICATION->SetPageProperty("BodyClass", "iframe-body");
	}
} else {
	$agreementId = 0;
	$securityCode = '';
	$fields = array();
}

$APPLICATION->IncludeComponent(
	"bitrix:main.userconsent.view",
	"",
	array(
		'ID' => $agreementId,
		'SECURITY_CODE' => $securityCode,
		'REPLACE' => array('fields' => $fields)
	),
	null,
	array("HIDE_ICONS" => "Y")
);

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
