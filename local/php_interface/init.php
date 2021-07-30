<?php

use Bitrix\Main\Loader;

if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/bitrix/vendor/autoload.php')) {
	require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/vendor/autoload.php');
}
//$eventManager = Bitrix\Main\EventManager::getInstance();
Loader::includeModule('local.honour');
AddEventHandler(
	"iblock",
	"OnIBlockPropertyBuildList",
	array(
		'\Local\Honour\OnIBlockPropertyBuildListHandler',
//		"OnIBlockPropertyBuildListHandler",
		"GetUserTypeDescription"
	)
);

class OnIBlockPropertyBuildListHandler
{
	public function GetUserTypeDescription()
	{
		return array(
			"PROPERTY_TYPE" => "S", // тип свойства — строка
			"USER_TYPE" => "HTML",
			"DESCRIPTION" => "Привязка к доске почета",
			"GetPropertyFieldHtml" => array("OnIBlockPropertyBuildListHandler", "GetPropertyFieldHtml"),
		);
	}

	// вывод поля свойства на странице редактирования
	public function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
	{
		return '<input type="text" name="' . $strHTMLControlName["VALUE"] . '" value="' . $value['VALUE'] . '">';
	}
}


class CIBlockPropertyCustom
{
	public function GetUserTypeDescription()
	{
		return array(
			"PROPERTY_TYPE" => "S", // тип свойства — строка
			"USER_TYPE" => "HTML",
			"DESCRIPTION" => "Привязка к доске почета",
			"GetPropertyFieldHtml" => array("CIBlockPropertyCustom", "GetPropertyFieldHtml"),
		);
	}

	// вывод поля свойства на странице редактирования
	public function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
	{
		return '<input type="text" name="' . $strHTMLControlName["VALUE"] . '" value="' . $value['VALUE'] . '">';
	}

}
