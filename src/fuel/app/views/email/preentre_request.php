Startup Hub Tokyo事務局様

ただいま、プレアントレメンバーへの申請がありました。
下記URLから内容確認・審査のうえ、ご対応をお願いいたします。

■下記のURLから管理画面へログインしてください。
<?= Uri::create('admin/login') ?>

IDとPWが不明な場合は管理者へご確認ください。

■下記のURLからプレアントレ申請をご確認下さい。
<?= Uri::create('admin/preentre/requests/review/'. $preentre_request->id) ?>


<?= View::forge('email/_sender') ?>
