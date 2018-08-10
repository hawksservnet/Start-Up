<div id="user-registration" class="section-container">
	<div class="section-inner">
		<div class="section-contents">

			<p class="lead">変更される箇所を入力し、〜 </p>

			<ul id="progress-navi">
				<li class="current"><span><span class="en">STEP.1</span> 入力</span></li>
				<li><span><span class="en">STEP.2</span> 確認</span></li>
				<li><span><span class="en">STEP.3</span> 送信完了</span></li>
			</ul>

			<form id="form" method="post" action="" name="form">

				<div class="form-wrap clearfix">
					<dl class="clearfix">
						<dt class="required">お名前</dt>
						<dd>
							<input type="text" class="text required half smp-half smp-float" name="name_last" id="name_last"
									value="<?= Input::post('name_last') ?>" placeholder="姓">
							<input type="text" class="text required half smp-half smp-float" name="name_first" id="name_first"
									value="<?= Input::post('name_first') ?>" placeholder="名">
						</dd>
					</dl>
					<dl class="clearfix">
						<dt class="required">お名前（ふりがな）</dt>
						<dd>
							<input type="text" class="text required half smp-half smp-float" name="hiragana_name_last" id="hiragana_name_last" placeholder="姓（ふりがな）" value="<?= Input::post("hiragana_name_last") ?>">
							<input type="text" class="text required half smp-half smp-float" name="hiragana_name_first" id="hiragana_name_first" placeholder="名（ふりがな）" value="<?= Input::post("hiragana_name_first") ?>">
						</dd>
					</dl>
					<dl class="clearfix">
						<dt class="required">メールアドレス</dt>
						<dd class="clearfix">
							<input type="text" class="text required w440" name="email" id="email" placeholder="例）xxxxx@xxxxx.co.jp" value="<?= Input::post("email") ?>"><span class="unit right">半角英数字</span>
						</dd>
					</dl>
					<dl class="clearfix">
						<dt class="required">メールアドレス（確認）</dt>
						<dd class="clearfix">
							<input type="text" class="text required w440" name="emailcheck" id="emailcheck" placeholder="例）xxxxx@xxxxx.co.jp" value="<?= Input::post("emailcheck") ?>"><span class="unit right">半角英数字</span>
							<p class="caution-text">※確認のためコピーせずにもう一度入力してください</p>
						</dd>
					</dl>
					<dl class="clearfix">
						<dt class="required">パスワード</dt>
						<dd class="clearfix">
							<input type="password" class="text required w346" name="password" id="password" value="<?= Input::post("password") ?>">
						</dd>
					</dl>
					<dl class="clearfix">
						<dt class="required">パスワード（確認）</dt>
						<dd class="clearfix">
							<input type="password" class="text required w346" name="passwordcheck" id="passwordcheck" value="<?= Input::post("passwordcheck") ?>">
							<p class="caution-text">※確認のためコピーせずにもう一度入力してください</p>
						</dd>
					</dl>
					<dl class="clearfix">
						<dt class="required">電話番号</dt>
						<dd>
							<input type="tel" class="text w180" name="tel" id="tel" placeholder="例）000-0000-0000" maxlength="20" value="<?= Input::post("tel") ?>">
						</dd>
					</dl>
					<dl class="clearfix">
						<dt class="required">生年月</dt>
						<dd>
							<div class="select w160 smp-half">
								<select name="birth_year">
										<?php foreach(range(1940,2016) as $year): ?>
											<option value="<?=$year?>" <?php echo (Input::post("birth_year")==$year)?'selected':''; ?>
																						 <?php if (empty(Input::post("birth_year"))and $year==1980) echo 'selected'; ?>>
											<?=$year?>年
											</option>
										<?php endforeach; ?>
								</select>
							</div>
							<div class="select w160 smp-half smp-float smp-ml-none smp-mt">
								<select name="birth_month">
										<?php foreach(range(1,12) as $month): ?>
											<option value="<?=str_pad($month,2,0,STR_PAD_LEFT)?>"
																								 <?php echo (Input::post("birth_month")==$month)?'selected':''; ?>
																						 <?php if (empty(Input::post("birth_month"))and $month==1) echo 'selected'; ?>>
											<?=$month?>月
											</option>
										<?php endforeach; ?>
								</select>
							</div>
							<div class="select w160 smp-half smp-float smp-mt">
								<select name="birth_day">
										<?php foreach(range(1,31) as $day): ?>
											<option value="<?=str_pad($day,2,0,STR_PAD_LEFT)?>"
																								 <?php echo (Input::post("birth_day")==$day)?'selected':''; ?>
																						 <?php if (empty(Input::post("birth_day"))and $day==1) echo 'selected'; ?>>
											<?=$day?>日
											</option>
										<?php endforeach; ?>
								</select>
							</div>
						</dd>
					</dl>
					<dl class="clearfix">
						<dt class="required">性別</dt>
						<dd>
							<input type="radio" name="sex" value="1" id="male" <?= (Input::post('sex')==1)?'checked="checked"':'' ?>">
							<label for="male" class="radio">男性</label>
							<input type="radio" name="sex" value="2" id="female" <?= (Input::post('sex')==2)?'checked="checked"':'' ?>">
							<label for="female" class="radio">女性</label>
						</dd>
					</dl>
					<dl class="clearfix">
						<dt class="required">郵便番号</dt>
						<dd>
							<input type="zip" class="text w150" name="zip" id="zip" placeholder="例）000-0000" maxlength="8" value="<?= Input::post("zip") ?>">
						</dd>
					</dl>
					<dl class="clearfix mt-half">
						<dt class="required">県/市町村区</dt>
						<dd>
							<div class="select half">
							<?php echo Form::select('pref', (string) Input::post('pref', 13),
									Config::get('master.PREFECTURE_CODES'),
									array("class"=>"select half")
							); ?>
							</div>
							<input type="text" class="text required w210 smp-mt" name="city" id="city" placeholder="市区町村" value="<?= Input::post("city") ?>">
						</dd>
					</dl>
<?php if (false): ?>
<!--
<dl class="clearfix mt-half">
<dt>番地</dt>
<dd>
<input type="text" class="text required w480" name="address" id="address" placeholder="例）0-00-0" value="<?= Input::post("address") ?>">
<span class="unit right">半角</span>
</dd>
</dl>
<dl class="clearfix mt-half">
<dt>建物名・部屋番号</dt>
<dd>
<input type="text" class="text w480" name="building" id="building" placeholder="例）ダミータワー00F" value="<?= Input::post("building") ?>">
</dd>
</dl> -->
<?php endif; ?>
					<dl class="clearfix">
						<dt>所属組織名</dt>
						<dd>
							<input type="text" class="text w480" name="organization" id="organization" placeholder="例）大学名/企業名" value="<?= Input::post("organization") ?>">
						</dd>
					</dl>
					<dl class="clearfix mt-half">
						<dt>役職</dt>
						<dd>
							<input type="text" class="text w480" name="position" id="position" placeholder="" value="<?= Input::post("position") ?>">
						</dd>
					</dl>
					<dl class="clearfix">
						<dt class="required">職業</dt>
						<dd>
							<div class="select half">
							<?php echo Form::select('job', (string) Input::post('job'),
									array('' => '職業')+ $jobs,
									array("class"=>"select half required")
							); ?>
							</div>
						</dd>
					</dl>
<?php if (false): ?>
<!--
<dl class="clearfix">
<dt class="required">起業への興味</dt>
<dd>
<input type="radio" name="interest" value="1" id="interest_yes" <?= (Input::post('interest')==="1")?'checked="checked"':'' ?>">
<label for="interest_yes" class="radio">あり</label>
<input type="radio" name="interest" value="0" id="interest_no" <?= (Input::post('interest')==="0")?'checked="checked"':'' ?>">
<label for="interest_no" class="radio">なし</label>
</dd>
</dl>
<dl class="clearfix">
<dt class="required">起業への準備</dt>
<dd>
<input type="radio" name="preparation" value="1" id="preparation_yes" <?= (Input::post("preparation")==="1")?'checked="checked"':'' ?>>
<label for="preparation_yes" class="radio">している</label>
<input type="radio" name="preparation" value="2" id="preparation_now" <?= (Input::post("preparation")==="2")?'checked="checked"':'' ?>>
<label for="preparation_now" class="radio">情報収集中</label>
<input type="radio" name="preparation" value="0" id="preparation_no" <?= (Input::post("preparation")==="0")?'checked="checked"':'' ?>>
<label for="preparation_no" class="radio">していない</label>
</dd>
</dl>
<dl class="clearfix">
<dt class="required">メルマガ登録</dt>
<dd>
<input type="radio" name="mailmagazine" value="1" id="mailmagazine_yes" <?= (Input::post("mailmagazine")==="1")?'checked="checked"':'' ?>>
<label for="mailmagazine_yes" class="radio">する</label>
<input type="radio" name="mailmagazine" value="0" id="mailmagazine_no" <?= (Input::post("mailmagazine")==="0")?'checked="checked"':'' ?>>
<label for="mailmagazine_no" class="radio">しない</label>
</dd>
</dl> -->
<?php endif; ?>
					<dl class="clearfix">
						<dt class="required">DMによる案内</dt>
						<dd>
							<input type="radio" name="mailmagazine_info" value="1" id="mailmagazine_info_yes" <?= (Input::post("mailmagazine_info")!=="0")?'checked="checked"':'' ?>>
							<label for="mailmagazine_info_yes" class="radio">受け取る</label>
							<input type="radio" name="mailmagazine_info" value="0" id="mailmagazine_info_no" <?= (Input::post("mailmagazine_info")==="0")?'checked="checked"':'' ?>>
							<label for="mailmagazine_info_no" class="radio">受け取らない</label>
						</dd>
					</dl>
<?php if (false): ?>
<!--
<dl class="clearfix">
<dt class="required">起業における役割<span>（複数選択可）</span></dt>
<dd>
<input type="checkbox" name="role01" id="role01" value="1"
<?= (Input::post("role01"))?'checked="checked"':'' ?>>
<label for="role01" class="checkbox">経営専従</label>
<input type="checkbox" name="role02" id="role02" value="1"
<?= (Input::post("role02"))?'checked="checked"':'' ?>>
<label for="role02" class="checkbox">プランナー</label>
<input type="checkbox" name="role03" id="role03" value="1"
<?= (Input::post("role03"))?'checked="checked"':'' ?>>
<label for="role03" class="checkbox">マーケッター</label>
<input type="checkbox" name="role04" id="role04" value="1"
<?= (Input::post("role04"))?'checked="checked"':'' ?>>
<label for="role04" class="checkbox mt">エンジニア</label>
<input type="checkbox" name="role05" id="role05" value="1"
<?= (Input::post("role05"))?'checked="checked"':'' ?>>
<label for="role05" class="checkbox mt">研究者</label>
<input type="checkbox" name="role06" id="role06" value="1"
<?= (Input::post("role06"))?'checked="checked"':'' ?>>
<label for="role06" class="checkbox mt">デザイナー</label>
</dd>
</dl>
<dl class="clearfix">
<dt>イベント参加状況</dt>
<dd class="textarea">
<textarea class="text" cols="30" rows="3" name="event" id="event" placeholder="イベントの参加状況をご記入ください" wrap="hard"><?= Input::post("event") ?></textarea>
</dd>
</dl>
<dl class="clearfix">
<dt>マッチング履歴</dt>
<dd class="textarea">
<textarea class="text" cols="30" rows="3" name="matching" id="matching" placeholder="マッチング履歴をご記入ください" wrap="hard"><?= Input::post("matching") ?></textarea>
</dd>
</dl>
<dl class="clearfix">
<dt>起業予定日</dt>
<dd>
<div class="select w160 smp-half smp-float">
<select name="entrepreneur_year">
<option value="">年</option>
<?php foreach(range(1920,2016) as $year): ?>
<option value="<?=$year?>" <?php echo (Input::post("entrepreneur_year")==$year)?'selected':''; ?>>
<?=$year?>
</option>
<?php endforeach; ?>
</select>
</div>
<div class="select w160 smp-half smp-float">
<select name="entrepreneur_month">
<option value="">月</option>
<?php foreach(range(1,12) as $month): ?>
<option value="<?=str_pad($month,2,0,STR_PAD_LEFT)?>" <?php echo (Input::post("entrepreneur_month")==$month)?'selected':''; ?>>
<?=$month?>
</option>
<?php endforeach; ?>
</select>
</div>
</dd>
</dl>
<dl class="clearfix">
<dt>起業の業態</dt>
<dd>
<div class="select half">
<?php echo Form::select('business_type', (string) Input::post('business_type'),
array('' => '業態')+ $business_types,
array("class"=>"select half")
); ?>
</div>
</dd>
</dl>
<dl class="clearfix">
<dt>業種</dt>
<dd>
<input type="text" class="text w346" name="industry" id="industry" placeholder="" value="<?= Input::post("industry") ?>">
</dd>
</dl>
</div> -->
<?php endif; ?>
				<div class="privacy-container">
					<h3 class="title">お客様の個人情報の扱いについて</h3>
					<ul class="privacy-list">
						<li>
						1.	Startup Hub Tokyoの事業受託者であるテクノロジーシードインキュベーション株式会社はお預かりした個人情報を漏洩、紛失、改ざん等の事態から防ぐために、「東京都個人情報の保護に関する条例（平成2年12月21日条例第113号）」及び当社個人情報保護方針に基づき、適切なセキュリティ対策を講じ厳重に管理します。お客様の個 人情報の取り扱いが適正に行われるように従業者の教育・監督を実施します。 尚、当サイトを安全に管理するため、必要に応じ、蓄積した個人情報等のデータの利用停止・削除修正等の必要な措置を講じる場合があります。詳細は当社ホームページ個人情報保護方針をご覧ください。<br>
						<a href="https://www.tsi-japan.com/privacy-policy/" target="_blank">https://www.tsi-japan.com/privacy-policy/</a>
						</li>
						<li>
						2.	個人情報の利用目的：ご記入いただいた個人情報は、以下の目的で利用させていただきます。<br>
						a.	セミナー等のイベント開催に利用いたします。<br>
						b.	弊社施設の運営管理、イベント開催のご案内の送付に利用いたします。<br>
						c.	アンケート項目の集計による、イベントの評価に利用いたします。<br>
						d.	お客様からのご意見・ご要望に対する回答をさせていただく際に利用いたします。<br>
						e.	コンシェルジュ相談の際の参考にさせていただきます。<br>
						f.	託児施設にお子様をお預けいただいた際の連絡先等に利用いたします。弊社が取り扱うサービス等に関する提案、その他情報提供に利用いたします。<br>
						g.	イベント等にご参加いただいた際、イベント風景を写真・動画撮影するとともに録音をする場合がございます。写真、動画、録音は広報や報告資料に利用いたします。

						</li>
						<li>
						</li>
						<li>
						3.	第三者提供：あらかじめご了承をいただいた場合及び法の定めによる場合を除き、第三者にお客様の情報を提供又は開示しません。なお、イベント等に申し込んでいただく際は当該イベントに関連する個人・団体にお客様情報を提供する場合がございます。その際はイベント申し込み時に別途提供先となるオーガナイザー（個人、団体など）を提示いたします。
						</li>
						<li>
						4.	共同利用：ご入力いただく個人情報は以下のとおりStartup Hub Tokyoの事業主体である東京都と第2項の目的で共同利用いたします。<br>
						共同利用する内容：氏名、メールアドレス、電話番号、市区町村
						</li>
						<li>
						5.	個人情報の委託<br>
						ご記入いただいた個人情報は、利用目的の範囲内で業務を行うために、個人情報の取り扱いを委託する場合がございます。 <br>その際には、委託先との間で、個人情報の保護を義務付けるための契約を締結するとともに、委託した個人情報の 管理について、必要かつ適切な監督を行います。
						</li>
						<li>
						6.	個人情報提供の任意性：個人情報をご提供いただけない場合は、お客様からのご要望にお応えできない場合があります。
						</li>
						<li>
						7.	個人情報に関するお問い合わせ先：お客様からご提供いただいた個人情報に関しての苦情及び相談、開示、削除、訂正、利用停止等の必要が生じた場合には、 お客様ご本人から、以下にご連絡をいただくことにより、適宜対応させていただきます。<br>
						テクノロジーシードインキュベーション株式会社 Startup Hub Tokyo<br>
						住所：東京都千代田区丸の内2-1-1　明治安田生命ビル1階　TOKYO創業ステーション<br>
						電話：03-6551-2470
						</li>
					</ul>
				</div>
				<div class="checkbox-container">
					<p class="text">「会員施設利用規約」は<a href="https://startuphub.tokyo/assets/pdf/registration.pdf" target="_blank">こちら</a></p>
					<p class="text">上記に同意いただける場合は以下のチェックボックスにチェックをお願いいたします。</p>

					<p>
						<span class="wpcf7-form-control-wrap privacy"><span class="wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required checkbox-container" id="privacy-check"><span class="wpcf7-list-item first last"><input type="checkbox" name="privacy[]" value="同意" /><span class="wpcf7-list-item-label">同意</span></span></span></span>
					</p>
				</div>

				<div class="btn-list clearfix">
					<div class="btn w160 h60 icon-none back">
						<div class="btn-inner clear">
							<a class="overlay-text" id="reset-btn" onclick="document.form.reset();return false">
								<span class="text en">RESET</span>
							</a>
							<div class="line"></div>
							<div class="line2"></div>
						</div>
					</div>
					<div id="submit-btn" class="btn disable">
						<div class="btn-inner black">
							<button id="submit-btn">
								<span class="text en">CONFIRM</span>
							</button>
							<div class="line"></div>
							<div class="line2"></div>
						</div>
					</div>
				</div><!--btn_list-->

			</form>

						</div><!-- /.section-contents -->
	</div><!-- /.section-inner -->
</div><!-- /.section-container -->
