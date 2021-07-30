<?
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Application;

Loc::loadMessages(__FILE__);

Class local_honour extends CModule{
	var	$MODULE_ID = 'local.honour';
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;

	function __construct(){
		$arModuleVersion = array();
		include(__DIR__."/version.php");
		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = Loc::getMessage("LOCAL_HONOUR_MODULE_NAME");
		$this->MODULE_DESCRIPTION = Loc::getMessage("LOCAL_HONOUR_MODULE_DESC");

		$this->PARTNER_NAME = getMessage("LOCAL_HONOUR_PARTNER_NAME");
		$this->PARTNER_URI = getMessage("LOCAL_HONOUR_PARTNER_URI");

		$this->exclusionAdminFiles=array(
			'..',
			'.',
			'menu.php',
			'operation_description.php',
			'task_description.php'
		);
	}

	function InstallDB($arParams = array()){
		$this->createNecessaryIblocks();
//        $this->createNecessaryUserFields();
	}

	function UnInstallDB($arParams = array()){
		\Bitrix\Main\Config\Option::delete($this->MODULE_ID);
		$this->deleteNecessaryIblocks();
//        $this->deleteNecessaryUserFields();
	}

	function InstallEvents(){
		\Bitrix\Main\EventManager::getInstance()->registerEventHandler(
			"iblock",
			"OnBuildGlobalMenu",
			$this->MODULE_ID,
			'\Local\Honour\OnIBlockPropertyBuildListHandler',
			"GetUserTypeDescription"
		);

	}

	function UnInstallEvents(){
		\Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler(
			"iblock",
			"OnBuildGlobalMenu",
			$this->MODULE_ID,
			'\Local\Honour\EventHandlers\OnIBlockPropertyBuildListHandler',
			"GetUserTypeDescription"
		);

}

	function InstallFiles($arParams = array()){
		$path = $this->GetPath()."/install/components";
		if (\Bitrix\Main\IO\Directory::isDirectoryExists($path)){
			CopyDirFiles($path, $_SERVER["DOCUMENT_ROOT"]."/local/components", true, true);
		}

		$path=$_SERVER['DOCUMENT_ROOT'].'/local/modules/'.$this->MODULE_ID.'/install/components';
		if (\Bitrix\Main\IO\Directory::isDirectoryExists($path)){
			CopyDirFiles($path, $_SERVER["DOCUMENT_ROOT"]."/local/components/bitrix", true, true);
		}


		if (\Bitrix\Main\IO\Directory::isDirectoryExists($path = $this->GetPath().'/install/files')){
			$this->copyArbitraryFiles();
		}

		return true;
	}

	function UnInstallFiles(){
		\Bitrix\Main\IO\Directory::deleteDirectory($_SERVER["DOCUMENT_ROOT"].'/local/components/'.$this->MODULE_ID.'/');

		if (\Bitrix\Main\IO\Directory::isDirectoryExists($path = $this->GetPath().'/install/files')){
			$this->deleteArbitraryFiles();
		}

		\Bitrix\Main\IO\Directory::deleteDirectory($_SERVER["DOCUMENT_ROOT"]."local/components/bitrix/intranet.structure.honour");

		return true;
	}

	function copyArbitraryFiles(){
		$rootPath = $_SERVER["DOCUMENT_ROOT"];
		$localPath = $this->GetPath().'/install/files';

		$dirIterator = new RecursiveDirectoryIterator($localPath, RecursiveDirectoryIterator::SKIP_DOTS);
		$iterator = new RecursiveIteratorIterator($dirIterator, RecursiveIteratorIterator::SELF_FIRST);

		foreach ($iterator as $object){
			$destPath = $rootPath.DIRECTORY_SEPARATOR.$iterator->getSubPathName();
			($object->isDir()) ? mkdir($destPath) : copy($object, $destPath);
		}
	}

	function deleteArbitraryFiles(){
		$rootPath = $_SERVER["DOCUMENT_ROOT"];
		$localPath = $this->GetPath().'/install/files';

		$dirIterator = new RecursiveDirectoryIterator($localPath, RecursiveDirectoryIterator::SKIP_DOTS);
		$iterator = new RecursiveIteratorIterator($dirIterator, RecursiveIteratorIterator::SELF_FIRST);

		foreach ($iterator as $object){
			if (!$object->isDir()){
				$file = str_replace($localPath, $rootPath, $object->getPathName());
				\Bitrix\Main\IO\File::deleteFile($file);
			}
		}
	}

	function createNecessaryIblocks(){
		return true;
	}

	function deleteNecessaryIblocks(){
		return true;
	}

	function createNecessaryUserFields(){
		$this->createUserField(
			Array(
				"USER_TYPE_ID" => "string",
				"ENTITY_ID" => "IBLOCK_3_SECTION",
				"FIELD_NAME" => "UF_EXTTEXT",
				"XML_ID" => "",
				"SORT" => "100",
				"MULTIPLE" => "N",
				"MANDATORY" => "N",
				"SHOW_FILTER" => "N",
				"SHOW_IN_LIST" => "N",
				"EDIT_IN_LIST" => "N",
				"IS_SEARCHABLE" => "N",
				"SETTINGS" => 				Array(
					"DEFAULT_VALUE" => "",
					"SIZE" => "20",
					"ROWS" => "1",
					"MIN_LENGTH" => "0",
					"MAX_LENGTH" => "0",
					"REGEXP" => "",
				),
				"EDIT_FORM_LABEL" => 				Array(
					"ru" => Loc::getMessage("LOCAL_HONOUR_USER_FIELD_UF_EXTTEXT_EDIT_FORM_LABEL"),
				),
				"LIST_COLUMN_LABEL" => 				Array(
					"ru" => Loc::getMessage("LOCAL_HONOUR_USER_FIELD_UF_EXTTEXT_LIST_COLUMN_LABEL"),
				),
				"LIST_FILTER_LABEL" => 				Array(
					"ru" => Loc::getMessage("LOCAL_HONOUR_USER_FIELD_UF_EXTTEXT_LIST_FILTER_LABEL"),
				),
				"ERROR_MESSAGE" => 				Array(
					"ru" => Loc::getMessage("LOCAL_HONOUR_USER_FIELD_UF_EXTTEXT_ERROR_MESSAGE"),
				),
				"HELP_MESSAGE" => 				Array(
					"ru" => Loc::getMessage("LOCAL_HONOUR_USER_FIELD_UF_EXTTEXT_HELP_MESSAGE"),
				),
			)
		);
}

	function deleteNecessaryUserFields(){
		$this->removeUserField("UF_EXTTEXT");
	}

	function createNecessaryMailEvents(){
		return true;
	}

	function deleteNecessaryMailEvents(){
		return true;
	}

	function isVersionD7(){
		return CheckVersion(\Bitrix\Main\ModuleManager::getVersion('main'), '14.00.00');
	}

	function GetPath($notDocumentRoot = false){
		if ($notDocumentRoot){
			return str_ireplace(Application::getDocumentRoot(), '', dirname(__DIR__));
		}else{
			return dirname(__DIR__);
		}
	}

	function getSitesIdsArray(){
		$ids = Array();
		$rsSites = CSite::GetList($by = "sort", $order = "desc");
		while ($arSite = $rsSites->Fetch()){
			$ids[] = $arSite["LID"];
		}

		return $ids;
	}

	function isTypeSite(){
        return \Bitrix\Main\IO\Directory::isDirectoryExists($path = $this->GetPath().'/install/wizards');
    }

	function createUserField($arFields){
	$oUserTypeEntity = new \CUserTypeEntity();

	return $oUserTypeEntity->Add($arFields);
}

function removeUserField($code){
	$oUserTypeEntity = new \CUserTypeEntity();

	$rsData = \CUserTypeEntity::GetList(
		array($by => $order),
		array('FIELD_NAME' => $code)
	);
	while ($arRes = $rsData->Fetch()){
		$oUserTypeEntity->Delete($arRes['ID']);
	}
}

function DoInstall(){

		global $APPLICATION;
		if ($this->isVersionD7()){
			\Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);

			if (!$this->isTypeSite()){
                $this->InstallDB();
            }

            $this->createNecessaryMailEvents();
            $this->InstallEvents();
            $this->InstallFiles();
		}else{
			$APPLICATION->ThrowException(Loc::getMessage("LOCAL_HONOUR_INSTALL_ERROR_VERSION"));
		}

		$APPLICATION->IncludeAdminFile(Loc::getMessage("LOCAL_HONOUR_INSTALL"), $this->GetPath()."/install/step.php");
	}

	function DoUninstall(){

		global $APPLICATION;

		$context = Application::getInstance()->getContext();
		$request = $context->getRequest();

		$this->UnInstallFiles();
		$this->deleteNecessaryMailEvents();
		$this->UnInstallEvents();

		if ($request["savedata"] != "Y"){
            $this->UnInstallDB();
        }

		\Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);

		$APPLICATION->IncludeAdminFile(Loc::getMessage("LOCAL_HONOUR_UNINSTALL"), $this->GetPath()."/install/unstep.php");
	}
}
?>
