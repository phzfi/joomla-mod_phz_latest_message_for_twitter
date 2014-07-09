<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php
$item = $tweetData[0];

$document = JFactory::getDocument();
$modulePath = JURI::base() . 'modules/mod_phz_latest_message_for_twitter/';
$scripts = array_keys($document->_scripts);
$scriptFound = false;

foreach($scripts as $script) {
    if(strpos($script,'jquery') !== false) {
        $scriptFound = true;
        break;
    }
}
 if(!$scriptFound) {
     $document->addScript("//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js");
 }
$document->addScript($modulePath.'tmpl/js/scripts.js');
$document->addScript($modulePath.'tmpl/js/Autolinker.min.js');

$document->addStyleSheet($modulePath.'tmpl/css/stylesheet.css');

?>
    <div class="twitter">
        <a href="http://twitter.com/<?php echo $params->get('user_id'); ?>">
            <img class="twitter-logo" alt="twitter logo" src="<?php echo $modulePath . "tmpl/images/twitterx.png"; ?>">
        </a>
        <p class="twitter-username">@<?php echo $params->get('user_id'); ?></p>
        <a class="follow" href="http://twitter.com/<?php echo $params->get('user_id'); ?>"><button><?php echo JText::_('MOD_PHZ_LATEST_MESSAGE_FOR_TWITTER_FOLLOW_US')?></button></a>
        <p class="message"><?php echo $item->text;?></p>
        <div class="name-picture">
            <a href="http://twitter.com/<?php echo $params->get('user_id'); ?>">
                <img class="profile-picture" alt="logo" src="<?php echo $item->user->profile_image_url;?>"/>
            </a>
            <a href="http://twitter.com/<?php echo $params->get('user_id'); ?>">
                <p class="name"><?php echo $item->user->name;?></p>
            </a>
        </div>
    </div>
