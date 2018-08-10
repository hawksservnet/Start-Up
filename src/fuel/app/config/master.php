<?php
return array(
	"FUEL_ENV" => (\Fuel::$env == \Fuel::PRODUCTION)?
		'production':
		'development',
/******************************************
 * 共通
 ******************************************/
	/* サイト情報 */
	"HOME_URL"                 => "https://startuphub.tokyo/",
	"LOGIN_URL"                => "https://startuphub.tokyo/login",
	"HOME_DOMAIN"              => "startuphub.tokyo",
	"SERVICE_NAME"             => "Startup Hub Tokyo",
	"SERVICE_NAME_JP"          => "スタートアップハブ東京",
	/* 発信元メールアドレス */
	"SERVICE_MAIL_ADDRESS"     => "info@startuphub.tokyo",
	"EVENT_INFO_MAIL_ADDRESS"  => "event.info@startuphub.tokyo",
	"PREENTRE_MAIL_ADDRESS"  => "pre-entre@startuphub.tokyo",
	/* 送信先メールアドレス */
	"SERVICE_MAIL_DESTINATION" => (isset($_SERVER["HTTP_HOST"]) and strpos($_SERVER["HTTP_HOST"],'startuphub.tokyo') !== false)?
		"info@startuphub.tokyo":
		"info@startuphub.tokyo",
	"EVENT_INFO_MAIL_DESTINATION" => (isset($_SERVER["HTTP_HOST"]) and strpos($_SERVER["HTTP_HOST"],'startuphub.tokyo') !== false)?
		"event.info@startuphub.tokyo":
		"event.info@startuphub.tokyo",
	"PREENTRE_MAIL_DESTINATION" => (isset($_SERVER["HTTP_HOST"]) and strpos($_SERVER["HTTP_HOST"],'startuphub.tokyo') !== false)?
		"pre-entre@startuphub.tokyo":
		"pre-entre@startuphub.tokyo",
	/* CSVファイル名のプレフィックス */
	"EXPORT_FILE_PREFIX"       => 'Startup-Hub-Tokyo',

	/* 県名 */
	'PREFECTURE_CODES' => array("1" => "北海道", "2" => "青森県", "3" => "岩手県", "4" => "宮城県", "5" => "秋田県", "6" => "山形県", "7" => "福島県", "8" => "茨城県", "9" => "栃木県", "10" => "群馬県", "11" => "埼玉県", "12" => "千葉県", "13" => "東京都", "14" => "神奈川県", "15" => "新潟県", "16" => "富山県", "17" => "石川県", "18" => "福井県", "19" => "山梨県", "20" => "長野県", "21" => "岐阜県", "22" => "静岡県", "23" => "愛知県", "24" => "三重県", "25" => "滋賀県", "26" => "京都府", "27" => "大阪府", "28" => "兵庫県", "29" => "奈良県", "30" => "和歌山県", "31" => "鳥取県", "32" => "島根県", "33" => "岡山県", "34" => "広島県", "35" => "山口県", "36" => "徳島県", "37" => "香川県", "38" => "愛媛県", "39" => "高知県", "40" => "福岡県", "41" => "佐賀県", "42" => "長崎県", "43" => "熊本県", "44" => "大分県", "45" => "宮崎県", "46" => "鹿児島県", "47" => "沖縄県"),

/******************************************
 * ユーザー
 ******************************************/
	/* ユーザー権限 */
	'USER_GROUP' => array(
		1 => 'Startup Hub TOKYOメンバー会員',
		50 => 'イベントオーガナイザー',
		100 =>'Startup Hub TOKYO運営者'
	),
	/* 会員種別 */
	'USER_TYPES' => array(
		-1 => '利用禁止',
		1 => 'メンバー',
		2 => 'プレアントレメンバー',
		3 => 'プロジェクトメンバー',
		999 => 'その他'
	),
	/* 役職（フリーテキストに変更） */
	'POSITIONS' => array(1 => '1.社長', 2=>'2.部長', 3=>'3.課長', 4=>'4.なし'),
	/* 職業 */
	'JOBS' => array(40=> '1.会社役員', 1 => '2.会社員', 2=>'3.自営業', 3=>'4.公務員', 50 => '5.学生', 60 => '6.その他'),
	/* 起業への準備 */
	'PREPARATIONS' => array(1=>'している', 2=>'情報収集中', 0=>'していない'),
	/* 業態 */
	'BUSINESS_TYPES' => array(1 => '1.個人事業主', 2=>'2.有限会社', 3=>'3.株式会社', 9=>'4.その他'),
	/* 業種（フリーテキストに変更） */
	'INDUSTRIES' => array(1 => '1.製造業', 2=>'2.サービス業', 3=>'3.運送業'),

/******************************************
 * イベント申請
 ******************************************/
	/* 申請ステータス｛仮｝ */
	/* 会員種別 */

	'REQUEST_STATUS' => array(
		Model_Event_Request::STATUS_REQUEST			=> '申請中', // 1 （使用しない）
		Model_Event_Request::STATUS_CANCEL_WAIT		=> 'キャンセル待ち', // 2
		Model_Event_Request::STATUS_RESERVED		=> '予約済み', // 11
		Model_Event_Request::STATUS_ACCEPTED		=> '受付済み', // 21
		Model_Event_Request::STATUS_PARTICIPATED	=> '参加済み', // 31
		Model_Event_Request::STATUS_ABSENTED		=> '不参加', // 41
		Model_Event_Request::STATUS_CANCEL			=> 'キャンセル', // 99
	),
	'REQUEST_STATUS_EFFECTIVE' => array(
		Model_Event_Request::STATUS_CANCEL_WAIT		=> 'キャンセル待ち', // 2
		Model_Event_Request::STATUS_RESERVED		=> '予約済み', // 11
		Model_Event_Request::STATUS_PARTICIPATED	=> '参加済み', // 31
		Model_Event_Request::STATUS_CANCEL			=> 'キャンセル', // 99
	),
/******************************************
 * プレアントレ
 ******************************************/
	'PREENTRE_INTENTION_OPTION' => array(
		1 => '起業すべきか迷っている',
		2 => '起業する事は決めたが、起業時期は未定である',
		3 => '起業する事を決め、1年以内に起業する予定',
		4 => '起業する事を決め、2～3年以内に起業する予定',
		5 => '個人事業主として起業済み',
		6 => '今の処　起業の意思は無い',
	),
	'PREENTRE_BUSINESS_OPTION' => array(
		1 => 'テック系ベンチャー（情報通信・IT・IoT・AI等）',
		2 => 'Webサービス（Webショップ、Webサービス、アプリ等）',
		3 => '飲食店・小売店',
		4 => 'ソーシャルビジネス（社会的課題起業）',
		5 => '農業・林業',
		6 => '在宅ワーク',
		7 => 'フランチャイズ',
		8 => 'その他',
	),
	'PREENTRE_BUSINESS_STYLE_OPTION' => array(
		1 => '個人事業主',
		2 => '個人事業主を法人化',
		3 => '合同会社（合資会社、合名会社）',
		4 => '株式会社',
		5 => 'NPO法人（特定非営利活動法人）',
		6 => '一般社団法人',
		7 => 'その他',
	),
	'PREENTRE_PROBLEM_OPTION' => array(
		'01' => '自分が起業に向いているか分からない',
		'02' => '自分が本当にやりたい事業が分からない',
		'03' => '自分の事業アイデアに自信がない／具体的な事業計画が定まらない',
		'04' => '起業について周囲の理解が得られない',
		'05' => '起業メンバーが集まらない',

		'06' => 'エンジニア（IT系）',
		'07' => 'エンジニア（IT系以外）',
		'08' => '営業',
		'09' => '経理・財務',
		'10' => '社長・経営者',
		'11' => 'その他',

		'12' => '立ち上げ資金の目途がつかない／資金調達について教えてほしい',
		'13' => '立ち上げ時の顧客の目途がつかない',
		'14' => '用地・店舗物件が見つからない',
		'15' => '創業助成金、創業融資などを受けたいが良くわからない（教えてほしい）',
		'16' => '事業計画書の作り方が解らない',
		'17' => '創業に伴う手続き・届け出が良く解らない',
		'18' => '経理について教えてほしい（帳簿の作成、決算処理、確定申告、等）',
		'19' => '税金について教えてほしい',
		'20' => '従業員採用の仕方、留意点など教えてほしい',
		'21' => '労働保険、社会保険、厚生年金について（手続きについて）教えてほしい',
		'22' => 'その他',

		'99' => '特になし'
	),
	'PREENTRE_WISH_OPTION' => array(
		'01' => '起業ノウハウ系のセミナー・イベント',
		'02' => '起業仲間との出会い／コミュニティ',
		'03' => '顧客・取引先とのマッチング／交流',
		'04' => '投資家とのマッチング／交流',
		'05' => '専門家相談（社労士、税理士、弁護士等）',
		'06' => '金融機関（銀行・政策金融公庫・信用保証協会等）相談',
		'07' => 'プレゼンテーション機会の提供',
		'08' => 'ビジネスプランコンテストの開催',
	),
	'PREENTRE_REQUEST_STATUS' => array(
		1 => '申請中',
		11 => '承認済み',
		21 => '非承認連絡済み',
		31 => '更新'
	),
	/* 月 */
	'MONTHS' => array(
		'01' => '1月',
		'02' => '2月',
		'03' => '3月',
		'04' => '4月',
		'05' => '5月',
		'06' => '6月',
		'07' => '7月',
		'08' => '8月',
		'09' => '9月',
		'10' => '10月',
		'11' => '11月',
		'12' => '12月',
	),
    'APPROVAL_STATUS' => array(
        0 => '承認まち',
        1 => '承認',
        2 => '非承認'
    ),
    'INTERVIEW_TYPE' => array(
        Model_Interview_Item::INTERVIEW_TEXT => 'テキスト',
        Model_Interview_Item::INTERVIEW_RADIO => 'ラジオボタン',
        Model_Interview_Item::INTERVIEW_CHECKBOX => 'チェックボックス',
        Model_Interview_Item::INTERVIEW_TEXTAREA => 'テキストエリア',
    ),
);
