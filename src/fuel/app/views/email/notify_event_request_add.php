<?= $user->getName() ?> 様

この度は「<?= $event->title ?>」への参加お申込み、誠にありがとうございます。
以下の通り参加申し込みを受け付けました。

----イベント情報----
<?= $event->title ?>

イベントページURL: <?= $event->wp_url ?>

----お申込み者情報----
お名前: <?= $user->getName() ?>

ふりがな:<?= $user->getHiraganaName() ?>

メールアドレス:<?= $user->email ?>

電話番号:<?= $user->tel ?>

生年月:<?= $user->getBirthday() ?>

性別:<?= $user->getSex() ?>

国籍:<?= $user->nationality ?>

現住所郵便番号:<?= $user->zip ?>

現住所:<?= $user->getPref() . $user->city ?>

所属組織名:<?= $user->organization ?>

役職:<?= $user->position ?>

起業への興味:<?= $user->interest?'あり':'なし' ?>

起業準備:<?= $user->getPreparation() ?>

DMによる案内:<?= $user->mailmagazine_info?'受け取る':'受け取らない' ?>


※本メールにお心当たりのない方は、お手数ですが、削除していただけますようお願い申し上げます。

<?= View::forge('email/_sender') ?>
