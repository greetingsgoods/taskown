<?

namespace Local\Honour;

use Bitrix\Main\Localization;

Localization\Loc::loadMessages(__FILE__);

class OnIBlockPropertyBuildListHandler
{
	public function GetUserTypeDescription()
	{

		file_put_contents(
			$_SERVER['DOCUMENT_ROOT'] . '/abcdef.log',
			date(DATE_COOKIE) . "\n" . print_r(
				['---'],
				true),
			FILE_APPEND
		);

		return array(
			"PROPERTY_TYPE" => "S", // тип свойства — строка
			"USER_TYPE" => "HTML",
			"DESCRIPTION" => "Привязка к доске почета",
			"GetPropertyFieldHtml" => array("\Local\Honour\OnIBlockPropertyBuildListHandler", "GetPropertyFieldHtml"),
		);
	}

	// вывод поля свойства на странице редактирования
	public function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
	{
		return '<input type="text" name="' . $strHTMLControlName["VALUE"] . '" value="' . $value['VALUE'] . '">';
	}
}



