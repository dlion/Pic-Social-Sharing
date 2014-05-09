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
/** ====================================== */
/** SOCIAL SHARING SHORTCODE
/** ====================================== */
/**
 * Add socialshare shartcode
 *
 * @param $atts
 * @param null $content
 * @return string
 */
function pic_social_sharing_shortcode( $atts, $content = null )
{
    /**
     * facebook != 1 or 2 il the button is not displayed.
     * facebook = 1 add the button to share showing the total count [commentsbox_count,click_count,comment_count,like_count,share_count]
     * facebook = 2 add the button to share showing the counting of the like.
     *
     * twitter != 1 il the button is not displayed.
     * twitter = 1 add the button to share showing the total count.
     *
     * linkedin != 1 il the button is not displayed.
     * linkedin = 1 add the button to share showing the total count.
     *
     * googlepluseone != 1 il the button is not displayed.
     * googlepluseone = 1 add the button to share showing the total count.
     *
     * pinterest != 1 il the button is not displayed.
     * pinterest = 1 add the button to share showing the total count.
     *
     */
    extract(shortcode_atts(
            array(
                'facebook'       => 1,
                'twitter'        => 1,
                'linkedin'       => 1,
                'googlepluseone' => 1,
                'pinterest'      => 1,
                'fixed'          => 0,
                'titleshare'     => '',
            ), $atts)
    );

    $facebook          = (int)$facebook;
    $twitter           = (int)$twitter;
    $linkedin          = (int)$linkedin;
    $googlepluseone    = (int)$googlepluseone;
    $pinterest         = (int)$pinterest;
    $fixed             = (int)$fixed;
    $controll          = '';

    if($facebook == 1){ $facebook = 'fb';}
    elseif($facebook == 2){ $facebook = 'fb_like';}
    else { $facebook = '';}
    if($twitter == 1){ $twitter = 'tw';} else { $twitter = '';}
    if($linkedin == 1){ $linkedin = 'in';} else { $linkedin = '';}
    if($googlepluseone == 1){ $googlepluseone = 'gp';} else { $googlepluseone = '';}
    if($pinterest == 1){ $pinterest = 'pt';} else { $pinterest = '';}
    if($fixed == 1){ $fixed = 'fixed';} else { $fixed = '';}


    if( $titleshare == '' ){
        if( $fixed == '' )
        {
            $title = '<div class="sharetitle"><h5>Share this page with your social network !</h5></div>';
        }
        else
        {
            $title = '<div class="sharetitle"><h5>Share!</h5></div>';
            $controll = '<div class="controll controll-box"><i title="close share" class="fa fa-times"></i></div>';
        }
    }
    else
    {
        if( $fixed == 'fixed' )
        {
            $controll = '<div class="controll controll-box"><i title="close share" class="fa fa-times"></i></div>';
        }
        $title = '<div class="sharetitle"><h5>'.$titleshare.'</h5></div>';
    }
    $social = new Pic_Social_Sharing($facebook,$twitter,$linkedin,$googlepluseone,$pinterest);
    $output = '';
    $output .= $controll;
    $output .= '<section class="pic_socialshare '.$fixed.'">'.$title.'<ul>';
    $output .= $social->get_social_share_button('fb');
    $output .= $social->get_social_share_button('tw');
    $output .= $social->get_social_share_button('in');
    $output .= $social->get_social_share_button('gp');
    $output .= $social->get_social_share_button('pt');
    $output .= '</ul><p class="copy"><a title="Get PicShare !" href="http://www.picaland.it"> Get PicShare !</a></p></section>';
    return $output;
}
add_shortcode('socialshare', 'pic_social_sharing_shortcode');


/** ====================================== */
/** SOCIAL SHARING BUTTON TINYMCE
/** ====================================== */
/**
 * Inizialize button shortcode
 */

add_action('init', 'pic_socialshare_button');

/**
 * Fiunctions for button
 */
if( !function_exists('pic_socialshare_button')){
    function pic_socialshare_button()
    {
        if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
        {
            return;
        }
        if ( get_user_option('rich_editing') == 'true' )
        {
            add_filter( 'mce_external_plugins', 'pic_add_plugin' );
            add_filter( 'mce_buttons_2', 'pic_register_socialshare_button' );
        }
    }
}

/**
 * Register button
 */
if( !function_exists('pic_register_socialshare_button'))
{
    function pic_register_socialshare_button( $buttons )
    {
        array_push( $buttons, '|', 'socialshare' );
        return $buttons;
    }
}

/**
 * Register plugin for TinyMCE (name of WordPress editor)
 */
if( !function_exists('pic_add_plugin'))
{
    function pic_add_plugin( $plugin_array )
    {
        $plugin_array['socialshare'] = PIC_SOCIALSHARING_JS . 'add_shortcode.js';
        return $plugin_array;
    }
}

/**
 * Detect shortcode and load scripts and style
 */
if( !function_exists('pic_prefix_detect_shortcode'))
{
    function pic_prefix_detect_shortcode()
    {
        global $post;
        $pattern = get_shortcode_regex();

        if ( preg_match_all('/'. $pattern .'/s', $post->post_content, $matches) && array_key_exists(2, $matches) && in_array('socialshare', $matches[2]) )
        {
            /**
             * Function load scripts and style
             */
            function pic_socialshare_load_scripts()
            {
                wp_enqueue_style('socialshare', PIC_SOCIALSHARING_CSS . 'socialshare.css', false, PIC_SOCIALSHARING_VERSION, 'screen' );
                wp_enqueue_style('fontawesome', PIC_SOCIALSHARING_URL . 'font-awesome/css/font-awesome.min.css', false, PIC_SOCIALSHARING_VERSION, 'screen' );
                wp_enqueue_script('socialscroll', PIC_SOCIALSHARING_JS . 'scroll.js', '', PIC_SOCIALSHARING_VERSION, true );
            }
            add_action( 'wp_enqueue_scripts', 'pic_socialshare_load_scripts' );
        }
    }
    add_action( 'wp', 'pic_prefix_detect_shortcode' );
}