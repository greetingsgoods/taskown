<?

use Bitrix\Disk\Configuration;
use Bitrix\Im\User;
use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\UI\Extension;

define("BX_SKIP_USER_LIMIT_CHECK", true);
define("BX_PULL_SKIP_INIT", true);
require($_SERVER["DOCUMENT_ROOT"] . "/desktop_app/headers.php");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

Asset::getInstance()->setJsToBody(false);

if (!Application::getInstance()->isUtfMode()) {
	$GLOBALS["APPLICATION"]->RestartBuffer();
	CHTTP::SetStatus("404 Not Found");
	return;
}

if (!CModule::IncludeModule('im'))
	return;

if (intval($USER->GetID()) <= 0 || User::getInstance()->isConnector()) {
	?>
    <script type="text/javascript">
        if (typeof (BXDesktopSystem) != 'undefined')
            BXDesktopSystem.Login({});
        else
            location.href = '/';
    </script><?
	return true;
}

IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/im/install/public/desktop_app/index.php");

$GLOBALS["APPLICATION"]->SetPageProperty("BodyClass", "im-desktop");

Extension::load([
	'im_desktop',
	'ui.buttons',
	'ui.buttons.icons'
]);

$diskEnabled = false;
if (IsModuleInstalled('disk')) {
	$diskEnabled =
		Option::get('disk', 'successfully_converted', false) &&
		CModule::includeModule('disk');
	if ($diskEnabled && Configuration::REVISION_API >= 5) {
		$APPLICATION->IncludeComponent('bitrix:disk.bitrix24disk', '', array('AJAX_PATH' => '/desktop_app/disk.ajax.new.php'), false, array("HIDE_ICONS" => "Y"));
	} else {
		$diskEnabled = false;
	}
}

if (!$diskEnabled && IsModuleInstalled('webdav')) {
	$APPLICATION->IncludeComponent('bitrix:webdav.disk', '', array('AJAX_PATH' => '/desktop_app/disk.ajax.php'), false, array("HIDE_ICONS" => "Y"));
}

if (CModule::IncludeModule('timeman')) {
	CJSCore::init('im_timecontrol');
}
?>
#PLACEHOLDER#
<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>
