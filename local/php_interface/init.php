<?php

if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/bitrix/vendor/autoload.php')) {
	require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/vendor/autoload.php');
}
$eventManager = Bitrix\Main\EventManager::getInstance();
