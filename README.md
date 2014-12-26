Class to display our double click ad placements
 
Usage Instructions:
 1) Place the header scripts from google in views/<desktop|mobile>/async-tags.php depending on web or mobile
 2) Place all the generated tags in views/<desktop|mobile>/ad-units.php depending on web or mobile
 3) You can then display the correct ad unit by 
	a) in a theme file call DFPads::funciton() with funciton either leaderboard, sidebar1 or sidebar2
	b) you can also use a shortcode in widgets/posts etc with [dfp_function] with function as sidebar1 or sidebar2
 
Notes
 Its really important the names of the ad units are consistant, best not to change them at all
 you can redo the placements and generate tags, just paste them in the files as descibed above and the script should carry on working fine with the new tags
 @author Chris Kirkland

