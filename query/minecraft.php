<?php
namespace GSQuery\Query;

use GSQuery\GSQuery_Parent;
use GSQuery\Protocols\Sourcequery;
use GSQuery\Protocols\Sourcercon;

/**
 * A GSQuery Subclass which implements support for Minecraft servers
 *
 * @author Nikki
 *
 */
class Minecraft extends GSQuery_Parent {
	private $queryproto = false;
	private $rconproto = false;

	public function __construct($settings) {
		$settings += array(
			'host' => 'localhost',
			'port' => 25565
		);
		if(!isset($settings['query'])) {
			$settings['query'] = array();
		}
		$this->copySettings($settings, $settings['query'], array('host', 'port'));
		$this->queryproto = new Sourcequery($settings['query']);
		if(!empty($settings['rcon'])) {
			$settings['rcon'] += array(
				'port' => 25575
			);
			$this->copySettings($settings, $settings['rcon'], array('host'));
			$this->rconproto = new Sourcercon($settings['rcon']);
		}
	}

	public function queryInfo() {
		if(!$this->queryproto) {
			throw new Exception('Query protocol not initialized!');
		}
		return $this->queryproto->queryInfo();
	}

	public function queryPlayers() {
		if(!$this->queryproto) {
			throw new Exception('Query protocol not initialized!');
		}
		$tmp = $this->queryproto->queryInfo();
		if($tmp->players) {
			return $tmp->players;
		}
		return false;
	}

	public function queryRcon($command, $password = false) {
		if(!$this->rconproto) {
			throw new Exception('RCON protocol not initialized!');
		}
		return $this->rconproto->command($command);
	}
}
?>
