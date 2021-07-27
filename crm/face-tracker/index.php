<?

use Bitrix\Main\Localization\Loc;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/crm/face-tracker/index.php");
$APPLICATION->SetTitle(Loc::getMessage('FACEID_PUBLIC_PAGE_TITLE'));

$APPLICATION->includeComponent('bitrix:crm.control_panel', '',
	array(
		'ID' => 'FACETRACKER',
		'ACTIVE_ITEM_ID' => 'FACETRACKER'
	)
);

?><? $APPLICATION->IncludeComponent(
	"bitrix:faceid.tracker",
	"",
	array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	)
); ?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
