<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

global $APPLICATION;

$APPLICATION->IncludeComponent("bitrix:main.site.selector", "menu", array(
	"SITE_LIST" => array(
		0 => "*all*",
	),
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "86400",
),
	false,
	array("HIDE_ICONS" => "Y")
);

$aMenuLinks = array_merge($GLOBALS["arMenuSites"], $aMenuLinks);

?>
