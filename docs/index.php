<?

use Bitrix\Main\Loader;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
if (!Loader::includeModule('disk'))
	return;
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/docs/index.php");
$APPLICATION->SetTitle(GetMessage("DOCS_TITLE"));
?><? $APPLICATION->IncludeComponent(
	"bitrix:disk.aggregator",
	"",
	array(
		"SEF_MODE" => "Y",
		"CACHE_TIME" => 3600,
		"SEF_FOLDER" => "/docs/all",
	),
	false
); ?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
