# cloud-translate-multilingual
## 前提条件
- Googleが提供しているTranslation APIを利用し、日本語から複数言語に変換するプログラム。
- フォームに変換元(日本語)の文章をセットし、ボタンクリックで変換を行いフォームへセットします。
- 利用にはAPIキーが必要となります。

## ディレクトリ構成
```
リポジトリTOP
│
├ index.html .. 変換元の文章の入力、変換後の文書をセットする
├ request_translate.php .. Translation APIに変換リクエストを実行するプログラム
```
## 動作概要
- index.htmlの、変換元テキストに日本語の文章を入力
- request_translate.phpにて複数言語に翻訳
- 変換された文章を、それぞれの言語フォームへセット

## 編集箇所
### /request_translate.php
12行目 APIキーの設定
```
define( 'CONST_API_KEY' , 'APIキー' );
```

## 編集箇所（オプショナル）
言語の追加、削除を行う場合は、以下の箇所を変更
### /request_translate.php
27行目〜32行目 言語リスト
```
$ary_languages = array(
  'en',	// 英語
  'zh-CN',	// 中国語（簡体）
  'zh-TW',	// 中国語（繁体）
  'ko'	// 韓国語
);
```
### /index.html
39行目以降 変換後のテキストをセットするフォーム  
id名をconversion_XXXとし、XXXには言語リストを設定する
```
<tr>
  <th>変換後テキスト<br>（英語）</th>
  <td><textarea name="conversion" id="conversion_en" cols="50" rows="5"></textarea></td>
</tr>
```

