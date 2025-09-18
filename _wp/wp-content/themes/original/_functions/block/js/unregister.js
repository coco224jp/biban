wp.domReady(function () {
  window.setTimeout(function () {
    var editorStylesWrapper = document.querySelector('.is-root-container');
    if (editorStylesWrapper) {
      editorStylesWrapper.classList.add('editor');
    }
  }, 1000);

  // =========================================================
  // unregisterBlockType 不要なブロックス削除 php で対応済み
  // =========================================================

  //ブロックリスト
  wp.blocks.getBlockTypes().forEach(function (blockType) {
    console.log(blockType.name);
  });

  wp.blocks.unregisterBlockType('core/details'); // 詳細
  wp.blocks.unregisterBlockType('tadv/classic-paragraph'); // クラシック段落
  wp.blocks.unregisterBlockType('core/footnotes'); // 脚注

  // テキスト
  //wp.blocks.unregisterBlockType('core/paragraph');    // 段落
  //wp.blocks.unregisterBlockType('core/heading');      // 見出し
  //wp.blocks.unregisterBlockType('core/list');         // リスト
  wp.blocks.unregisterBlockType('core/quote'); // 引用
  wp.blocks.unregisterBlockType('core/code'); // コード
  wp.blocks.unregisterBlockType('core/freeform'); // クラシック
  wp.blocks.unregisterBlockType('core/preformatted'); // 整形済み
  wp.blocks.unregisterBlockType('core/pullquote'); // プルクオート
  // wp.blocks.unregisterBlockType('core/table'); // テーブル
  wp.blocks.unregisterBlockType('core/verse'); // 詩

  // メディア
  //wp.blocks.unregisterBlockType('core/image');       // 画像
  wp.blocks.unregisterBlockType('core/gallery'); // ギャラリー
  wp.blocks.unregisterBlockType('core/audio'); // 音声
  // wp.blocks.unregisterBlockType('core/cover'); // カバー
  // wp.blocks.unregisterBlockType('core/file'); // ファイル
  // wp.blocks.unregisterBlockType('core/media-text'); // メディアとテキスト
  // wp.blocks.unregisterBlockType('core/video');      // 動画

  // デザイン
  // wp.blocks.unregisterBlockType('core/buttons'); // ボタン
  // wp.blocks.unregisterBlockType('core/columns');     // カラム
  // wp.blocks.unregisterBlockType('core/group');       // グループ
  // wp.blocks.unregisterBlockType('core/more'); // 続き
  // wp.blocks.unregisterBlockType('core/nextpage'); // ページ区切り
  // wp.blocks.unregisterBlockType('core/separator'); // 区切り
  // wp.blocks.unregisterBlockType('core/spacer'); // スペーサー
  // wp.blocks.unregisterBlockType('core/site-logo'); // サイトロゴ
  // wp.blocks.unregisterBlockType('core/site-tagline'); // サイトのキャッチフレーズ
  // wp.blocks.unregisterBlockType('core/site-title'); // サイトのタイトル
  // wp.blocks.unregisterBlockType('core/query-title'); // アーカイブタイトル
  // wp.blocks.unregisterBlockType('core/post-terms'); // 投稿カテゴリー, 投稿タグ

  // ウィジェット
  wp.blocks.unregisterBlockType('core/shortcode'); // ショートコード
  wp.blocks.unregisterBlockType('core/archives'); // アーカイブ
  wp.blocks.unregisterBlockType('core/calendar'); // カレンダー
  wp.blocks.unregisterBlockType('core/categories'); // カテゴリー
  // wp.blocks.unregisterBlockType('core/html'); // カスタムHTML
  wp.blocks.unregisterBlockType('core/latest-comments'); // 最新のコメント
  wp.blocks.unregisterBlockType('core/latest-posts'); // 最新の投稿
  wp.blocks.unregisterBlockType('core/page-list'); // 固定ページリスト
  wp.blocks.unregisterBlockType('core/rss'); // RSS
  // wp.blocks.unregisterBlockType('core/social-links'); // ソーシャルアイコン
  wp.blocks.unregisterBlockType('core/tag-cloud'); // タグクラウド
  wp.blocks.unregisterBlockType('core/search'); // 検索

  // テーマ
  // wp.blocks.unregisterBlockType('core/query'); // クエリーループ, 投稿一覧
  wp.blocks.unregisterBlockType('core/post-title'); // 投稿タイトル
  wp.blocks.unregisterBlockType('core/post-content'); // 投稿コンテンツ
  wp.blocks.unregisterBlockType('core/post-date'); // 投稿日
  wp.blocks.unregisterBlockType('core/post-excerpt'); // 投稿の抜粋
  wp.blocks.unregisterBlockType('core/post-featured-image'); // 投稿のアイキャッチ画像
  wp.blocks.unregisterBlockType('core/loginout'); // ログイン/ログアウト

  // 埋め込み
  // wp.blocks.unregisterBlockType('core/embed');

  // その他
  // wp.blocks.unregisterBlockType('core/navigation');
  wp.blocks.unregisterBlockType('core/avatar');
  wp.blocks.unregisterBlockType('core/post-author');
  wp.blocks.unregisterBlockType('core/post-author-name');
  wp.blocks.unregisterBlockType('core/post-navigation-link');
  wp.blocks.unregisterBlockType('core/read-more');
  wp.blocks.unregisterBlockType('core/comments');
  wp.blocks.unregisterBlockType('core/post-comments-form');
  wp.blocks.unregisterBlockType('core/term-description');
  wp.blocks.unregisterBlockType('core/post-author-biography');

  // =========================================================
  // unregisterBlockStyle 不要なブロックスタイル削除
  // =========================================================

  // 引用（デフォルト）
  //wp.blocks.unregisterBlockStyle( 'core/quote', 'default' );

  // 引用（大）
  //wp.blocks.unregisterBlockStyle( 'core/quote', 'large' );

  // 画像（デフォルト）
  wp.blocks.unregisterBlockStyle('core/image', 'default');

  // 画像（角丸）
  wp.blocks.unregisterBlockStyle('core/image', 'rounded');

  // プルクオート（デフォルト）
  //wp.blocks.unregisterBlockStyle( 'core/pullquote', 'default' );

  // プルクオート（単色）
  //wp.blocks.unregisterBlockStyle( 'core/pullquote', 'solid-color' );

  // 表（デフォルト）
  //wp.blocks.unregisterBlockStyle( 'core/table', 'regular' );

  // 表（ストライプ）
  //wp.blocks.unregisterBlockStyle( 'core/table', 'stripes' );

  // ボタン（デフォルト）
  //wp.blocks.unregisterBlockStyle( 'core/button', 'fill' );

  // ボタン（ストライプ）
  //wp.blocks.unregisterBlockStyle( 'core/button', 'outline' );

  // 区切り（デフォルト）
  //wp.blocks.unregisterBlockStyle( 'core/separator', 'default' );

  // 区切り（幅広線）
  //wp.blocks.unregisterBlockStyle( 'core/separator', 'wide' );

  // 区切り（ドット）
  //wp.blocks.unregisterBlockStyle( 'core/separator', 'dots' );

  // =========================================================
  // unregisterFormatType 不要な書式の削除
  // =========================================================

  //太字
  //wp.richText.unregisterFormatType("core/bold");

  //イタリック
  wp.richText.unregisterFormatType('core/italic');

  //リンク
  //wp.richText.unregisterFormatType("core/link");

  //インラインコード
  wp.richText.unregisterFormatType('core/code');

  //インライン画像
  wp.richText.unregisterFormatType('core/image');

  //キーボード入力
  wp.richText.unregisterFormatType('core/keyboard');

  //上付き
  wp.richText.unregisterFormatType('core/superscript');

  //下付き
  wp.richText.unregisterFormatType('core/subscript');

  //下線
  wp.richText.unregisterFormatType('core/underline');

  //ハイライト
  wp.richText.unregisterFormatType('core/text-color');

  //打消し戦
  //wp.richText.unregisterFormatType("core/strikethrough");
});
