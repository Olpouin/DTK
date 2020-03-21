<?php
class Config {
	static $confArray;

	public static function read($name) {
		return self::$confArray[$name];
	}
	public static function write($name, $value) {
		self::$confArray[$name] = $value;
	}
	public static function add($name, $value) {
		if (!is_array(self::$confArray[$name])) return false;
		array_push(self::$confArray[$name], $value);
	}

	public static function checkPassword($pass) {
		foreach (Config::read('gene.password') as $key) {
			if (password_verify($pass, $key)) return true;
		} return false;
	}
}
require_once('../config/database.php');
require_once('../config/general.php');
class Core {
	public $db;
	private static $instance;

	function __construct() {
		$dsn = 'mysql:host='.Config::read('db.host').';dbname='.Config::read('db.name');
		$user = Config::read('db.user');
		$password = Config::read('db.password');

		$this->db = new PDO($dsn, $user, $password);
	}

	public static function getInstance() {
		if (!isset(self::$instance)) {
			$object = __CLASS__;
			self::$instance = new $object;
		}
		return self::$instance;
	}
}
$core = Core::getInstance();
require_once('functions.php');

$content['page'] = "";
$content['title'] = "";
$content['desc'] = "";
?>
