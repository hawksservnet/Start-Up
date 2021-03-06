		<div id="user-registration" class="section-container">
			<div class="section-inner">
				<div class="section-contents">

					<p class="lead">下記フォームに必須項目をご入力いただき、「個人情報保護方針」「会員規約」「施設利用規約」に同意の上、メンバー登録をお願いいたします。 </p>

					<ul id="progress-navi">
						<li class="current"><span><span class="en">STEP.1</span> 入力</span></li>
						<li><span><span class="en">STEP.2</span> 確認</span></li>
						<li><span><span class="en">STEP.3</span> 送信完了</span></li>
					</ul>

					<form id="form" method="post" action="" name="form">

            <!-- フォーム内容 -->
            <?php echo render('users/_form', compact('jobs')); ?>

						<div class="privacy-container">
							<h3 class="title">個人情報保護方針</h3>
							<ul class="privacy-list">
								<li>
									<dl>
										<dt>1.	Startup Hub Tokyoの事業受託者である株式会社ツクリエはお預かりした個人情報を漏洩、紛失、改ざん等の事態から防ぐために、「東京都個人情報の保護に関する条例（平成2年12月21日条例第113号）」及び当社個人情報保護方針に基づき、適切なセキュリティ対策を講じ厳重に管理します。お客様の個 人情報の取り扱いが適正に行われるように従業者の教育・監督を実施します。 尚、当サイトを安全に管理するため、必要に応じ、蓄積した個人情報等のデータの利用停止・削除修正等の必要な措置を講じる場合があります。</dt>
									</dl>
								</li>
								<li>
									<dl>
										<dt>2.個人情報とは</dt>
										<dd>住所、氏名、電話番号、E-mailアドレス等、特定の個人を識別できる情報をいいます。</dd>
									</dl>
								</li>
								<li>
									<dl>
										<dt>3.個人情報の取得</dt>
										<dd>
											個人情報を収集する際は、お客様の意思による情報の提供（登録）を原則とし、当法人は、本件個人情報の取得を適正に行い、不正な手段で本件個人情報を取得することはしません。<br>
											個人情報の収集にあたっては、その収集目的を明示します。<br>
											個人情報の収集は、明示した目的を達成するために必要な範囲内でこれを行います。<br>
										</dd>
									</dl>
								</li>
								<li>
									<dl>
										<dt>4.法令等の遵守</dt>
										<dd>
											当法人は、東京都個人情報の保護に関する条例及び関連官庁ガイドラインその他個人情報の適正な取扱いに関連する法令を遵守します。
										</dd>
									</dl>
								</li>
								<li>
									<dl>
										<dt>5.個人情報の利用目的</dt>
										<dd>ご記入いただいた個人情報は、以下の目的で利用させていただきます。<br>
											(1) セミナー等のイベント開催に利用いたします。<br>
											(2) 弊社施設の運営管理、イベント開催のご案内の送付に利用いたします。<br>
											(3) アンケート項目の集計による、イベントの評価に利用いたします。<br>
											(4) お客様からのご意見・ご要望に対する回答をさせていただく際に利用いたします。<br>
											(5) コンシェルジュ相談の際の参考にさせていただきます。<br>
											(6) 託児施設にお子様をお預けいただいた際の連絡先等に利用いたします。弊社が取り扱うサービス等に関する提案、その他情報提供に利用いたします。<br>
											(7)イベント等にご参加いただいた際、イベント風景を写真・動画撮影するとともに録音をする場合がございます。写真、動画、録音は広報や報告資料に利用いたします。
				</dd>
									</dl>
								</li>
								<li>
									<dl>
										<dt>6.第三者提供</dt>
										<dd>
											当当法人はあらかじめご了承をいただいた場合及び条例の定めによる場合を除き、第三者にお客様の情報を提供又は開示しません。<br>
											ただし、統計的に処理された利用者属性等の情報については、個人情報を一切含まないものに限り、公表することがあります。<br>
											なお、イベント等に申し込んでいただく際は当該イベントに関連する個人・団体にお客様情報を提供する場合がございます。<br>
										その際はイベント申し込み時に別途提供先となるオーガナイザー（個人、団体など）を提示いたします。

										</dd>
									</dl>
								</li>
								<li>
									<dl>
										<dt>7.共同利用</dt>
										<dd>
											ご入力いただく個人情報は以下のとおり、当法人とStartup Hub Tokyoの事業主体である東京都と第４項の目的で共同利用いたします。<br>
											・共同利用する内容：氏名、メールアドレス、電話番号、市区町村
										</dd>
									</dl>
								</li>
								<li>
									<dl>
										<dt>8.個人情報の委託</dt>
										<dd>
											ご記入いただいた個人情報は、利用目的の範囲内で業務を行うために、個人情報の取り扱いを委託する場合がございます。その際には、委託先との間で、個人情報の保護を義務付けるための契約を締結するとともに、委託した個人情報の 管理について、必要かつ適切な監督を行います。
										</dd>
									</dl>
								</li>
								<li>
									<dl>
										<dt>9.個人情報提供の任意性</dt>
										<dd>
											個人情報をご提供いただけない場合は、お客様からのご要望にお応えできない場合があります。
										</dd>
									</dl>
								</li>
								<li>
									<dl>
										<dt>10.本件個人情報の安全管理体制</dt>
										<dd>
											(1)当法人は、本件個人情報の紛失、改ざん、漏えい等を防止するため、情報セキュリティを含めた本件個人情報の取扱いに関する安全管理を適切に行い、本件個人情報の不正アクセス、漏えい、紛失および改ざん等の予防に努めます。<br>
											(2)当法人は、本件個人情報の適正な管理を行うために、管理責任者を置いて安全に管理します。<br>
											(3)当法人は、本件個人情報の保護のための管理体制及び取組みを定期的に見直し、継続的な改善に努めます。<br>
											(4)当法人は、本件個人情報を取り扱う社員・職員その他の従業者に対して、本件個人情報の保護及び適正な管理方法等について研修を行い、本件業務における本件個人情報の適正な取扱いを徹底します。
										</dd>
									</dl>
								</li>
								<li>
									<dl>
										<dt>11.開示、訂正、利用停止等</dt>
										<dd>
											当法人は、ご本人から自己の本件個人情報について、東京都個人情報の保護に関する条例に基づく開示・訂正等を求められたときは、条例に則り適切に対応します。
										</dd>
									</dl>
								</li>
								<li>
									<dl>
										<dt>12.個人情報に関するお問い合わせ先</dt>
										<dd>
											お客様からご提供いただいた個人情報に関しての苦情及び相談、開示、削除、訂正、利用停止等の必要が生じた場合には、 お客様ご本人から、以下にご連絡をいただくことにより、適宜対応させていただきます。<br>
											<br>
											株式会社ツクリエ Startup Hub Tokyo運営事務局<br>
											住所：東京都千代田区丸の内2-1-1　明治安田生命ビル1階　TOKYO創業ステーション<br>
											電話：03-6551-2470
										</dd>
									</dl>
								</li>

							</ul>
						</div>
						<div class="checkbox-container">
							<p class="text">「会員規約」「施設利用規約」は<a href="https://startuphub.tokyo/terms" target="_blank">こちら</a></p>
							<p class="text">上記に同意いただける場合は以下のチェックボックスにチェックをお願いいたします。</p>

							<p>
								<span class="wpcf7-form-control-wrap privacy"><span class="wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required checkbox-container" id="privacy-check"><span class="wpcf7-list-item first last foucus_t"><input type="checkbox" name="privacy[]" value="同意" /><span class="wpcf7-list-item-label">同意</span></span></span></span>
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