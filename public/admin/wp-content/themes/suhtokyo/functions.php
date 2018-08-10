<?php

/*-------------------------------------------------

	--> グローバル変数

-------------------------------------------------*/


$URL = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

$url = "https://mp.startuphub.tokyo/";
if (strpos($_SERVER["HTTP_HOST"],'dev') !== false) {
  $url ='https://dev-mp.startuphub.tokyo/';
}
$USER_SITE_URL =$url;
/*-------------------------------------------------

	--> スマートフォンを判別

-------------------------------------------------*/

function is_mobile(){
    $useragents = array(
        'iPhone', // iPhone
        'iPod', // iPod touch
        'Android.*Mobile', // 1.5+ Android *** Only mobile
        'Windows.*Phone', // *** Windows Phone
        'dream', // Pre 1.5 Android
        'CUPCAKE', // 1.5+ Android
        'blackberry9500', // Storm
        'blackberry9530', // Storm
        'blackberry9520', // Storm v2
        'blackberry9550', // Storm v2
        'blackberry9800', // Torch
        'webOS', // Palm Pre Experimental
        'incognito', // Other iPhone browser
        'webmate' // Other iPhone browser

    );
    $pattern = '/'.implode('|', $useragents).'/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

function is_ipad() {
    $is_ipad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
    if ($is_ipad) {
        return true;
    } else {
        return false;
    }
}

function is_android() {
    $is_android = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'Android');
    if ($is_android) {
        return true;
    } else {
        return false;
    }
}

/*-------------------------------------------------

	--> WordPress 不要な設定の削除

-------------------------------------------------*/

	// REMOVE HEADER FILES
	remove_action('wp_head', 'feed_links_extra', 3); // Feed Link
	remove_action('wp_head', 'wp_generator'); // WP Ver.
	remove_action('wp_head', 'rsd_link'); // Edit URI
	remove_action('wp_head', 'wlwmanifest_link'); // Remote Post
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); // Short Link
	remove_action('wp_head', 'start_post_rel_link', 10, 0); // Browser Index
	remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Browser Index
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); // Prev & Next

	// jQuery DELETE
	function my_dequeue_styles() {
		wp_deregister_script( 'jquery' );
	}
	add_action( 'wp_print_styles', 'my_dequeue_styles' );

	// cssやscriptに付与されるバージョンのパラメータを削除
	function vc_remove_wp_ver_css_js( $src ) {
	    if ( strpos( $src, 'ver=' ) )
	        $src = remove_query_arg( 'ver', $src );
	    return $src;
	}

	// サムネイルの情報を削除
	function remove_img_attr($html, $id, $alt, $title, $align, $size) {
		list($img_src, $width, $height) = image_downsize($id, $size);
		$hwstring = image_hwstring($width, $height);
		$html = str_replace($hwstring, '', $html);
		$html = preg_replace('/title=[\'"]([^\'"]+)[\'"]/i', '', $html);
		return preg_replace('/ class=[\'"]([^\'"]+)[\'"]/i', '', $html);
	}
	add_filter('get_image_tag','remove_img_attr', 10, 6);


/*-------------------------------------------------

	--> INIT

-------------------------------------------------*/

	// ビジュアルエディタに CSS を設定
	add_editor_style( 'common/css/editor-style.css' );
	function custom_editor_settings($initArray) {
		$initArray['body_class'] = 'post_body';
		return $initArray;
	}
	add_filter('tiny_mce_before_init', 'custom_editor_settings');

	// 投稿画面の高さを調整
	add_action( 'admin_print_styles', 'my_admin_print_styles');
	function my_admin_print_styles() {
	?>
	<style>
		.wp-editor-area{ min-height: 250px !important; }
	</style>
	<?php
	}

	// サムネイル
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(630, 630);

	//メディアにSVGを使用可能に
	function cc_mime_types($mimes) {
	  $mimes['svg'] = 'image/svg+xml';
	  return $mimes;
	}
	add_filter('upload_mimes', 'cc_mime_types');

	function fix_svg_thumb_display() {
	  echo '<style>
	    td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail, #set-post-thumbnail img[src$=".svg"]{
	    width: 100% !important;
	    height: auto !important;
	    }</style>';
	}
	add_action('admin_head', 'fix_svg_thumb_display');

	//｢投稿｣を「お知らせ」へ変更
	function change_post_menu_label() {
	    global $menu;
	    global $submenu;
	    $menu[5][0] = 'お知らせ';
	    $submenu['edit.php'][5][0] = 'お知らせ一覧';
	    $submenu['edit.php'][10][0] = '新規投稿';
	    $submenu['edit.php'][16][0] = 'タグ';
	    //echo ”;
	}
	function change_post_object_label() {
	    global $wp_post_types;
	    $labels = &$wp_post_types['post']->labels;
	    $labels->name = 'お知らせ';
	    $labels->singular_name = 'お知らせ';
	    $labels->add_new = _x('新規追加', 'お知らせ');
	    $labels->add_new_item = '新規投稿';
	    $labels->edit_item = '投稿記事の編集';
	    $labels->new_item = '新規投稿';
	    $labels->view_item = 'お知らせを表示';
	    $labels->search_items = '検索';
	    $labels->not_found = 'お知らせが見つかりませんでした';
	    $labels->not_found_in_trash = 'ゴミ箱のお知らせにも見つかりませんでした';
	}
	add_action( 'init', 'change_post_object_label' );
	add_action( 'admin_menu', 'change_post_menu_label' );


/*-------------------------------------------------

	--> カスタムタクソノミ

-------------------------------------------------*/

	function add_type_event() {
		$labels = array(
			'name' => _x('イベント', 'event'),
			'singular_name' => _x('イベント ', 'event'),
			'add_new' => _x('新しく記事を追加', 'event'),
			'add_new_item' => __('記事を追加'),
			'edit_item' => __('記事を編集'),
			'new_item' => __('インタビュー'),
			'view_item' => __('記事を見る'),
			'search_items' => __('記事を探す'),
			'not_found' =>	__('記事はありません'),
			'not_found_in_trash' => __('ゴミ箱に記事はありません'),
			'parent_item_colon' => ''
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'menu_position' => 5,
			'supports' => array('title','editor','thumbnail'),
			'has_archive' => true
		);
		register_post_type('event', $args);

		$cat = array(
		    'label' => 'イベントカテゴリ',
		    'labels' => array(
		        'name' => 'イベントカテゴリ',
		        'singular_name' => 'イベントカテゴリ',
		        'search_items' => 'イベントカテゴリを検索',
		        'popular_items' => 'よく使われている イベントカテゴリ',
		        'all_items' => 'すべての イベントカテゴリ',
		        'parent_item' => '親 イベントカテゴリ',
		        'edit_item' => 'イベントカテゴリの編集',
		        'update_item' => '更新',
		        'add_new_item' => '新規 イベントカテゴリを追加',
		        'new_item_name' => '新しい イベントカテゴリ',
		    ),
		    'public' => true,
		    'show_ui' => true,
		    'hierarchical' => true,
		    'show_tagcloud' => true
		);
		register_taxonomy('events', 'event', $cat);

		$tag = array(
		    'label' => 'イベントタグ',
		    'labels' => array(
		        'name' => 'イベントタグ',
		        'singular_name' => 'イベントタグ',
		        'search_items' => 'イベントタグを検索',
		        'popular_items' => 'よく使われている イベントタグ',
		        'all_items' => 'すべての イベントタグ',
		        'parent_item' => '親 イベントタグ',
		        'edit_item' => 'イベントタグの編集',
		        'update_item' => '更新',
		        'add_new_item' => '新規 イベントタグを追加',
		        'new_item_name' => '新しい イベントタグ',
		    ),
		    'public' => true,
		    'show_ui' => true,
		    'hierarchical' => false,
		    'show_tagcloud' => true
		);
		register_taxonomy('event_tag', 'event', $tag);


	}
	add_action('init', 'add_type_event');


	function add_type_magazine() {
		$labels = array(
			'name' => _x('マガジン', 'magazine'),
			'singular_name' => _x('マガジン ', 'magazine'),
			'add_new' => _x('新しく記事を追加', 'magazine'),
			'add_new_item' => __('記事を追加'),
			'edit_item' => __('記事を編集'),
			'new_item' => __('インタビュー'),
			'view_item' => __('記事を見る'),
			'search_items' => __('記事を探す'),
			'not_found' =>	__('記事はありません'),
			'not_found_in_trash' => __('ゴミ箱に記事はありません'),
			'parent_item_colon' => ''
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'menu_position' => 5,
			'supports' => array('title','editor','thumbnail'),
			'has_archive' => true
		);
		register_post_type('magazine', $args);

		$cat = array(
		    'label' => 'マガジンカテゴリ',
		    'labels' => array(
		        'name' => 'マガジンカテゴリ',
		        'singular_name' => 'マガジンカテゴリ',
		        'search_items' => 'マガジンカテゴリを検索',
		        'popular_items' => 'よく使われている マガジンカテゴリ',
		        'all_items' => 'すべての マガジンカテゴリ',
		        'parent_item' => '親 マガジンカテゴリ',
		        'edit_item' => 'マガジンカテゴリの編集',
		        'update_item' => '更新',
		        'add_new_item' => '新規 マガジンカテゴリを追加',
		        'new_item_name' => '新しい マガジンカテゴリ',
		    ),
		    'public' => true,
		    'show_ui' => true,
		    'hierarchical' => true,
		    'show_tagcloud' => true
		);
		register_taxonomy('magazines', 'magazine', $cat);


	}
	add_action('init', 'add_type_magazine');

	function add_type_concierge() {
		$labels = array(
			'name' => _x('コンシェルジュ', 'concierge'),
			'singular_name' => _x('コンシェルジュ ', 'concierge'),
			'add_new' => _x('新しく記事を追加', 'concierge'),
			'add_new_item' => __('記事を追加'),
			'edit_item' => __('記事を編集'),
			'new_item' => __('インタビュー'),
			'view_item' => __('記事を見る'),
			'search_items' => __('記事を探す'),
			'not_found' =>	__('記事はありません'),
			'not_found_in_trash' => __('ゴミ箱に記事はありません'),
			'parent_item_colon' => ''
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'menu_position' => 5,
			'supports' => array('title','editor','thumbnail'),
			'has_archive' => true
		);
		register_post_type('concierge', $args);

		$cat = array(
		    'label' => 'コンシェルジュカテゴリ',
		    'labels' => array(
		        'name' => 'コンシェルジュカテゴリ',
		        'singular_name' => 'コンシェルジュカテゴリ',
		        'search_items' => 'コンシェルジュカテゴリを検索',
		        'popular_items' => 'よく使われている コンシェルジュカテゴリ',
		        'all_items' => 'すべての コンシェルジュカテゴリ',
		        'parent_item' => '親 コンシェルジュカテゴリ',
		        'edit_item' => 'コンシェルジュカテゴリの編集',
		        'update_item' => '更新',
		        'add_new_item' => '新規 コンシェルジュカテゴリを追加',
		        'new_item_name' => '新しい コンシェルジュカテゴリ',
		    ),
		    'public' => true,
		    'show_ui' => true,
		    'hierarchical' => true,
		    'show_tagcloud' => true
		);
		register_taxonomy('concierges', 'concierge', $cat);

		$tag = array(
		    'label' => 'コンシェルジュタグ',
		    'labels' => array(
		        'name' => 'コンシェルジュタグ',
		        'singular_name' => 'コンシェルジュタグ',
		        'search_items' => 'コンシェルジュタグを検索',
		        'popular_items' => 'よく使われている コンシェルジュタグ',
		        'all_items' => 'すべての コンシェルジュタグ',
		        'parent_item' => '親 コンシェルジュタグ',
		        'edit_item' => 'コンシェルジュタグの編集',
		        'update_item' => '更新',
		        'add_new_item' => '新規 コンシェルジュタグを追加',
		        'new_item_name' => '新しい コンシェルジュタグ',
		    ),
		    'public' => true,
		    'show_ui' => true,
		    'hierarchical' => false,
		    'show_tagcloud' => true
		);
		register_taxonomy('concierge_tag', 'concierge', $tag);

	}
	add_action('init', 'add_type_concierge');

	function add_type_partners() {
		$labels = array(
			'name' => _x('パートナー', 'partners'),
			'singular_name' => _x('パートナー', 'partners'),
			'add_new' => _x('新しく記事を追加', 'partners'),
			'add_new_item' => __('記事を追加'),
			'edit_item' => __('記事を編集'),
			'new_item' => __('インタビュー'),
			'view_item' => __('記事を見る'),
			'search_items' => __('記事を探す'),
			'not_found' =>	__('記事はありません'),
			'not_found_in_trash' => __('ゴミ箱に記事はありません'),
			'parent_item_colon' => ''
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'menu_position' => 5,
			'supports' => array('title','editor','thumbnail'),
			'has_archive' => true
		);
		register_post_type('partners', $args);
	
		$cat = array(
		    'label' => 'パートナーカテゴリ',
		    'labels' => array(
		        'name' => 'パートナーカテゴリ',
		        'singular_name' => 'パートナーカテゴリ',
		        'search_items' => 'パートナーカテゴリを検索',
		        'popular_items' => 'よく使われている パートナーカテゴリ',
		        'all_items' => 'すべての パートナーカテゴリ',
		        'parent_item' => '親 パートナーカテゴリ',
		        'edit_item' => 'パートナーカテゴリの編集',
		        'update_item' => '更新',
		        'add_new_item' => '新規 パートナーカテゴリを追加',
		        'new_item_name' => '新しい パートナーカテゴリ',
		    ),
		    'public' => true,
		    'show_ui' => true,
		    'hierarchical' => true,
		    'show_tagcloud' => true
		);
		register_taxonomy('partner', 'partners', $cat);
		
	}
	add_action('init', 'add_type_partners');
	
/*-------------------------------------------------

	--> ARCHIVE PAGE

-------------------------------------------------*/

// カスタム投稿タイプの年別リスト：出力内容カスタマイズ
/*function add_span_year_archives( $link_html ) {
    $regex = array (
        '/ title="([\d]{4})"/'  => 'title="$1"',
        '/ ([\d]{4}) /'         => '$1',
        '/>([\d]{4})<\/a>/'     => ' data-namespace="listpage"><span class="a_body"><span class="bg"></span><span class="text">$1</span></span></a>'
    );
    $link_html = preg_replace( array_keys( $regex ), $regex, $link_html );
    return $link_html;
}
add_filter( 'get_archives_link', 'add_span_year_archives' );*/

function my_archives_link($link_html){
	$URL = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

	$keys = parse_url($URL); //パース処理
	$URL = $keys['path'];
	$URL = (strpos($URL,'/page/') !== false)? str_replace('/page/'.end(explode("/", $URL)), '', $URL):$URL;

	$regex = (strpos($link_html,'option') !== false)?'/^\t<(link |option |option>)/' : '/^\t<(link |option |li>)/';
	if ( preg_match( $regex, $link_html, $m ) ) {
		switch ( $m[1] ) {
			case 'li>' :
		 	if(preg_match('{'.str_replace(array("?post_type=event","?post_type=magazine"),"",$URL).'}',$link_html)){
				$link_html = preg_replace('@<li>@i', '<li class="current">', $link_html);
			}
			break;
			case 'option>' :
				$YEAR = "/".str_replace(array("?post_type=event","?post_type=magazine"), '', basename($URL));
				$link_html = preg_replace('@<option><a href=@i', '<option value=', $link_html);
				$link_html = preg_replace('@</a></option>@i', '</option>', $link_html);
				if(strpos($link_html,$YEAR) !== false){
					$link_html = preg_replace('@<option@i', '<option selected', $link_html);
				}
			break;
		}
	}

  return $link_html;
}
add_filter('get_archives_link', 'my_archives_link');

/*-------------------------------------------------

	--> FORM

-------------------------------------------------*/

// パラメータの値を取得するショートコード
function get_param_val($atts2) {
  // デフォルトの配列
  $atts1 = array("name" => "");
  // デフォルトの配列に引数で受け取った配列をマージ
  extract(shortcode_atts($atts1, $atts2));

  // パラメータの値を取得
  $val = (isset($_GET[$name]) && $_GET[$name] != "") ? $_GET[$name] : "";
  $val = htmlspecialchars($val, ENT_QUOTES); // エスケープ処理

  return $val; // $valを戻り値として設定（ショートコードの値となる）
}
add_shortcode("param", "get_param_val");

function my_acf_google_map_api( $api ){

	$api['key'] = 'AIzaSyAllctTKw_W7c83w1imUFoJQR8CMuiACrw';

	return $api;

}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


/*-------------------------------------------------

	--> magazine

-------------------------------------------------*/

function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];

if(empty($first_img)){ //Defines a default image
        $first_img = "/images/default.jpg";
    }
    return $first_img;
}



