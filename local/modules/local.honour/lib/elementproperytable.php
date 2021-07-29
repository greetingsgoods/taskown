<?php

namespace Local\Honour;

use Bitrix\Main\Localization;

Localization\Loc::loadMessages(__FILE__);


use Bitrix\Main;
use Bitrix\Main\Entity;


class ElementProperyTable extends Main\Entity\DataManager
{

	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'b_iblock_element_property';
	}

	/**
	 * Returns entity map definition.
	 *
	 * @return array
	 */
	public static function getMap()
	{
		return [
			'ID' => new Main\Entity\IntegerField('ID', [
				'primary' => true,
				'autocomplete' => true,
				'title' => "ID записи",
			]),
			'IBLOCK_PROPERTY_ID' => new Main\Entity\IntegerField('IBLOCK_PROPERTY_ID', [
				'title' => "ID свойства",
			]),
			'IBLOCK_ELEMENT_ID' => new Main\Entity\IntegerField('IBLOCK_ELEMENT_ID', [
				'title' => "ID элемента инфоблока",
			]),
			'VALUE' => new Main\Entity\StringField('VALUE', [
				'title' => "Значение",
			]),
			'VALUE_TYPE' => new Main\Entity\StringField('VALUE_TYPE', [
				'title' => "Тип значения",
			]),
			'VALUE_ENUM' => new Main\Entity\StringField('VALUE_ENUM', [
				'title' => "ID элемента списка в свойстве типа Список",
			]),
			'VALUE_NUM' => new Main\Entity\StringField('VALUE_NUM', [
				'title' => "VALUE_NUM",]),
			'DESCRIPTION' => new Main\Entity\TextField('DESCRIPTION', [
				'title' => "Описание",]),

		];
	}
}
