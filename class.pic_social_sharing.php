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
 * Class Pic_Social_Sharing
 */
class Pic_Social_Sharing{

    public $facebook;

    public $twitter;

    public $linkedin;

    public $googleplusone;

    public $pinterest;

    /**
     * @param $facebook
     * @param $twitter
     * @param $linkedin
     * @param $googleplusone
     * @param $pinterest
     */
    public function __construct($facebook,$twitter,$linkedin,$googleplusone,$pinterest)
    {
        $this->facebook = $facebook;
        $this->twitter = $twitter;
        $this->linkedin = $linkedin;
        $this->googleplusone = $googleplusone;
        $this->pinterest = $pinterest;
    }

    /**
     * social counts
     * @param $social
     * @return bool|string
     */
    private function social_counts($social)
    {
        $url = get_permalink(get_the_ID());
        $json = file_get_contents("http://api.sharedcount.com/?url=" . rawurlencode($url));
        $counts = json_decode($json, true);

        switch($social)
        {
            case 'facebook':
                if($counts["Facebook"]["total_count"] >= 1000000 )
                {
                    $counts["Facebook"]["total_count"] = round(($counts["Facebook"]["total_count"]/1000000),3).' mil.';
                }
                return $counts["Facebook"]["total_count"];
                break;
            case 'facebook_like':
                if($counts["Facebook"]["like_count"] >= 1000000 )
                {
                    $counts["Facebook"]["like_count"] = round(($counts["Facebook"]["like_count"]/1000000),3).' mil.';
                }
                return $counts["Facebook"]["like_count"];
                break;
            case 'googleplusone':
                if($counts["GooglePlusOne"] >= 1000000 )
                {
                    $counts["GooglePlusOne"] = round(($counts["GooglePlusOne"]/1000000),3).' mil.';
                }
                return $counts["GooglePlusOne"];
                break;
            case 'twitter':
                if($counts["Twitter"] >= 1000000 )
                {
                    $counts["Twitter"] = round(($counts["Twitter"]/1000000),3).' mil.';
                }
                return $counts["Twitter"];
                break;
            case 'pinterest':
                if($counts["Pinterest"] >= 1000000 )
                {
                    $counts["Pinterest"] = round(($counts["Pinterest"]/1000000),3).' mil.';
                }
                return $counts["Pinterest"];
                break;
            case 'linkedin':
                if($counts["LinkedIn"] >= 1000000 )
                {
                    $counts["LinkedIn"] = round(($counts["LinkedIn"]/1000000),3).' mil.';
                }
                return $counts["LinkedIn"];
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * Get social share button
     * @param $social
     * @return string
     */
    public function get_social_share_button($social){

        switch($social){
            case 'fb':
                $output = '';
                if($this->facebook == 'fb')
                {
                    $output .= '<li><a title="facebook: '.$this->social_counts('facebook').'" href="https://www.facebook.com/sharer.php?u='.get_the_permalink().'">';
                    $output .= '<span class="fb"><i class="fa fa-facebook fa-2x"></i><span class="arrow-count"></span><span class="counter counter-fb">'.$this->social_counts('facebook').'</span></span>';
                    $output .= '</a></li>';
                }
                if($this->facebook == 'fb_like')
                {
                    $output .= '<li><a title="facebook like: '.$this->social_counts('facebook_like').'" href="https://www.facebook.com/sharer.php?u='.get_the_permalink().'">';
                    $output .= '<span class="fb"><i class="fa fa-thumbs-up fa-2x"></i><span class="arrow-count"></span><span class="counter counter-fb">'.$this->social_counts('facebook_like').'</span></span>';
                    $output .= '</a></li>';
                }
                return $output;
                break;
            case 'tw';
                $output = '';
                if($this->twitter == 'tw')
                {
                    $output .= '<li><a title="Twitter: '.$this->social_counts('twitter').'" href="https://twitter.com/share?url='.get_the_permalink().'&amp;text='. wp_trim_words( get_the_content(), 16, '...').'">';
                    $output .= '<span class="tw"><i class="fa fa-twitter fa-2x"></i><span class="arrow-count"></span><span class="counter counter-tw">'.$this->social_counts('twitter').'</span></span>';
                    $output .= '</a></li>';
                }
                return $output;
                break;
            case 'in':
                $output = '';
                if($this->linkedin == 'in')
                {
                    $output .= '<li><a title="Linkedin: '.$this->social_counts('linkedin').'" href="http://linkedin.com/shareArticle?mini=true&amp;url='.get_the_permalink().'&amp;title='.get_the_title().'&amp;ro=false&amp;summary='.wp_trim_words( get_the_content(), 25, '...').'&amp;source='.get_the_permalink().'">';
                    $output .= '<span class="in"><i class="fa fa-linkedin fa-2x"></i><span class="arrow-count"></span><span class="counter counter-in">'.$this->social_counts('linkedin').'</span></span>';
                    $output .= '</a></li>';
                }
                return $output;
                break;
            case 'gp':
                $output = '';
                if($this->googleplusone == 'gp')
                {
                    $output .= '<li><a title="GooglePlus: '.$this->social_counts('googleplusone').'" href="https://plusone.google.com/_/+1/confirm?hl=en&amp;url='.get_the_permalink().'">';
                    $output .= '<span class="gp"><i class="fa fa-google-plus fa-2x"></i><span class="arrow-count"></span><span class="counter counter-gp">'.$this->social_counts('googleplusone').'</span></span>';
                    $output .= '</a></li>';
                }
                return $output;
                break;
            case 'pt':
                $output = '';
                if($this->pinterest == 'pt')
                {
                    $attachment = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                    $output .= '<li><a title="Pinterest: '.$this->social_counts('pinterest').'" href="http://pinterest.com/pin/create/button/?url='.get_the_permalink().'&amp;media='.$attachment[0].'&amp;description='.wp_trim_words( get_the_content(), 25, '...').'">';
                    $output .= '<span class="pt"><i class="fa fa-pinterest fa-2x"></i><span class="arrow-count"></span><span class="counter counter-pt">'.$this->social_counts('pinterest').'</span></span>';
                    $output .= '</a></li>';
                }
                return $output;
                break;
            default:
                break;
        }
    }
    
}