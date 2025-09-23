<?php
add_theme_support('post-thumbnails');

//-------------------------------------------//
// 　現在のページ名取得
//-------------------------------------------//
// add_action( 'after_setup_theme',function(){
//     global $basename;
//     $basename = basename( $_SERVER['REQUEST_URI'] );
//     $basename = $basename == '' ? 'top' : $basename;
// });


//-------------------------------------------//
// 　不要なメタタグ非表示
//-------------------------------------------//
// WordPressのバージョンを非表示にする
remove_action('wp_head', 'wp_generator');

// 前の文書と次の文書へのリンクを非表示にする
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

// リモート投稿をする時に使うタグを非表示にする
remove_action('wp_head', 'rsd_link');

// リモート投稿をする時に使うタグを非表示にする
remove_action('wp_head', 'wlwmanifest_link');

// WordPressの投稿IDを使った短いURLを非表示にする
remove_action('wp_head', 'wp_shortlink_wp_head');

//簡単に引用表示に使うを非表示にするタグをを非表示にする
remove_action('wp_head', 'rest_output_link_wp_head');

//簡単に引用表示に使うを非表示にするタグをを非表示にする
remove_action('wp_head', 'wp_oembed_add_discovery_links');

//絵文字用のコードを非表示にする
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

// ページネーション rel="index" 削除
remove_action('wp_head', 'index_rel_link');

//フィードタグ
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);

//旧エディタに戻すコード
// add_filter('use_block_editor_for_post', '__return_false');


//-------------------------------------------//
// 　バージョンアップ通知を非表示
//-------------------------------------------//
// ダッシュボードのWPバージョン更新メッセージ非表示
function update_nag_hide() {
    remove_action( 'admin_notices', 'update_nag', 3 );
    remove_action( 'admin_notices', 'maintenance_nag', 10 );
}
add_action( 'admin_init', 'update_nag_hide' );

// PHPバージョン警告消去(CSS)
function my_admin_style() {
    echo '<style>
    #dashboard_php_nag{display:none;}
    </style>'.PHP_EOL;
}
add_action('admin_print_styles', 'my_admin_style');

// サイドメニュー更新バッジアイコン非表示
function remove_menus() {
remove_submenu_page('index.php','update-core.php');//ダッシュボード>更新
}
add_action('admin_menu','remove_menus');


//-------------------------------------------//
// 　パーマリンク英語表示
//-------------------------------------------//
function auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
    if ( preg_match( '/(%[0-9a-f]{2})+/', $slug ) ) {
        $slug = utf8_uri_encode( $post_type ) . '-' . $post_ID;
    }
    return $slug;
}
add_filter( 'wp_unique_post_slug', 'auto_post_slug', 10, 4  );


//-------------------------------------------//
// 　カスタムフィールドもプレビューできるように
//-------------------------------------------//
function get_preview_id($postId) {
    global $post;
    $previewId = 0;
    if ( isset($_GET['preview'])
            && ($post->ID == $postId)
                && $_GET['preview'] == true
                    &&  ($postId == url_to_postid($_SERVER['REQUEST_URI']))
        ) {
        $preview = wp_get_post_autosave($postId);
        if ($preview != false) { $previewId = $preview->ID; }
    }
    return $previewId;
}

add_filter('get_post_metadata', function($meta_value, $post_id, $meta_key, $single) {
    if ($preview_id = get_preview_id($post_id)) {
        if ($post_id != $preview_id) {
            $meta_value = get_post_meta($preview_id, $meta_key, $single);
        }
    }
    return $meta_value;
}, 10, 4);

add_action('wp_insert_post', function ($postId) {
    global $wpdb;
    if (wp_is_post_revision($postId)) {
        if (isset($_POST['fields']) && count($_POST['fields']) != 0) {
            foreach ($_POST['fields'] as $key => $value) {
                $field = get_field($key);
                if ( !isset($field['name']) || !isset($field['key']) ) continue;
                if (count(get_metadata('post', $postId, $field['name'], $value)) != 0) {
                    update_metadata('post', $postId, $field['name'], $value);
                    update_metadata('post', $postId, "_" . $field['name'], $field['key']);
                } else {
                    add_metadata('post', $postId, $field['name'], $value);
                    add_metadata('post', $postId, "_" . $field['name'], $field['key']);
                }
            }
        }
        do_action('save_preview_postmeta', $postId);
    }
});


//-------------------------------------------//
// 　カスタム投稿タイプの記事編集画面にメタボックス（作成者変更）を表示する
//-------------------------------------------//
// admin_menu アクションフックでカスタムボックスを定義 //
add_action('admin_menu', 'myplugin_add_custom_box');

// 投稿ページの "advanced" 画面にカスタムセクションを追加 //
function myplugin_add_custom_box()
{
    if (function_exists('add_meta_box')) {
        add_meta_box('myplugin_sectionid', __('作成者', 'myplugin_textdomain'), 'post_author_meta_box', 'voice', 'advanced');
    }
}


//-------------------------------------------------------------------------//
// 投稿ページ設定
//-------------------------------------------------------------------------//
function post_has_archive( $args, $post_type ) {
	if ( 'post' == $post_type ) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'map';
	}
	return $args;
}
add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );


//-------------------------------------------------------------------------//
// Bogoの言語スイッチャーの表記を変更
//-------------------------------------------------------------------------//
add_filter( 'bogo_use_flags', 'bogo_delete_flags' );
function bogo_delete_flags(){
  return false;
}

add_filter('bogo_language_switcher_links', function ($links) {
    for ($i = 0; $i < count($links); $i++) {
        if ('ja' === $links[$i]['locale']) {
            $links[$i]['title'] = 'JA';
            $links[$i]['native_name'] = 'JA';
        }
        if ('en_US' === $links[$i]['locale']) {
            $links[$i]['title'] = 'EN';
            $links[$i]['native_name'] = 'EN';
        }
    }
    return $links;
});


//-------------------------------------------------------------------------//
// Support custom post type with bogo.
//-------------------------------------------------------------------------//
// function my_localizable_post_types( $localizable ) {
// 	$args = array(
// 		'public'   => true,
// 		'_builtin' => false
// 	);
// 	$custom_post_types = get_post_types( $args );
// 	return array_merge( $localizable, $custom_post_types );
// }
// add_filter( 'bogo_localizable_post_types', 'my_localizable_post_types', 10, 1 );

function my_localizable_post_types( $localizable ) {
    $custom_post_types = array('map','pickup','poster');
    return array_merge($localizable,$custom_post_types);
}
add_filter( 'bogo_localizable_post_types', 'my_localizable_post_types', 10, 1 );

// function myUrlRewrite($rules){
//     $myRule = array();
//     $myRule["^en/map/([^/]*)/?$"] = 'index.php?taxonomy=map-area&tags=$matches[1]&lang=en';
//     return array_merge( $myRule, $rules );
// }
// add_action('rewrite_rules_array', 'myUrlRewrite' );

//-------------------------------------------------------------------------//
// Enqueue styles.
//-------------------------------------------------------------------------//
function add_stylesheet() {
    if ($_SERVER['SERVER_NAME'] === 'localhost') {
        $link = 'http://localhost:3000';
    } elseif ($_SERVER['SERVER_NAME'] === 'biban.testsite.help') {
        $link = 'https://biban.testsite.help';
    } else {
		        $link = 'https://biban.jp';
        // $link = $_SERVER['HTTP_HOST'];
    }

    wp_enqueue_style(
        'default',
        $link.'/assets/css/common.css',
        array(),
        '1.0',
        false // headタグ内に出力
    );
    if ( is_home() || is_front_page() ) {
        wp_enqueue_style(
            'front',
            $link.'/assets/css/front.css',
            array(),
            '1.0',
            false // headタグ内に出力
        );
    } elseif ( is_page('about') ) {
        wp_enqueue_style(
            'map',
            $link.'/assets/css/about.css',
            array(),
            '1.0',
            false // headタグ内に出力
        );
    } elseif ( is_singular( 'pickup' ) ) {
        wp_enqueue_style(
            'pickup',
            $link.'/assets/css/pickup.css',
            array(),
            '1.0',
            false // headタグ内に出力
        );
        wp_enqueue_style(
            'style',
            $link.'/assets/css/style.css',
            array(),
            '1.0',
            false // headタグ内に出力
        );
    } elseif ( is_archive() || is_category()  ) {
        wp_enqueue_style(
            'map',
            $link.'/assets/css/map.css',
            array(),
            '1.0',
            false // headタグ内に出力
        );
    } elseif ( is_single() ) {
        wp_enqueue_style(
            'map-detail',
            $link.'/assets/css/map-detail.css',
            array(),
            '1.0',
            false // headタグ内に出力
        );
        wp_enqueue_style(
            'style',
            $link.'/assets/css/style.css',
            array(),
            '1.0',
            false // headタグ内に出力
        );
    } else {
        wp_enqueue_style(
            'style',
            $link.'/assets/css/style.css',
            array(),
            '1.0',
            false // headタグ内に出力
        );
    }
}
add_action('wp_enqueue_scripts', 'add_stylesheet');

//-------------------------------------------------------------------------//
// Enqueue scripts.
//-------------------------------------------------------------------------//
function add_script(){
    if ($_SERVER['SERVER_NAME'] === 'localhost') {
        $link = 'http://localhost:3000';
    } elseif ($_SERVER['SERVER_NAME'] === 'biban.testsite.help') {
        $link = 'https://biban.testsite.help';
    } else {
        // $link = $_SERVER['HTTP_HOST'];
        $link = 'https://biban.jp';
    }

    if ( is_home() || is_front_page() ) {
        wp_enqueue_script(
            'front',
            $link.'/assets/js/front.js',
            array(),
            '1.0',
            true // trueでbody閉じタグ前に出力
        );
    } else {
        wp_enqueue_script(
            'default',
            $link.'/assets/js/script.js',
            array(),
            '1.0',
            true // trueでbody閉じタグ前に出力
        );
    }
}
add_action('wp_enqueue_scripts','add_script');


//-------------------------------------------//
//  カスタム画像サイズ定義
//-------------------------------------------//
// function add_custom_image_sizes()
// {
//     global $my_custom_image_sizes;
//     $my_custom_image_sizes = array(
//         'news_thumb' => array(
//             'name'       => 'news_thumb', // 選択肢のラベル名
//             'width'      => 485,    // 最大画像幅をpxで設定
//             'height'     => 485,    // 最大画像高さをpxで設定
//             'crop'       => true,  // 切り抜きを行うならtrue, 行わないならfalse
//             'selectable' => true   // 選択肢に含めるならtrue, 含めないならfalse
//         )
//     );
//     foreach ($my_custom_image_sizes as $slug => $size) {
//         add_image_size($slug, $size['width'], $size['height'], $size['crop']);
//     }
// }
// add_action('after_setup_theme', 'add_custom_image_sizes');

function add_custom_image_size_select( $size_names ) {
    global $my_custom_image_sizes;
    $custom_sizes = get_intermediate_image_sizes();
    foreach ( $custom_sizes as $custom_size ) {
    if ( isset( $my_custom_image_sizes[$custom_size]['selectable'] ) && $my_custom_image_sizes[$custom_size]['selectable'] ) {
    $size_names[$custom_size] = $my_custom_image_sizes[$custom_size]['name'];
    }
    }
    return $size_names;
    }
add_filter( 'image_size_names_choose', 'add_custom_image_size_select' );


// ---------------------------------------------------------------------------
// 　ページネーション
// --------------------------------------------------------------------------- //
// *
// * ページネーション出力関数
// * $paged : 現在のページ
// * $pages : 全ページ数
// * $range : 左右に何ページ表示するか
// * $show_only : 1ページしかない時に表示するかどうか

function pagination( $pages, $paged, $range = 2, $show_only = false ) {

    $pages = ( int ) $pages;    //float型で渡ってくるので明示的に int型 へ
    $paged = $paged ?: 1;       //get_query_var('paged')をそのまま投げても大丈夫なように

    //表示テキスト
    $text_first   = "最初へ";
    $text_before  = "Prev";
    $text_next    = "Next";
    $text_last    = "最後へ";

    if ( $show_only && $pages === 1 ) {
        // １ページのみで表示設定が true の時
        echo '<div class="wp-pagenavi"><div class="pagination"><span class="current pager">1</span></div></div>';
        return;
    }

    if ( $pages === 1 ) return;    // １ページのみで表示設定もない場合

    if ( 1 !== $pages ) {
        //２ページ以上の時
        echo '<div class="wp-pagenavi"><div class="pagination">';
        // echo '<span class="page_num">Page ', $paged ,' of ', $pages ,'</span>';
        // if ( $paged > $range + 1 ) {
        //     // 「最初へ」 の表示
        //     echo '<a href="', get_pagenum_link(1) ,'" class="first">', $text_first ,'</a>';
        // }
        if ( $paged > 1 ) {
            // 「前へ」 の表示
            echo '<a href="', get_pagenum_link( $paged - 1 ) ,'" class="prev pagination-btn"><i class="btn-arw"></i></a>';
        }
        for ( $i = 1; $i <= $pages; $i++ ) {

            if ( $i <= $paged + $range && $i >= $paged - $range ) {
                // $paged +- $range 以内であればページ番号を出力
                if ( $paged === $i ) {
                    echo '<span class="current pager">', $i ,'</span>';
                } else {
                    echo '<a href="', get_pagenum_link( $i ) ,'" class="pager">', $i ,'</a>';
                }
            }

        }
        if ( $paged < $pages ) {
            // 「次へ」 の表示
            echo '<a href="', get_pagenum_link( $paged + 1 ) ,'" class="next pagination-btn"><i class="btn-arw"></i></a>';
        }
        // if ( $paged + $range < $pages ) {
        //     // 「最後へ」 の表示
        //     echo '<a href="', get_pagenum_link( $pages ) ,'" class="last">', $text_last ,'</a>';
        // }
        echo '</div></div>';
    }
}


//-------------------------------------------//
// 　ACFオプションページ定義
//-------------------------------------------//

if( function_exists('acf_add_options_page') ) {
    // acf_add_options_page(array(
    //     'page_title' => '製品事例',
    //     'menu_title' => '製品事例',
    //     'menu_slug' => 'product-set',
    //     'post_id' => 'options',
    //     'icon_url' => 'dashicons-list-view',
    //     'capability' => 'edit_posts',
    //     'position' => 21,
    //     'redirect' => false,
    // ));

    acf_add_options_page(array(
        'page_title' => 'ヘッダーメニュー',
        'menu_title' => 'ヘッダーメニュー',
        'menu_slug' => 'header-navigation',
        'post_id' => 'options',
        'icon_url' => 'dashicons-menu',
        'capability' => 'edit_posts',
        'position' => 23,
        'redirect' => false,
    ));

    acf_add_options_page(array(
        'page_title' => 'フッターメニュー',
        'menu_title' => 'フッターメニュー',
        'menu_slug' => 'footer-navigation',
        'post_id' => 'options',
        'icon_url' => 'dashicons-menu',
        'capability' => 'edit_posts',
        'position' => 24,
        'redirect' => false,
    ));

    // acf_add_options_page(array(
    //     'page_title' => '投稿者',
    //     'menu_title' => '投稿者',
    //     'menu_slug' => 'poster',
    //     'post_id' => 'options',
    //     'icon_url' => 'dashicons-menu',
    //     'capability' => 'edit_posts',
    //     'position' => 25,
    //     'redirect' => false,
    // ));
}


// ---------------------------------------------------------------------------
// 　編集者の権限を設定
// --------------------------------------------------------------------------- //
$role = get_role('editor');
$role->add_cap('manage_options');

function remove_admin_setting_menus_editor_role()
{
    // remove_menu_page('edit.php'); // デフォルトの「投稿」を非表示
    // remove_menu_page('edit.php?post_type=page'); // デフォルトの「固定ページ」を非表示
    remove_menu_page('edit-comments.php');          // コメント

    if (current_user_can('editor')) {
    remove_menu_page('themes.php');                 // 外観
    remove_menu_page('plugins.php');                // プラグイン
    remove_menu_page('users.php');                  // ユーザー
    remove_menu_page('tools.php'); // ツール
    remove_menu_page('edit.php?post_type=acf-field-group');          // ACF
    remove_menu_page('options-general.php'); // 投稿設定を非表示

    remove_submenu_page('options-general.php', 'options-writing.php'); // 投稿設定を非表示
    remove_submenu_page('options-general.php', 'options-reading.php'); // 表示設定を非表示
    remove_submenu_page('options-general.php', 'options-discussion.php'); // ディスカッション設定を非表示
    remove_submenu_page('options-general.php', 'options-media.php'); // メディア設定を非表示
    remove_submenu_page('options-general.php', 'options-permalink.php'); // パーマリンク設定を非表示
    remove_submenu_page('options-general.php', 'privacy.php'); // プライバシー設定を非表示
    // 上記コードで非表示になるがURLを知っていればアクセス可能なのでリダイレクトさせる
    global $pagenow;
    if (in_array($pagenow, array(

        'edit-comments.php',
        'themes.php',
        'plugins.php',
        'users.php',
        'tools.php',
        'edit.php?post_type=acf-field-group',
        'options-writing.php',
        'options-reading.php',
        'options-discussion.php',
        'options-media.php',
        'options-permalink.php',
    )))
        wp_redirect('index.php');
    }
}
add_action('admin_menu', 'remove_admin_setting_menus_editor_role');


//-------------------------------------------------------------------------//
// snow monkey forms フック
//-------------------------------------------------------------------------//
// add_filter(
// 	'snow_monkey_forms/control/attributes',
// 	function( $attributes, $setting ) {
//         if ( isset( $attributes['name'] ) && 'form_section' === $attributes['name'] ) {
//             $post_id = filter_input( INPUT_GET, 'request_doc' );
//             if ( ! is_null( $post_id ) ) {
//                 $attributes['values'] = [ '資料ダウンロード' ];
//             }
//         }
//         return $attributes;
// 	},
//     10,
//     2
// );

// add_filter('gettext_with_context_snow-monkey-forms', 'change_read_more_translation', 10, 4);
// function change_read_more_translation($translation, $text, $context, $domain) {
// if ($text === 'Input' && $context === 'progress-tracker') {
//     $translation = 'Fill Out Contact Form';
// }
// if ($text === 'Confirm' && $context === 'progress-tracker') {
//     $translation = 'Confirm Information';
// }
// if ($text === 'Complete' && $context === 'progress-tracker') {
//     $translation = 'Send Message';
// }
// return $translation;
// }

// add_filter(
// 	'snow_monkey_forms/validator/error_message',
// 	function( $error_message, $validation_name, $name ) {
// 		if ( 'required' === $validation_name && 'form_name' === $name ) {
// 			return 'This item is required';
// 		}
// 		if ( 'required' === $validation_name && 'form_mail' === $name ) {
// 			return 'This item is required';
// 		}
//         if ( 'required' === $validation_name && 'form_agree' === $name ) {
// 			return 'This item is required';
// 		}
// 		return $error_message;
// 	},
// 	10,
// 	3
// );



//-------------------------------------------------------------------------//
// カスタムブロックパターンの登録
//-------------------------------------------------------------------------//
if ( function_exists( 'register_block_pattern_category' ) ) {
    function my_register_pattern_category() {
        register_block_pattern_category(
            'original-section',
            array(
                'label' => __( 'セクション', 'my-plugin-text-domain' ),
                'description' => __( 'コンテンツの分割' ),
            )
        );
    }
    add_action( 'init', 'my_register_pattern_category' );
}

if ( function_exists( 'register_block_pattern' ) ) {
    function my_plugin_register_block_pattern() {
        register_block_pattern(
            'my-plugin/my-block-pattern',
            array(
                'title'			=> 'ノーマル',
                'categories'	=> array( 'original-section' ),
                'content'		=>
                '<!-- wp:group {"tagName":"section","className":"section-comp generic"} -->
                <section class="wp-block-group section-comp generic">
                <!-- wp:group {"className":"section-comp__inner"}  -->
                <div class="wp-block-group section-comp__inner">
                <!-- wp:heading -->
                <h2>Section type-normal</h2>
                <!-- /wp:heading -->
                <!-- wp:paragraph -->
                <p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry.</p>
                <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
                </section><!-- /wp:group -->',
            )
        );

        // register_block_pattern(
        //     'my-plugin/my-block-pattern01',
        //     array(
        //         'title'			=> '背景色(ホワイト全面)',
        //         'categories'	=> array( 'original-section' ),
        //         'content'		=>
        //         '<!-- wp:group {"tagName":"section","className":"section-comp generic bg-type02"} -->
        //         <section class="wp-block-group section-comp generic bg-type02">
        //         <!-- wp:group {"className":"section-comp__inner"}  -->
        //         <div class="wp-block-group section-comp__inner inview fade-up">
        //         <!-- wp:heading -->
        //         <h2>Section type-normal</h2>
        //         <!-- /wp:heading -->
        //         <!-- wp:paragraph -->
        //         <p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry.</p>
        //         <!-- /wp:paragraph -->
        //         </div>
        //         <!-- /wp:group -->
        //         </section><!-- /wp:group -->',
        //     )
        // );

        // register_block_pattern(
        //     'my-plugin/my-block-pattern02',
        //     array(
        //         'title'			=> '背景色(ホワイト右空き)',
        //         'categories'	=> array( 'original-section' ),
        //         'content'		=>
        //         '<!-- wp:group {"tagName":"section","className":"section-comp generic bg-type03"} -->
        //         <section class="wp-block-group section-comp generic bg-type03">
        //         <!-- wp:group {"className":"section-comp__inner"}  -->
        //         <div class="wp-block-group section-comp__inner inview fade-up">
        //         <!-- wp:heading -->
        //         <h2>Section type-normal</h2>
        //         <!-- /wp:heading -->
        //         <!-- wp:paragraph -->
        //         <p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry.</p>
        //         <!-- /wp:paragraph -->
        //         </div>
        //         <!-- /wp:group -->
        //         </section><!-- /wp:group -->',
        //     )
        // );

        // register_block_pattern(
        //     'my-plugin/my-block-pattern03',
        //     array(
        //         'title'			=> '背景色(ホワイト左空き)',
        //         'categories'	=> array( 'original-section' ),
        //         'content'		=>
        //         '<!-- wp:group {"tagName":"section","className":"section-comp generic bg-type04"} -->
        //         <section class="wp-block-group section-comp generic bg-type04">
        //         <!-- wp:group {"className":"section-comp__inner"}  -->
        //         <div class="wp-block-group section-comp__inner inview fade-up">
        //         <!-- wp:heading -->
        //         <h2>Section type-normal</h2>
        //         <!-- /wp:heading -->
        //         <!-- wp:paragraph -->
        //         <p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry.</p>
        //         <!-- /wp:paragraph -->
        //         </div>
        //         <!-- /wp:group -->
        //         </section><!-- /wp:group -->',
        //     )
        // );

        // register_block_pattern(
        //     'my-plugin/my-block-pattern04',
        //     array(
        //         'title'			=> '背景色(ベージュ全面)',
        //         'categories'	=> array( 'original-section' ),
        //         'content'		=>
        //         '<!-- wp:group {"tagName":"section","className":"section-comp generic bg-type05"} -->
        //         <section class="wp-block-group section-comp generic bg-type05">
        //         <!-- wp:group {"className":"section-comp__inner"}  -->
        //         <div class="wp-block-group section-comp__inner inview fade-up">
        //         <!-- wp:heading -->
        //         <h2>Section type-normal</h2>
        //         <!-- /wp:heading -->
        //         <!-- wp:paragraph -->
        //         <p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry.</p>
        //         <!-- /wp:paragraph -->
        //         </div>
        //         <!-- /wp:group -->
        //         </section><!-- /wp:group -->',
        //     )
        // );

        register_block_pattern(
            'my-plugin/my-block-pattern05',
            array(
                'title'			=> '見出し（画面幅いっぱい）',
                // 'categories'	=> array( 'Heading' ),
                'content'		=>
                '<!-- wp:heading -->
                <h2 class="wp-block-heading full-window">タイトルが入りますタイトルが入ります</h2>
                <!-- /wp:heading -->',
            )
        );

        register_block_pattern(
            'my-plugin/my-block-pattern06',
            array(
                'title'			=> 'ボックス（ボーダー）',
                // 'categories'	=> array( 'Heading' ),
                'content'		=>
                '<!-- wp:group {"className":"section-comp__block type-border"}  -->
                <div class="wp-block-group section-comp__block type-border">
                <!-- wp:heading {"level":3} -->
                <h3>タイトルが入りますタイトルが入ります</h3>
                <!-- /wp:heading -->
                <!-- wp:paragraph -->
                <p>テキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入ります。</p>
                <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->',
            )
        );

        register_block_pattern(
            'my-plugin/my-block-pattern07',
            array(
                'title'			=> 'ボックス（背景色）',
                // 'categories'	=> array( 'Heading' ),
                'content'		=>
                '<!-- wp:group {"className":"section-comp__block type-color"}  -->
                <div class="wp-block-group section-comp__block type-color">
                <!-- wp:heading {"level":3} -->
                <h3>タイトルが入りますタイトルが入ります</h3>
                <!-- /wp:heading -->
                <!-- wp:paragraph -->
                <p>テキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入りますテキストが入ります。</p>
                <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->',
            )
        );

        register_block_pattern(
            'my-plugin/my-block-pattern08',
            array(
                'title'			=> '画像（画面幅いっぱい）',
                // 'categories'	=> array( 'Heading' ),
                'content'		=>
                '<!-- wp:image -->
                <figure class="wp-block-image full-window js-animate"><img alt=""/></figure>
                <!-- /wp:image -->',
            )
        );
    }
    add_action( 'init', 'my_plugin_register_block_pattern' );
}


//-------------------------------------------------------------------------//
// ACFでカスタムブロックの登録
//-------------------------------------------------------------------------//
add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        //アコーディオン
        acf_register_block_type(array(
            'name'              => 'accordionset',
            'title'             => __('アコーディオン'),
            'description'       => __('アコーディオンを設定できます。'),
            'render_template'   => '_functions/block/tpl/accordionset.php',
            'category'        => 'text',
            'icon'            => 'plus',
            'keywords'        => array( 'アコーディオン','faq' ),
            'mode'              => 'auto',
            'supports'          => array(
                'align' => false,
                'mode' => true,
                'jsx' => true
            ),
        ));

        //ボタン
        acf_register_block_type(array(
            'name'              => 'buttonset',
            'title'             => __('ボタンセット'),
            'description'       => __('ボタンを設定できます。'),
            'render_template'   => '_functions/block/tpl/buttonset.php',
            'category'        => 'text',
            'icon'            => 'button',
            'keywords'        => array( 'ボタン','ボタンセンター' ),
            'mode'              => 'auto',
            'supports'          => array(
                'align' => false,
                'mode' => true,
                'jsx' => true
            ),
        ));
    }
}


//-------------------------------------------------------------------------//
// ブロックスタイル制御 js
//-------------------------------------------------------------------------//
add_action( 'enqueue_block_editor_assets', function(){
    $js_uri = get_template_directory_uri() . "/_functions/block/js/unregister.js";
    $js_path = get_template_directory() . "/_functions/block/js/unregister.js";
    wp_enqueue_script(
        "unregister-js",
        $js_uri,
        [ 'wp-rich-text', 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ],
        filemtime($js_path)
    );
});


//-------------------------------------------------------------------------//
// Gutenberg用のCSSを読み込む
//-------------------------------------------------------------------------//
function add_block_editor_styles() {
    wp_enqueue_style( 'editor-styles', site_url() . '/wp-content/themes/original/editor-style.css' );
    // wp_enqueue_style( 'editor-styles', home_url() . '/assets/css/style.css' );
}
add_action( 'enqueue_block_editor_assets', 'add_block_editor_styles' );


//-------------------------------------------------------------------------//
// ACF GoogleMap
//-------------------------------------------------------------------------//
function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyC9Zit_uAP1eunJuw96zSNwSvWkOEfrySs';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

?>