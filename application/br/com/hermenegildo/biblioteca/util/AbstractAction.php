<?php
namespace br\com\hermenegildo\biblioteca\util {
	use br\com\hermenegildo\biblioteca\actions\LivroAction;

	use br\com\hermenegildo\biblioteca\actions\AutorAction;

	abstract class AbstractAction {
		public abstract function render();
		
		/**

		 * @param string $action Ação
		 * @return AutorAction
		 */
		public static function getAction($action) {
			switch ($action) {
				case 'livro':
					return new LivroAction();
				case 'autor':
				default:
					return new AutorAction();
			}
		}
	}
}