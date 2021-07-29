<?php

namespace Local\Honour;

use Bitrix\Main\Localization;
use Bitrix\Iblock\ElementTable;
use Local\Honour\ElementProperyTable;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\Entity\ReferenceField;

Localization\Loc::loadMessages(__FILE__);


class HMain
{

	static $MODULE_ID = 'local.honour';
	static $ADMIN_MODULE_NAME = 'local.honour';
	static $settings = [];
	static $elementID;
	public $arHonours = [];
	private $IBLOCK_ID = 2;

	static public function OnPageStartHandler()
	{
		global $APPLICATION;
		CJSCore::Init(array("jquery"));
		$path = '/bitrix/js/local.honour/';
		$APPLICATION->AddHeadScript($path . 'local.honour.js');
	}


	/**
	 * @return array
	 *  -формируется удобный для result_modifier.php массив
	 *
	 */
	public function getArHonours(): array
	{
		$honoursParameters = [
			'filter' => [
				'=IBLOCK_ID' => $this->IBLOCK_ID,
			],
			'select' => [
				'ID', 'NAME',
				'PROPERTY_CODE' => 'PROPERTY_PROP.CODE',
				'PROPERTY_VALUE' => 'PROPERTY.VALUE',
				'PROPERTY_TYPE' => 'PROPERTY_PROP.PROPERTY_TYPE',
			],
			'runtime' => [
				new ReferenceField(
					'PROPERTY',
					'Local\Honour\ElementProperyTable',
					['=this.ID' => 'ref.IBLOCK_ELEMENT_ID'],
					['join_type' => 'LEFT']
				),

				new ReferenceField(
					'PROPERTY_PROP',
					'\Bitrix\Iblock\PropertyTable',
					['=this.PROPERTY.IBLOCK_PROPERTY_ID' => 'ref.ID'],
					['join_type' => 'LEFT']
				),
			],
		];
		$this->arHonours = ElementTable::getList($honoursParameters)->fetchAll();

		$arResHonour = [];
		array_walk($this->arHonours, function ($v, $k) use (&$arResHonour) {
			if ($v['PROPERTY_CODE'] == 'USER') {
				$arResHonour[$v['ID']]['idUser'] = $v['PROPERTY_VALUE'];
			} elseif ($v['PROPERTY_CODE'] == 'EXTTEXT') {
				$arResHonour[$v['ID']]['strHonour'] = $v['PROPERTY_VALUE'];
			} else {
				$arResHonour[$v['ID']][$v['PROPERTY_CODE']] = $v['PROPERTY_VALUE'];
			}
		});
		$this->arHonours = $arResHonour;

		return $this->arHonours;
	}

	/**
	 * @param text $textHonour
	 * Основная функция
	 * -из установленного в настройках модуля берЕтся ID свойства
	 * -записывается текст и возвращается ID записи
	 */
	public function setObjHonour($textHonour = ''): bool
	{
		$idSuccessWrite = false;
		$this->isExistHonour();

		$strProperty = self::getOption('nazvanie_svoystva');

		$propobj = new PropertyTable;
		$propdata = $propobj::query()
			->setSelect(['ID'])
			->setFilter(['CODE' => $strProperty])
			->exec()
			->fetch();

		if ((int)$propdata['ID'] < 0 && !empty($textHonour)) {
			return false;
		}

		$addResult = ElementProperyTable::add([
			'IBLOCK_PROPERTY_ID' => $propdata['ID'],
			'IBLOCK_ELEMENT_ID' => self::$elementID,
			'VALUE_TYPE' => 'text',
			'VALUE_NUM' => '0,0000',
			'VALUE' => $textHonour,

		]);
		if ($addResult->isSuccess()) {
			$idSuccessWrite = $addResult->getId();
		}
		return $idSuccessWrite;
	}

	/**
	 * @return bool
	 * Проверка, если есть запись, тогда,
	 * в конечном итоге, перезаписывается
	 */
	public function isExistHonour(): bool
	{
		$this->existHonour = false;

		$parameters = [
			'select' => [
				'ID',
				'IBLOCK_ELEMENT_ID',
			],
			'filter' => [
				'IBLOCK_ELEMENT_ID' => self::$elementID
			]
		];
		$objrecord = ElementProperyTable::getList($parameters)->fetch();
		if (is_array($objrecord) && count($objrecord)) {
			$objrecord->delete();
		}
		return $this->existHonour;
	}

	static public function getOption($name, $default = null)
	{
		return Option::get(self::$ADMIN_MODULE_NAME, $name, $default);
	}

	static public function setOption($name, $value)
	{
		Option::set(self::$ADMIN_MODULE_NAME, $name, $value);
	}

}
