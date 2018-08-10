<?= $user->getName() ?> 様

いつもStartup Hub Tokyoをご利用いただき、誠にありがとうございます。

このたびは<?= $event->title ?>への参加お申込み、誠にありがとうございます。

厳正なる審査の結果、イベントにご参加いただきたくご連絡致しました。

下記の通り、お申込みイベントの詳細をご確認くださいますようお願いいたします。


･･･････････････････････････････････････････

【イベント名】
　<?= $event->title ?>


【開催日時】
　<?= $event->start_date ? date('Y年m月d日', strtotime($event->start_date)) : '' ?> <?= $event->start_time ? date('H時i分', strtotime($event->start_time)) : '' ?>


【受付開始時間】
　<?= $event->reception_open ? date('H時i分', strtotime($event->reception_open)) : '' ?>


【イベントURL】
　<?= $event->wp_url ? $event->wp_url : '' ?>


･･･････････････････････････････････････････

<?= $formContent ?>


追ってお伝えしたいことがある際は、ご連絡をさせていただきます。
それでは当日のご来場をお待ちしております。


■キャンセルについて
イベントお申し込みのキャンセルにつきましてはマイページで承っております。
https://mp.startuphub.tokyo/mypage/

■その他イベントのお申込はこちら
https://startuphub.tokyo/event


※本メールにお心当たりのない方は、お手数ですが、削除していただけますようお願い申し上げます。

────────────────────────────────────────────────────
Startup Hub Tokyo（スタートアップハブ東京）
〒100－0005
東京都千代田区丸の内2-1-1明治安田生命ビル1階
TOKYO創業ステーション「Startup Hub Tokyo運営事務局」
mail:event.info@startuphub.tokyo
────────────────────────────────────────────────────
