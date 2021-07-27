<?

use Bitrix\Main\Loader;
use Bitrix\Sender\Security\Access;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public_bitrix24/marketing/.left.menu.php");

$aMenuLinks = array();

if (!Loader::includeModule('sender')) {
	return;
}

if (Access::current()->canViewStart()) {
	$aMenuLinks[] = array(
		GetMessage('SERVICES_MENU_MARKETING_START'),
		"/marketing/",
		array(),
		array(),
		""
	);
}

if (Access::current()->canViewLetters()) {
	$aMenuLinks[] = array(
		GetMessage('SERVICES_MENU_MARKETING_LETTERS'),
		"/marketing/letter/",
		array(),
		array(),
		""
	);
}

if (Access::current()->canViewAds()) {
	$aMenuLinks[] = array(
		GetMessage('SERVICES_MENU_MARKETING_ADS'),
		"/marketing/ads/",
		array(),
		array(),
		""
	);
}

if (Access::current()->canViewSegments()) {
	$aMenuLinks[] = array(
		GetMessage('SERVICES_MENU_MARKETING_SEGMENTS'),
		"/marketing/segment/",
		array(),
		array(),
		""
	);
}

if (Access::current()->canViewRc()) {
	$aMenuLinks[] = array(
		GetMessage('SERVICES_MENU_MARKETING_RETURN_CUSTOMER'),
		"/marketing/rc/",
		array(),
		array(),
		""
	);
}
if (
	method_exists(Access::current(), 'canViewToloka')
	&& Access::current()->canViewToloka()
) {
	$aMenuLinks[] = array(
		GetMessage('SERVICES_MENU_MARKETING_YANDEX_TOLOKA'),
		"/marketing/toloka/",
		array(),
		array(),
		""
	);
}

$canViewTemplates = method_exists(
	Access::class,
	'canViewTemplates') ?
	Access::current()->canViewTemplates() :
	Access::current()->canViewLetters();


if ($canViewTemplates) {
	$aMenuLinks[] = array(
		GetMessage('SERVICES_MENU_MARKETING_TEMPLATES'),
		"/marketing/template/",
		array(),
		array(),
		""
	);
}

if (Access::current()->canViewBlacklist()) {
	$aMenuLinks[] = array(
		GetMessage('SERVICES_MENU_MARKETING_BLACKLIST'),
		"/marketing/blacklist/",
		array(),
		array(),
		""
	);
}

$canViewClientList = method_exists(
	Access::class,
	'canViewClientList') ?
	Access::current()->canViewClientList() :
	Access::current()->canViewSegments();

if ($canViewClientList) {
	$aMenuLinks[] = array(
		GetMessage('SERVICES_MENU_MARKETING_CONTACT'),
		"/marketing/contact/",
		array(),
		array(),
		""
	);
}

if (Access::current()->canModifySettings()) {
	$aMenuLinks[] = array(
		GetMessage('SERVICES_MENU_MARKETING_CONFIG'),
		"/marketing/config.php",
		array(),
		array(),
		""
	);
}

if (Access::current()->canModifySettings()) {
	$aMenuLinks[] = array(
		GetMessage('SERVICES_MENU_MARKETING_ROLE'),
		"/marketing/config/role/",
		array(),
		array(),
		""
	);
}
