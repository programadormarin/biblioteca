<?php
namespace br\com\lcobucci\utils\autoloader {
	class NamespaceAutoloader {
		public static function register() {
			spl_autoload_register(array(new NamespaceAutoloader(), 'load'));
		}
		
		public function load($class) {
			include 'application/' . str_replace('\\', '/', $class) . '.php';
		}
	}
}