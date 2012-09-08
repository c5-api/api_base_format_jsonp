<?php defined('C5_EXECUTE') or die("Access Denied.");

class ApiBaseFormatJsonpPackage extends Package {

	protected $pkgHandle = 'api_base_format_jsonp';
	protected $appVersionRequired = '5.6.0';
	protected $pkgVersion = '0.9';

	public function getPackageName() {
		return t("Api:Base:Format:JSONP");
	}

	public function getPackageDescription() {
		return t("Adds support for JSONP as a response format.");
	}

	public function install() {
		$installed = Package::getByHandle('api');
		if(!is_object($installed)) {
			throw new Exception(t('Please install the "API" package before installing %s', $this->getPackageName()));
		}

		parent::install();

		$pkg = Package::getByHandle($this->pkgHandle);
		ApiFormatModel::add('jsonp', $pkg, true);

	}
	
	public function uninstall() {
		ApiFormatList::removeByPackage($this->pkgHandle);
		parent::uninstall();
	}

}