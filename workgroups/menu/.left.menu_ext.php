<?
/*

Unfortunately, this menu file has two copies:
- intranet/install/wizards/bitrix/portal/site/public/workgroups/menu/.left.menu_ext.php
- bitrix24/public/workgroups/menu/.left.menu_ext.php

If you edit this file, please, synchronize its duplicate version.

*/

use Bitrix\Main\DB\SqlExpression;
use Bitrix\Main\Entity\Query;
use Bitrix\Main\Entity\ReferenceField;
use Bitrix\Socialnetwork\UserToGroupTable;
use Bitrix\Socialnetwork\WorkgroupSiteTable;
use Bitrix\Socialnetwork\WorkgroupTable;
use Bitrix\Socialnetwork\WorkgroupViewTable;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

if (!CModule::IncludeModule("socialnetwork") || !$GLOBALS["USER"]->isAuthorized()) {
	return;
}

$count = 10;
$siteId = SITE_ID;
$userId = $GLOBALS["USER"]->getId();

$query = new Query(WorkgroupTable::getEntity());

$query->registerRuntimeField(
	'',
	new ReferenceField('UG',
		UserToGroupTable::getEntity(),
		array(
			'=ref.GROUP_ID' => 'this.ID',
			'=ref.USER_ID' => new SqlExpression($userId)
		),
		array('join_type' => 'LEFT')
	)
);
$query->registerRuntimeField(
	'',
	new ReferenceField('GV',
		WorkgroupViewTable::getEntity(),
		array(
			'=ref.GROUP_ID' => 'this.ID',
			'=ref.USER_ID' => new SqlExpression($userId)
		),
		array('join_type' => 'INNER')
	)
);
$query->registerRuntimeField(
	'',
	new ReferenceField('GS',
		WorkgroupSiteTable::getEntity(),
		array(
			'=ref.GROUP_ID' => 'this.ID'
		),
		array('join_type' => 'INNER')
	)
);
$query->addOrder('GV.DATE_VIEW', 'DESC');

$query->addFilter('=GS.SITE_ID', $siteId);
$query->addFilter(null, array(
	'LOGIC' => 'OR',
	'=VISIBLE' => 'Y',
	'<=UG.ROLE' => UserToGroupTable::ROLE_USER
));

$query->addSelect('ID');
$query->addSelect('NAME');

$query->countTotal(false);
$query->setOffset(0);
$query->setLimit($count);

$res = $query->exec();

$groupLastViewIdList = array();
if ($res) {
	while ($group = $res->fetch()) {
		$aMenuLinks[] = array(
			htmlspecialcharsEx($group["NAME"]),
			"/workgroups/group/" . $group["ID"] . "/",
			array(),
			array(),
			""
		);
		$groupLastViewIdList[] = $group['ID'];
	}
}

if (count($groupLastViewIdList) < $count) {
	$query = new Query(WorkgroupTable::getEntity());

	$query->registerRuntimeField(
		'',
		new ReferenceField('UG',
			UserToGroupTable::getEntity(),
			array(
				'=ref.GROUP_ID' => 'this.ID',
				'=ref.USER_ID' => new SqlExpression($userId)
			),
			array('join_type' => 'LEFT')
		)
	);
	$query->registerRuntimeField(
		'',
		new ReferenceField('GS',
			WorkgroupSiteTable::getEntity(),
			array(
				'=ref.GROUP_ID' => 'this.ID'
			),
			array('join_type' => 'INNER')
		)
	);
	$query->addOrder('NAME', 'ASC');

	$query->addFilter('=GS.SITE_ID', $siteId);
	$query->addFilter(null, array(
		'LOGIC' => 'OR',
		'=VISIBLE' => 'Y',
		'<=UG.ROLE' => UserToGroupTable::ROLE_USER
	));
	if (!empty($groupLastViewIdList)) {
		$query->addFilter('!@ID', $groupLastViewIdList);
	}

	$query->addSelect('ID');
	$query->addSelect('NAME');

	$query->countTotal(false);
	$query->setOffset(0);
	$query->setLimit($count - count($groupLastViewIdList));

	$res = $query->exec();
	if ($res) {
		while ($group = $res->fetch()) {
			$aMenuLinks[] = array(
				htmlspecialcharsEx($group["NAME"]),
				"/workgroups/group/" . $group["ID"] . "/",
				array(),
				array(),
				""
			);
			$groupLastViewIdList[] = $group['ID'];
		}
	}
}

if (defined("BX_COMP_MANAGED_CACHE")) {
	$GLOBALS["CACHE_MANAGER"]->registerTag("sonet_group_view_U" . $userId);
	$GLOBALS["CACHE_MANAGER"]->registerTag("sonet_user2group_U" . $userId);
	$GLOBALS["CACHE_MANAGER"]->registerTag("sonet_group");
}
