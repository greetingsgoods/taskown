<?php

namespace Prostiezvonki;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Type;

Loc::loadMessages(__FILE__);

class PhoneCallsTable extends Entity\DataManager
{

	public static function getTableName()
	{
		return 'pz_phonecalls';
	}

	public static function getMap()
	{
		return array(
			'ID' => array(
				'autocomplete' => true,
				'primary' => true,
				'title' => Loc::getMessage('ID'),
				'data_type' => 'integer',
			),
			'PHONE_MASTER' => array(
				'data_type' => 'integer',
				'title' => Loc::getMessage('PHONE_MASTER'),
			),
			'PHONE_SLAVE' => array(
				'title' => Loc::getMessage('PHONE_SLAVE'),
				'data_type' => 'string',
			),
			'DIRECTION' => array(
				'data_type' => 'integer',
				'required' => false,
				'title' => Loc::getMessage('DIRECTION'),
			),
			'TALK_START' => array(
				'title' => Loc::getMessage('TALK_START'),
				'data_type' => 'datetime'
			),
			'TALK_END' => array(
				'title' => Loc::getMessage('TALK_END'),
				'data_type' => 'datetime'
			),
			'TALK_DURATION' => array(
				'data_type' => 'integer',
				'title' => Loc::getMessage('TALK_DURATION'),
			),
		);
	}

}
