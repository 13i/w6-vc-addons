<?php
/**
 * Element parent class
 *
 * This class handles the element configuration and needs to be extended by an element class
 *
 * @package   W6\Vc_Addons
 * @author    WEB6 <contact@web6.fr>
 * @copyright 2018 WEB6
 * @license   https://www.gnu.org/licenses/gpl-3.0.txt  GNU GPLv3
 * @link      https://github.com/web6-fr/w6-vc-addons
 */

namespace W6\Vc_Addons;

/**
 * This class handles the element configuration
 *
 * @package   W6\Vc_Addons\Element
 */
abstract class Element extends \WPBakeryShortCode {

	/**
	 * Name
	 *
	 * @var string
	 */
	public $name;

	/**
	 * Description
	 *
	 * @var string
	 */
	public $description = '';

	/**
	 * Params
	 *
	 * @var array
	 */
	public $params = array();

	/**
	 * Ref
	 *
	 * Reference to the element used in various places.
	 * Corresponds to the class name without namespace.
	 *
	 * @var string
	 */
	public $ref;

	/**
	 * Category
	 *
	 * @var string
	 */
	public $category = 'WEB6 Addons';

	/**
	 * Path
	 *
	 * @var string
	 */
	public $path;

	/**
	 * Url
	 *
	 * @var string
	 */
	public $url;

	/**
	 * Class constructor
	 *
	 * @return void
	 */
	public function __construct() {

		// Set ref.
		$class     = get_class( $this );
		$this->ref = substr( $class, strrpos( $class, '\\' ) + 1 );

		// Set path.
		$this->path = \W6\Vc_Addons\ELEMENTS . '/' . $this->ref;

		// Set URL.
		$this->url = \W6\Vc_Addons\URL . 'elements/' . $this->ref;

		// Set name.
		$this->set_name();

		// Set description.
		$this->set_description();

		// Set params.
		$this->set_params();

		// Set admin & front assets.
		$this->set_assets();

		// Map params.
		add_action( 'init', array( $this, 'map' ) );

		// Add shortcode.
		add_shortcode( $this->ref, array( $this, 'out' ) );
	}

	/**
	 * Sets the name displayed in the element list
	 *
	 * @return void
	 */
	protected function set_name() {
		if ( empty( $this->name ) ) {
			$this->name = str_replace( '_', ' ', $this->ref );
		}
	}

	/**
	 * Sets the description displayed in the element list
	 *
	 * @return void
	 */
	protected function set_description() {}

	/**
	 * Sets the element parameters
	 *
	 * @return void
	 */
	protected function set_params() {}

	/**
	 * Sets admin & front CSS & JS automatically
	 *
	 * This methods searches the elements directory for specific files and adds them depending on the section visited :
	 * - admin.css
	 * - admin.js
	 * - front.css
	 * - front.js
	 *
	 * @return void
	 */
	protected function set_assets() {
		$filename = is_admin() ? 'admin' : 'front';
		$version  = \W6\Vc_Addons\VERSION;
		if ( file_exists( $this->path . '/' . $filename . '.css' ) ) {
			if ( WP_DEBUG ) {
				$version = filemtime( $this->path . '/' . $filename . '.css' );
			}
			wp_enqueue_style( 'css-' . $this->ref, $this->url . '/' . $filename . '.css', array(), $version, 'all' );
		}
		if ( file_exists( $this->path . '/' . $filename . '.js' ) ) {
			if ( WP_DEBUG ) {
				$version = filemtime( $this->path . '/' . $filename . '.js' );
			}
			wp_enqueue_script( 'js-' . $this->ref, $this->url . '/' . $filename . '.js', array( 'jquery' ), $version, true );
		}
	}

	/**
	 * Calls vc_map()
	 *
	 * @return void
	 */
	public function map() {
		$conf = array(
			'name'        => $this->name,
			'base'        => $this->ref,
			'description' => $this->description,
			'category'    => $this->category,
			'icon'        => get_stylesheet_directory_uri() . '/vc-icon.png',
		);
		if ( ! empty( $this->params ) ) {
			$conf['params'] = $this->params;
		}
		vc_map( $conf );
	}

	/**
	 * Shortcode output
	 *
	 * Extract shortcode params and tries to include the template.php file
	 *
	 * Param types (for reference) :
	 * textarea_html, textfield, textarea, dropdown, attach_image, attach_images,
	 * posttypes, colorpicker, exploded_textarea, widgetised_sidebars, textarea_raw_html,
	 * vc_link, checkbox, loop, css
	 *
	 * @param array  $atts Shortcode attributes.
	 * @param string $content Shortcode content.
	 * @param string $code Shortcode code.
	 *
	 * @return string
	 */
	public function out( $atts, $content, $code ) {
		$defaults = array();
		foreach ( $this->params as $param ) {
			if ( isset( $param['std'] ) ) {
				$defaults[ $param['param_name'] ] = $param['std'];
			} else {
				$defaults[ $param['param_name'] ] = null;
			}
			if ( is_array( $atts ) && array_key_exists( $param['param_name'], $atts ) ) {
				$atts[ $param['param_name'] ] = $this->parse_value( $param, $atts[ $param['param_name'] ] );
			}
		}

		$atts = shortcode_atts( $defaults, $atts );
		extract( $atts, EXTR_SKIP );

		$out      = '';
		$template = $this->path . '/template.php';
		if ( file_exists( $template ) ) {
			ob_start();
			include $template;
			$out = ob_get_clean();
		}

		return $out;
	}

	/**
	 * Parses values for easier manipulation
	 *
	 * @param array $param Parameter.
	 * @param mixed $value Value.
	 *
	 * @return mixed
	 */
	protected function parse_value( $param, $value ) {
		switch ( $param['type'] ) {
			case 'attach_image':
				return array_merge(
					(array) wp_get_attachment_image_src( $value, 'full' ),
					array( 'id' => $value )
				);
			case 'vc_link':
				return vc_build_link( $value );
			case 'param_group':
				$records = vc_param_group_parse_atts( $value );
				foreach ( $records as $key => $record ) {
					foreach ( $param['params'] as $_param ) {
						if ( array_key_exists( $_param['param_name'], $record ) ) {
							$records[ $key ][ $_param['param_name'] ] = $this->parse_value( $_param, $record[ $_param['param_name'] ] );
						}
					}
				}
				return $records;
		}
		return $value;
	}

}
