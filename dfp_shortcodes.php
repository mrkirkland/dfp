<?php

//our short codes, pretty self explanatory
function dfp_sidebar1_func( $atts ){
	if (class_exists('dfpads')){
		dfpads::sidebar1();
	}
}
add_shortcode( 'dfp_sidebar1', 'dfp_sidebar1_func' );

//[foobar]
function dfp_sidebar2_func( $atts ){
	if (class_exists('dfpads')){
		DFPads::sidebar2();
	}       
}       
add_shortcode( 'dfp_sidebar2', 'dfp_sidebar2_func' );

function dfp_leaderboard_func( $atts ){
	if (class_exists('dfpads')){
		dfpads::leaderboard();
	}
}
add_shortcode( 'dfp_leaderboard', 'dfp_leaderboard_func' );

function dfp_inline_func( $atts ){
	if (class_exists('dfpads')){
		dfpads::inline();
	}
}
add_shortcode( 'dfp_inline', 'dfp_inline_func' );



function dfp_bottom_banner_func( $atts ){
	if (class_exists('dfpads')){
		dfpads::bottom_banner();
	}
}
add_shortcode( 'dfp_bottom_banner', 'dfp_bottom_banner_func' );


?>
