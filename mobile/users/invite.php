<?
require($_SERVER["DOCUMENT_ROOT"] . "/mobile/headers.php");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>
<? $APPLICATION->IncludeComponent("bitrix:mobile.invite.user", "",
	array(),
	false,
	array("HIDE_ICONS" => "Y")
); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php") ?>
