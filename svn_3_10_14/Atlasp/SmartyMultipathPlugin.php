<?php
class Atlasp_SmartyMultipathPlugin {
	protected $searchPaths = array();

	public function __construct($searchPaths=array()) {
		$this->searchPaths = $searchPaths;
	}

	protected function get_tpl_path($tpl_name) {
		foreach ($this->searchPaths as $path) {
			if (is_readable($path . '/' . $tpl_name)) {
				return $path . '/' . $tpl_name;
			}
		}
		return false;
	}

	public function smarty_resource_mpath_source($tpl_name, &$tpl_source, &$smarty) {
		$tplFile = $this->get_tpl_path($tpl_name);
		if (!$tplFile) { return false; } // no tpl file found
		$src = file_get_contents($tplFile);
		if ($src) {
			$tpl_source = $src;
			return true;
		}
		return false;
	}

	public function smarty_resource_mpath_timestamp($tpl_name, &$tpl_timestamp, &$smarty) {
		$tplFile = $this->get_tpl_path($tpl_name);

		/*
		echo "$tplFile<br\>\n";
		$tpl_timestamp = time();
		return true;
		*/

		if (!$tplFile) { return false; } // no tpl file found
		$arr = stat($tplFile);
		if (!$arr) {
			return false;
		}

		$tpl_timestamp = $arr[9]; //9 = mtime
		return true;
	}

	public function smarty_resource_mpath_secure($tpl_name, &$smarty) {
	    return true;
	}

	public function smarty_resource_mpath_trusted($tpl_name, &$smarty) {
	}
}
