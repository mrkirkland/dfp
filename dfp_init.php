<?php
/*
Plugin Name: DFP Ads
Plugin URI: http://tokyocheapo.com
Description: Plugin to implement DFP on tokycheapo.com
Version: 1.0
Author: Chris Kirkland
*/

//load our nice class with the header and sidebar functions
require_once('dfp_ads.class.php');
DFPads::init();

require_once('dfp_shortcodes.php');

?>
