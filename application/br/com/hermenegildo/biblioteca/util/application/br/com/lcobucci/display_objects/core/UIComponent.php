<?php
namespace br\com\lcobucci\display_objects\core
{
	abstract class UIComponent
	{
		/**
		 * @var \Exception
		 */
		protected $error;
		
		/**
		 * @return string
		 */
		public function __toString()
		{
			try {
				return $this->render();
			} catch (\Exception $e) {
				$this->error = $e;
				return '';
			}
		}
		
		/**
		 * @param string $class
		 * @return string
		 */
		public function render($class = null)
		{
			if (is_null($class)) {
				$class = get_class($this);
			}
			
			ob_start();
			include 'templates/' . str_replace('\\', '/', $class) . '.phtml';
			$content = ob_get_contents();
			ob_end_clean();
			
			return $content;
		}
	}
}