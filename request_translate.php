<?PHP
//********************************************************************
//* File name	request_translate.php
	define( 'CONST_TITLE' , 'request cloud translate' );
//*
//* Code author	K.mineoka<mineoka0222@gmail.com>
//* History		2018/08/08	create
//********************************************************************
	//----------------------------------------------------------------
	// プログラム定数
	//----------------------------------------------------------------
	define( 'CONST_API_KEY' , 'APIキー' );

	//----------------------------------------------------------------
	// Cloud Translate APIへリクエスト送信
	//----------------------------------------------------------------
	// 初期処理
	$ary_result = array();
	$base_url = "https://translation.googleapis.com/language/translate/v2";

	// header情報
	$header = array(
	  "Content-Type:application/x-www-form-urlencoded"
	);

	// 変換対象言語
	$ary_languages = array(
		'en',	// 英語
		'zh-CN',	// 中国語（簡体）
		'zh-TW',	// 中国語（繁体）
		'ko'	// 韓国語
	);

	// 言語数分リクエスト
	foreach ($ary_languages as $value) {
		// 送信クエリ
		$query = array(
			// "q" => "こんにちは"
			"q" => $_POST['text']
			,"target" => $value
			,"format" => "text"
			,"key" => CONST_API_KEY
		);

		$encode_query = http_build_query($query);

		// 送信リクエストURL
		$request_url = $base_url . "?" . $encode_query;

		$context = stream_context_create(array(
			"http" => array(
			     'method' => 'GET'
			    ,'header' => implode("\r\n",$header)
			)
		));
		$result = file_get_contents($request_url, false, $context);

		// JSONを配列変換し、返還後の文字列を返却
		$result_array = json_decode( $result , true );
		$result_tmp = $result_array["data"]["translations"][0]["translatedText"];

		// 変換結果を配列に格納
		$ary_result = array_merge($ary_result, array($value => $result_tmp));
	}

	// 返り値
	echo json_encode($ary_result);
?>
