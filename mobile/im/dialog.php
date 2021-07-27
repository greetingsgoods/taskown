<?

use Bitrix\Main\Data\AppCacheManifest;

require($_SERVER["DOCUMENT_ROOT"] . "/mobile/headers.php");
define('MOBILE_TEMPLATE_CSS', "/im_styles.css");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

CModule::IncludeModule('im');

AppCacheManifest::getInstance()->addAdditionalParam("api_version", CMobile::getApiVersion());
AppCacheManifest::getInstance()->addAdditionalParam("platform", CMobile::getPlatform());
AppCacheManifest::getInstance()->addAdditionalParam("user", $USER->GetId());

$APPLICATION->IncludeComponent("bitrix:mobile.im.dialog", ".default", array(), false, array("HIDE_ICONS" => "Y"));

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php") ?>
