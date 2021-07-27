<?

use Bitrix\Bitrix24\Limits\User;
use Bitrix\Disk\Configuration;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use Bitrix\Main\Page\Asset;

define("BX_SKIP_USER_LIMIT_CHECK", true);
require($_SERVER["DOCUMENT_ROOT"] . "/desktop_app/headers.php");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

Asset::getInstance()->setJsToBody(false);

if (!CModule::IncludeModule('im'))
	return;

if (intval($USER->GetID()) <= 0 || \Bitrix\Im\User::getInstance()->isConnector()) {
	?>
    <script type="text/javascript">
        if (typeof (BXDesktopSystem) != 'undefined')
            BXDesktopSystem.Login({});
        else
            location.href = '/';
    </script><?
	return true;
}

if (
	Loader::includeModule('bitrix24')
	&& User::isUserRestricted($USER->GetID())
) {
	LocalRedirect('/desktop_app/limit.php');
	return false;
}

IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/im/install/public/desktop_app/index.php");

if (isset($_GET['IFRAME']) == 'Y') {
	$APPLICATION->IncludeComponent("bitrix:im.messenger", "iframe", array(
		"CONTEXT" => "FULLSCREEN",
	), false, array("HIDE_ICONS" => "Y"));
} else if (!isset($_GET['BXD_API_VERSION']) && mb_strpos($_SERVER['HTTP_USER_AGENT'], 'BitrixDesktop') === false) {
	$APPLICATION->IncludeComponent("bitrix:im.messenger", "fullscreen", array(
		"CONTEXT" => "FULLSCREEN",
		"DESIGN" => "DESKTOP",
	), false, array("HIDE_ICONS" => "Y"));
} else {
	?>
    <script type="text/javascript">
        if (typeof (BXDesktopSystem) != 'undefined')
            BX.desktop.init();
		<?if (!isset($_GET['BXD_MODE'])):?>
        else
            location.href = '/';
		<?endif;?>
    </script>
	<?
	$APPLICATION->IncludeComponent("bitrix:im.messenger", "", array(
		"CONTEXT" => "DESKTOP"
	), false, array("HIDE_ICONS" => "Y"));

	if (IsModuleInstalled('ui')) {
		$APPLICATION->IncludeComponent("bitrix:ui.info.helper", "", array());
	}

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
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>
