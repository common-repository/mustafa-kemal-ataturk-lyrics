<?php
/*
Plugin Name: Mustafa Kemal Atatürk Sözleri
Plugin URI: http://rubyzine.com
Description: "Hello Dolly" adlı eklentinin sözler bölümünü değiştirdik, eski sözlerin yerine Mustafa Kemal ATATÜRK' ün söylediği özlü sözleri yerleştirdik.
Author: Ruby Alen Ford
Version: 0.6
Author URI: http://rubyzine.com
*/

function mka_mka_lyrics()
{
	$lyrics_file = get_bloginfo('url').'/wp-content/plugins/mustafa-kemal-ataturk-lyrics/mka_lyrics_all.txt';
	$alloc_file = fopen("$lyrics_file", 'r');
	$mka_lyrics = file_get_contents($lyrics_file);
	fclose($alloc_file);

	$mka_lyrics = explode("#EOL", $mka_lyrics);
	return wptexturize( $mka_lyrics[ mt_rand(0, count($mka_lyrics) - 1) ] );
}

function mka_lyrics() {
	$chosen = mka_mka_lyrics() . ' <i><span> <a href="http://tr.wikipedia.org/wiki/Mustafa_Kemal_Atat%C3%BCrk" target="_blank">Mustafa Kemal ATATÜRK</a></span></i>';
	print '<p id=\'mka_lyrics_css\'><img style="margin:8px 0px 0px -50px;position:absolute;" src="' . get_bloginfo('url') . '/wp-content/plugins/mustafa-kemal-ataturk-lyrics/img/tr.gif" />' . $chosen . '</p>';
}

function mka_css() {
	$x = ( 'rtl' == get_bloginfo( 'text_direction' ) ) ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#mka_lyrics_css {
		max-width:600px;
		position: absolute;
		top: 1em;
		margin: 0;
		padding:5px;
		$x: 215px;
		font-family: 'Exo', sans-serif;
		font-size: 12pt;
		letter-spacing:0.8px;
		line-height:18px;
	}

	span{
	color:silver;
	text-decoration:underline;
	}

	</style>
	";
}

function google_fonts(){
	print '<link href=\'http://fonts.googleapis.com/css?family=Exo\' rel=\'stylesheet\' type=\'text/css\'>';	
}

add_action('admin_footer', 'mka_lyrics');
add_action('admin_head', 'google_fonts');
add_action('admin_head', 'mka_css');

?>
