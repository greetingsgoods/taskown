<?

use Bitrix\Main\Data\AppCacheManifest;
use Bitrix\Main\Page\Frame;

define('BX_DONT_SKIP_PULL_INIT', true);
define('BX_DONT_INCLUDE_MOBILE_TEMPLATE_CSS', true);
require($_SERVER["DOCUMENT_ROOT"] . "/mobile/headers.php");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
CJSCore::Init(array("ls"));
//viewport rewrite
CMobile::getInstance()->setLargeScreenSupport(false);
CMobile::getInstance()->setScreenCategory("NORMAL");
$frame = Frame::getInstance();
$frame->setEnable();
$frame->setUseAppCache();

AppCacheManifest::getInstance()->addAdditionalParam("api_version", CMobile::getApiVersion());
AppCacheManifest::getInstance()->addAdditionalParam("platform", CMobile::getPlatform());
AppCacheManifest::getInstance()->addAdditionalParam("version", "v7");
AppCacheManifest::getInstance()->addAdditionalParam("user", $USER->GetID());
$frame->startDynamicWithID("menu");
$APPLICATION->IncludeComponent("bitrix:mobile.menu.ext", ".default", array(), false, array("HIDE_ICONS" => "Y"));
$frame->finishDynamicWithID("menu", $stub = "", $containerId = null, $useBrowserStorage = true);
$APPLICATION->IncludeComponent("bitrix:mobile.rtc", "", array(), false, array("HIDE_ICONS" => "Y"));
?>
<script type="text/javascript">
    app.enableSliderMenu(true);
</script>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php") ?>
