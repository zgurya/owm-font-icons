<?php
/**
 * OWN_FI
*
* @since 0.1
*/
class OWN_FI{
	private static $instance = null;
	private function __clone() {}
	private function __construct() {}
	/**
	 * Check and return singleton IP_Banners object
	 *
	 * @access public
	 * @since 0.1
	 */
	public static function getInstance(){
		if (null === self::$instance){
			self::$instance = new self();
		}
		return self::$instance;
	}
}
?>