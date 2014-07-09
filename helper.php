<?php
/**
 * Helper class for Hello World! module
 *
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @link http://dev.joomla.org/component/option,com_jd-wiki/Itemid,31/id,tutorials:modules/
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
require_once('TwitterAPIExchange.php');
class modTwitterHelper
{

    /**
     * Retrieves the hello message
     *
     * @param array $params An object containing the module parameters
     * @access public
     */


    public static function getPost( $params )
    {
        $twitter_id = $params->get('user_id');
        $settings = array(
            'oauth_access_token' => $params->get('oauth_access_token'),
            'oauth_access_token_secret' => $params->get('oauth_access_token_secret'),
            'consumer_key' => $params->get('consumer_key'),
            'consumer_secret' => $params->get('consumer_secret')
        );
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name='.$twitter_id.'&count=1';
        $requestMethod = 'GET';
        $memcache = new Memcache;
        $memcache->connect('localhost', 11211) or die ("Could not connect");
        $cache = $memcache->get('twitter-post-'.$twitter_id);
        if(!$cache){
            $twitter = new TwitterAPIExchange($settings);
            $data =  $twitter->setGetfield($getfield)
                         ->buildOauth($url, $requestMethod)
                         ->performRequest();
            $memcache->add('twitter-post-'.$twitter_id, $data, 0, 3600);
            return json_decode($data);
        } else {
            return json_decode($cache);
        }
    }
}
?>