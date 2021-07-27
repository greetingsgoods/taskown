<?

use Bitrix\Main\Config\Option;

define("NO_KEEP_STATISTIC", "Y");
define("NO_AGENT_STATISTIC", "Y");
define("NOT_CHECK_PERMISSIONS", true);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>
<?

if (Option::get("main", "site_stopped", "N") === 'Y') {
	return;
}

if (Option::get('disk', 'successfully_converted', false) != 'Y') {
	$APPLICATION->IncludeComponent("bitrix:webdav.extlinks", ".default", array());
	return;
}
?>

<? $APPLICATION->IncludeComponent("bitrix:disk.external.link", ".default", array()); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php"); ?>
