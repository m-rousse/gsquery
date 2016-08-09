<?php
namespace GSQuery;

class GSQuery {
	static function create($type, $info) {
		$className = "Query\\".ucfirst($type);
		if(class_exists($className)){
			$instance = new $className($info);
			return $instance;
		}
		return false;
	}
}

/**
 * Subclass parent (Which handles the calls going to the protocol class)
 *
 * @author Nikki
 *
 */
class GSQuery_Parent {

	public function queryInfo() {
		error_log('GSQuery subtype does not support queryInfo()');
	}

	public function queryPlayers() {
		error_log('GSQuery subtype does not support queryPlayers()');
	}

	public function queryRcon($command) {
		error_log('GSQuery subtype does not support queryRcon()');
	}

	/**
	 * Copy settings from one array to another
	 * @param array $arr The source
	 * @param array $target The target
	 * @param array $keys The keys to copy
	 */
	protected function copySettings($arr, &$target, $keys) {
		foreach($keys as $key) {
			if(isset($arr[$key]) && empty($target[$key])) {
				$target[$key] = $arr[$key];
			}
		}
	}
}
?>
