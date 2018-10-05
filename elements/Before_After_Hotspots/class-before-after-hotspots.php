<?php
/**
 * Before & After Hotspots
 *
 * Creates a before & after image comparator and add hotspots on each image
 * Code mainly copied from https://codyhouse.co/gem/css-jquery-image-comparison-slider/
 *
 * @package   W6\Vc_Addons
 * @author    WEB6 <contact@web6.fr>
 * @copyright 2018 WEB6
 * @license   https://www.gnu.org/licenses/gpl-3.0.txt  GNU GPLv3
 * @link      https://github.com/web6-fr/w6-vc-addons
 */

namespace W6\Vc_Addons\Elements;

/**
 * Before & After Hotspots
 *
 * @package   W6\Vc_Addons\Elements\
 */
class Before_After_Hotspots extends \W6\Vc_Addons\Element {

	/**
	 * Set the element name
	 *
	 * @return void
	 */
	protected function set_name() {
		$this->name = __( 'Before & After Hotspots', 'w6-vc-addons' );
	}

	/**
	 * Set the element description
	 *
	 * @return void
	 */
	protected function set_description() {
		$this->description = __( 'Creates a before & after image comparator and add hotspots on each image', 'w6-vc-addons' );
	}

	/**
	 * Set the element parameters
	 *
	 * @return void
	 */
	protected function set_params() {
		$this->params = array();
	}

}
