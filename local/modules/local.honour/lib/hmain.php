<?php

namespace Local\Honour;

use Bitrix\Main\Localization;
use Bitrix\Iblock\ElementTable;
use CUser;
use Local\Honour\ElementProperyTable;
use Bitrix\Iblock\PropertyTable;

Localization\Loc::loadMessages(__FILE__);


class HMain
{

	static $MODULE_ID = 'local.honour';
	static $ADMIN_MODULE_NAME = 'local.honour';
	static $settings = [];
	static $elementID;
	public $arHonours = [];

	static public function OnPageStartHandler()
	{
		global $APPLICATION;

		CJSCore::Init(array("jquery"));

		$path = '/bitrix/js/local.honour/';

		$APPLICATION->AddHeadScript($path . 'local.honour.js');

	}

	static public function getUserInfo($userId = null)
	{
		global $USER;

		if (!$userId) {
			$userId = $USER->GetID();
		}

		$rsUser = CUser::GetByID($userId);
		$arUser = $rsUser->Fetch();

		return $arUser;
	}

	static public function getOption($name, $default = null)
	{
		return Option::get(self::$ADMIN_MODULE_NAME, $name, $default);
	}

	static public function setOption($name, $value)
	{
		Option::set(self::$ADMIN_MODULE_NAME, $name, $value);
	}

	static public function storeEvent($event)
	{

	}

	/**
	 * @return array
	 */
	public function getArHonours(): array
	{
		$honoursParameters = [
			'filter' => [
//				'=ID' => 51,
				// '=PROPERTY_CODE' => "EXTTEXT",
				// '=PROPERTY_VALUE' => "Тестовое_значение",
				'=IBLOCK_ID' => 2,
			],
			'select' => [
				'ID', 'NAME',
				'PROPERTY_CODE' => 'PROPERTY_PROP.CODE',
				'PROPERTY_VALUE' => 'PROPERTY.VALUE',
				'PROPERTY_TYPE' => 'PROPERTY_PROP.PROPERTY_TYPE',
			],
			'runtime' => array(
				new Bitrix\Main\Entity\ReferenceField(
					'PROPERTY',
					'Local\Honour\ElementProperyTable',
					['=this.ID' => 'ref.IBLOCK_ELEMENT_ID'],
					['join_type' => 'LEFT']
				),

				new Bitrix\Main\Entity\ReferenceField(
					'PROPERTY_PROP',
					'\Bitrix\Iblock\PropertyTable',
					['=this.PROPERTY.IBLOCK_PROPERTY_ID' => 'ref.ID'],
					['join_type' => 'LEFT']
				),
			),
		];
		$this->arHonours = ElementTable::getList($honoursParameters);
		return $this->arHonours;
	}

	/**
	 * @param mixed $objHonour
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

}
