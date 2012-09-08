<?php defined('C5_EXECUTE') or die('Access Denied');

class JsonpApiFormat extends ApiFormatModel {
	
	public function setHeaders() {
		if(isset($_REQUEST['callback'])) {
			header('Content-type: text/javascript');
		} else {
			header('Content-type: application/json');
		}
	}

	public function display($data) {
		$callback = false;
		if(isset($_REQUEST['callback'])) {
			$callback = $_REQUEST['callback'];
		}
		$json = Loader::helper('json');
		$ret = $json->encode($data);
		if($callback) {
			$ret = $callback.'('.$ret.')';
		}
		return $ret;
	}

}