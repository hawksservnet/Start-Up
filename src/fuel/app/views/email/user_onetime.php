<?= $name ?> 様

この度は<?= $service_name ?>にお申込みいただき、誠にありがとうございます。
お申込みいただきましたサービスの仮登録が完了いたしました。

サービスをご利用いただくには以下のURLから本登録をお願いいたします。

<?= $url ?>

･･･････････････････････････････････････････
※仮登録後、24時間以内に本登録していただかないと、リンクが無効となります。
その際は、再度仮登録のお手続きが必要となりますので、ご注意ください。
※本メールにお心当たりのない方は、お手数ですが、削除していただけますようお願い申し上げます。
※本メール配信元アドレスでのお問合せは受付しておりませんのでご注意ください。

<?= View::forge('email/_sender') ?>
