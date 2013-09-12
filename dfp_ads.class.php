<?php
/*

 * Class to display our double click ad placements
 *
 * Usage Instructions:
 * 1) Place the header scripts from google in views/<desktop|mobile>/async-tags.php depending on web or mobile
 * 2) Place all the generated tags in views/<desktop|mobile>/ad-units.php depending on web or mobile
 * 3) You can then display the correct ad unit by 
	a) in a theme file call DFPads::funciton() with funciton either leaderboard, sidebar1 or sidebar2
	b) you can also use a shortcode in widgets/posts etc with [dfp_function] with function as sidebar1 or sidebar2
 *
 * Notes
 * Its really important the names of the ad units are consistant, best not to change them at all
 * you can redo the placements and generate tags, just paste them in the files as descibed above and the script should carry on working fine with the new tags
 * @author Chris Kirkland
 */


class DFPads
{

	private static $view_type 		= 'desktop';
	private static $page_type		= 'default';
	private static $view_folder;
	private static $view;

	public static function init()
	{

		//set the values
		self::set_view_type();
		self::set_page_type();
		self::$view_folder	=  plugin_dir_path( __FILE__ ) .'views';
	}

	public static function test()
	{
		echo "<!-- dfp test view type: ". self::$view_type ." page type: ". self::$page_type ." view folder: ". self::$view_folder ." -->";
	}

	//mobile or not
	public static function set_view_type()
	{
		require_once 'Mobile_Detect.php';
		$detect = new Mobile_Detect;
		//this doesn't work with caching (;_;)
		self::$view_type = ($detect->isMobile()) ? 'mobile' : 'desktop';
		$agent = $detect->getHttpHeader('User-Agent');
		//echo "<!-- dfp agent: $agent view: ". self::$view_type ." -->";
	}

	//figure out the page type
	public static function set_page_type()
	{
		if(is_home())
			$page_type = 'home'; 	//home
		elseif (is_tax('location'))
			$page_type = 'location';	//special post types
		elseif (in_category('events'))
			$page_type = 'events';	//special post types
		elseif (is_category())
			$page_type = 'category'; 	//category top page
		elseif (is_single())
			$page_type = 'article';	//blog post article
		else
			$page_type = 'default';

		self::$page_type = $page_type;
	}

	//normal view
	public static function async_tags()
	{
		//set view location
		$file = sprintf('%s/%s/async-tags.php', self::$view_folder, self::$view_type);
		return self::_show_view($file);
	}

	//load the desktop/mobile view for the page type of leaderboard
	public static function bottom_banner()
	{
		self::$view = 'bottom_banner';
		self::_show_generic_view();
	}

	//load the desktop/mobile view for the page type of leaderboard
	public static function leaderboard()
	{
		self::$view = 'leaderboard';
		self::_show_generic_view();
	}

	//load the desktop/mobile view for the page type of sidebar1
	public static function sidebar1()
	{
		self::$view = 'sidebar1';
		self::_show_generic_view();
	}

	//load the desktop/mobile view for the page type of sidebar2
	public static function sidebar2()
	{
		self::$view = 'sidebar2';
		self::_show_generic_view();
	}

	//normal view
	private static function _show_generic_view($return = FALSE)
	{
		//set view location
		$file = sprintf('%s/%s/ad-units.php', self::$view_folder, self::$view_type);
		if(!file_exists($file) || !is_readable($file))
			return FALSE;

		//set the string to search for
		$search = sprintf('<!-- TC_v2_%s_%s', self::$page_type, self::$view);
	
		//loop through each line
		$data = file($file);
		$length = 0;
		foreach($data as $line_no => $string)
		{
			//if start found, find the next comment as end line
			if(isset($start_line_no))
			{
				if(strstr($string, '<!-- '))
					break;
				else
					$length++;
			}
			//match the start line
			elseif(strstr($string, $search))
			{
				$start_line_no = $line_no;
			}
		}

		//failed to find it
		if(!isset($start_line_no))
		{
			echo "<!-- DFP cant find anything for ". self::$page_type ." ". self::$view ." in $file -->";
			return false;
		}

		//extract lines we want
		$ad = array_slice($data,$start_line_no,$length);
		$ad = implode("",$ad);

		if($return)
			return $ad;
		else
			echo $ad;

	}

	//load and output the ad
	private static function _show_view($file, $return = FALSE)
	{
		if(file_exists($file))
			$data = file_get_contents($file);
		else
			$data = "<!-- DFP missing view: $file -->";

		if($return)
			return $data;
		else
			echo $data;
	}

}
//end of file dfp_ads.class.php
