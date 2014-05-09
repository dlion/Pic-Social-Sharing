<?php
/**
 * Alfio Piccione
 *
 * @package WordPress Plugins
 * @subpackage Picaland Theme
 * @author Alfio Piccione <alfio.piccione@gmail.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
?>
<?php
/**
 * Plugin Name: Pic Social Sharing
 * Plugin URI: http://picaland.it
 * Description: The Plugin allows you to enter via shortcode, social sharing buttons to share the post. Available Social: Facebook, Twitter, Linkedin, Googlepluseone, Pinterest. The buttons can be enabled or disabled via the parameters of the shortcode.
 * Version: 1.0.0
 * Author: Alfredo Piccione
 * Author URI: http://picaland.it
 *
 */

define( 'PIC_SOCIALSHARING_VERSION',                       '1.0' );
define( 'PIC_SOCIALSHARING_URL',      plugin_dir_url( __FILE__ ) );
define( 'PIC_SOCIALSHARING_DIR',     plugin_dir_path( __FILE__ ) );
define( 'PIC_SOCIALSHARING_JS',       PIC_SOCIALSHARING_URL.'js/');
define( 'PIC_SOCIALSHARING_CSS',     PIC_SOCIALSHARING_URL.'css/');

require_once PIC_SOCIALSHARING_DIR .'/class.pic_social_sharing.php';
require_once PIC_SOCIALSHARING_DIR .'/pic_ss_shortcode.php';