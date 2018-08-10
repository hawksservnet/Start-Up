<div id="list_wrap">

	<div class="bg_gray_wrap">
		<ul class="tab_list four_colum clearfix">
			<li data-sort="add">会員登録について</li>
			<li data-sort="start">利用開始の手順</li>
			<li data-sort="return">返却方法</li>
			<li data-sort="ic">ICカード登録</li>
		</ul>
	</div>
	<div class="list_wrap add">
		<div class="notes_top">
				<p>会員のご登録いただくと、HELLO CYCLINGのシェアサイクルサービスをご利用いただけます。
					ご登録後は、登録のメールアドレスとパスワードでログインが必要です。
					会員登録には年会費、登録料、更新料、維持費などの料金は一切かかりません。<br>
					<span>※PCサイトからは会員登録のみ行えます</span>
				</p>
			</div>
		<h3 class="sub_title_min" id="add01">会員登録について</h3>
		<ul class="tutorial_list add_type">
			<li>
				<p class="img"><?php echo Asset::img('tutorial/tutorial_add_img1.png', array("alt"=>"新規登録", 'height'=>"450", 'width'=>'442')); ?></p>
				<dl>
					<dt>新規登録</dt>
					<dd>オリジナルアカウントまたは、Facebookアカウントを使用するかを選択します。</dd>
				</dl>
			</li>
			<li>
				<p class="img"><?php echo Asset::img('tutorial/tutorial_add_img2.png', array("alt"=>"基本情報入力",'height'=>"450", 'width'=>'442')); ?></p>
				<dl>
					<dt>基本情報入力</dt>
					<dd>基本情報を入力し、利用規約に同意の上「会員登録をする」ボタンをクリックします。</dd>
				</dl>
			</li>
			<li>
				<p class="img wide"><?php echo Asset::img('tutorial/tutorial_add_img3.png', array("alt"=>"仮登録完了のメールを確認",'height'=>"448", 'width'=>'568')); ?></p>
				<dl>
					<dt>仮登録完了のメールを確認</dt>
					<dd>ご入力いただいたメールアドレスに、HELLO CYCLE（no-reply@hellocycling.jp）より「オリジナルアカウント本登録URLのご案内」のメールが配信されます。</dd>
				</dl>
			</li>
			<li>
				<p class="img"><?php echo Asset::img('tutorial/tutorial_add_img4.png', array("alt"=>"支払い情報入力",'height'=>"450", 'width'=>'442')); ?></p>
				<dl>
					<dt>支払い情報入力</dt>
					<dd>受信されたメールに記載されたURLからアクセスいただくと支払い情報入力の画面にアクセスできます。
						必要情報をご入力の上「次へ」のボタンをクリックします。
						<span>※当サービスのご利用には支払い情報の入力が必須です。</span></dd>
				</dl>
			</li>
			<li>
				<p class="img"><?php echo Asset::img('tutorial/tutorial_add_img5.png', array("alt"=>"利用開始",'height'=>"450", 'width'=>'442')); ?></p>
				<dl>
					<dt>登録完了</dt>
					<dd class="center">完了後直ぐにご利用いただけます。</dd>
				</dl>
			</li>
		</ul>
		<div class="modal_wrap ic_modal_wrap">
			<div class="modal_inner">
				<p class="title">ICカード番号記載場所</p>
				<div class="image_wrap">
					<?php echo Asset::img('tutorial/img_suica.png',array('alt'=>'ICカード裏面')); ?>
				</div>
				<p class="text">カード裏右下に記載の「JE」で始まる17桁の番号です。</p>
				<span class="close_btn"></span>
			</div>
		</div><!--ICカード-->
	</div>
	<div class="list_wrap start" id="start00">
		<div class="start_block">
			<ul class="three_colum clearfix">
				<li><a href="#start01" class="link_small">サイトで<br>ご予約された方</a></li>
				<li><a href="#start02">ICカードを<br>お持ちの方</a></li>
				<li><a href="#start03">利用中の</br>施錠・開錠</a></li>
			</ul>
		</div>
		<h3 class="sub_title_min" id="start01">サイトでご予約された方</h3>
		<div class="notes_top">
			<p>ご予約時に発行された暗証番号でスマートロックの開錠ができます。</p>
		</div>
		<ul class="tutorial_list start_type">
			<li id="start01-01" class="bg_white-r">
				<p class="img"><?php echo Asset::img('tutorial/tutorial_start_img1.png', array("alt"=>"車両番号の確認",'height'=>"450", 'width'=>'442')); ?></p>
				<dl>
					<dt>①車両番号の確認</dt>
					<dd>自転車の車体に記載されている車両番号と、予約した車両番号が一致していることを確認します。</dd>
				</dl>
			</li>
			<li id="start01-02" class="bg_white">
				<p class="img"><?php echo Asset::img('tutorial/tutorial_start_img2.png', array("alt"=>"スマートロック起動、使用言語の選択",'height'=>"450", 'width'=>'442')); ?></p>
				<dl>
					<dt>②スマートロック起動、使用言語の選択</dt>
					<dd>自転車のハンドル付近にある操作パネルの電源を押してください。スマートロックの操作パネル内のディスプレイに言語が表示されます。希望の言語を選択します。</dd>
				</dl>
			</li>
			<div class="bg_gray_wrap">
				<ul class="tab_list-2">
					<li class="select">③暗証番号で開錠</li>
					<li>③ICカードで開錠</li>
				</ul>
			</div>
			<li id="start01-03" class="content">
				<div class="tab">
					<p class="img"><?php echo Asset::img('tutorial/tutorial_start_img3-1.png', array("alt"=>"暗証番号で開錠",'height'=>"400", 'width'=>'402')); ?></p>
					<dl>
						<dt>③暗証番号で開錠</dt>
						<dd>
							予約完了メールに記載されている4桁の暗証番号を操作パネルにご入力ください。「認証OK」が操作パネル内のディスプレイに表示されると利用を開始できます。
						</dd>
					</dl>
				</div>
				<div class="tab hide">
					<p class="img"><?php echo Asset::img('tutorial/tutorial_start_img3-2.png', array("alt"=>"ICカードで開錠",'height'=>"400", 'width'=>'402')); ?></p>
					<dl>
						<dt>③ICカードで開錠</dt>
						<dd>
							ICカードを登録済みの方はICカードでも解錠可能です。ご登録された、ICカードを操作パネルにかざしてください。
						</dd>
					</dl>
				</div>
			</li>
		</ul>
		<ul class="tutorial_list start_type">
			<h3 class="sub_title_min" id="start02">ICカードをお持ちの方</h3>
			<div class="notes_top">
				<p>ご登録いただいているICカードにて開錠が可能です。ICカードでご利用いただく場合ご予約は必要ありません。</p>
			</div>
			<li class="bg_white-r">
				<p class="img"><?php echo Asset::img('tutorial/tutorial_start_img4.png', array("alt"=>"スマートロック起動、使用言語の選択",'height'=>"450", 'width'=>'442')); ?></p>
				<dl>
					<dt>①スマートロック起動、使用言語の選択</dt>
					<dd>自転車のハンドル付近にある操作パネルの電源を押してください。スマートロックの操作パネル内のディスプレイに言語が表示されます。希望の言語を選択します。</dd>
				</dl>
			</li>
			<li id="ic_open" class="bg_white">
				<p class="img"><?php echo Asset::img('tutorial/tutorial_start_img5.png', array("alt"=>"ICカードで開錠",'height'=>"450", 'width'=>'442')); ?></p>
				<dl>
					<dt>②ICカードで開錠</dt>
					<dd>ご登録された、ICカードを操作パネルにかざしてください。「認証OK」が操作パネル内のディスプレイに表示されると利用を開始できます。<span><a class='anchor_link' href="#ic_save" data-sort='ic'>*ICカードの登録について</a></span></dd>
				</dl>
			</li>
		</ul>
		<h3 class="sub_title_min" id="start03">利用中の施錠・開錠</h3>
		<ul class="tutorial_list start_type">
			<li>
				<p class="img"><?php echo Asset::img('tutorial/tutorial_start_img6.png', array("alt"=>"利用中の施錠方法",'height'=>"450", 'width'=>'442')); ?></p>
				<dl>
					<dt>利用中の施錠方法</dt>
					<dd>鍵は手動で施錠します。<span class="emphasis">※HELLO CYCLINGのステーション付近で操作パネルにあるRETURNボタンを押すと返却されてしまうのでご注意ください。</span></dd>
				</dl>
			</li>
			<li>
				<p class="img"><?php echo Asset::img('tutorial/tutorial_start_img7.png', array("alt"=>"利用中の開錠方法",'height'=>"450", 'width'=>'442')); ?></p>
				<dl>
					<dt>利用中の開錠方法</dt>
					<dd>ご予約の際に発行された4桁の暗証番号を入力するか、ご登録いただいたICカードにて開錠します。</dd>
				</dl>
			</li>
		</ul>
	</div>
	<div class="list_wrap return">
		<h3 class="sub_title_min" id="return01">返却方法</h3>
		<ul class="tutorial_list return_type">
			<li>
				<p class="img"><?php echo Asset::img('tutorial/tutorial_return_img1.png', array("alt"=>"手動で施錠",'height'=>"400", 'width'=>'402')); ?></p>
				<dl>
					<dt>①手動で施錠</dt>
					<dd>ステーションにある指定の場所に自転車を設置し、鍵を手動で施錠します。</dd>
				</dl>
			</li>
			<li>
				<p class="img"><?php echo Asset::img('tutorial/tutorial_return_img2.png', array("alt"=>"RETURNボタンを押す",'height'=>"400", 'width'=>'402')); ?></p>
				<dl>
					<dt>②RETURNボタンを押す</dt>
					<dd>電源ボタンを押し、「返却はRETURNボタンを押す停車開錠は暗証番号 or ICカードかざす」と表示されたら操作パネルにある「RETURN」ボタンを押します。</dd>
				</dl>
			</li>
			<li>
				<p class="img"><?php echo Asset::img('tutorial/tutorial_return_img3.png', array("alt"=>"選択",'height'=>"400", 'width'=>'402')); ?></p>
				<dl>
					<dt>③選択</dt>
					<dd>ディスプレイに「返却しますか？」と表示されるので、操作パネルにあるテンキーにて選択をします。</dd>
				</dl>
			</li>
			<div class="bg_gray_wrap">
				<ul class="tab_list-2">
					<li class="select">④暗証番号で返却</li>
					<li>④ICカードで返却</li>
				</ul>
			</div>
			<li class="content">
				<div class="tab">
					<p class="img"><?php echo Asset::img('tutorial/tutorial_return_img4-1.png', array("alt"=>"暗証番号で返却",'height'=>"400", 'width'=>'402')); ?></p>
					<dl>
						<dt>④暗証番号で返却</dt>
						<dd>
							予約完了メールに記載されている4桁の暗証番号を操作パネルにご入力ください。
						</dd>
					</dl>
				</div>
				<div class="tab hide">
					<p class="img"><?php echo Asset::img('tutorial/tutorial_return_img4-2.png', array("alt"=>"ICカードで返却",'height'=>"400", 'width'=>'402')); ?></p>
					<dl>
						<dt>④ICカードで返却</dt>
						<dd>
							ご登録された、ICカードを操作パネルにかざしてください。
						</dd>
					</dl>
				</div>
			</li>
			<li>
				<p class="img"><?php echo Asset::img('tutorial/tutorial_return_img5.png', array("alt"=>"返却完了",'height'=>"400", 'width'=>'402')); ?></p>
				<dl>
					<dt>⑤返却完了</dt>
					<dd>返却が完了しました。<span class="emphasis">※「返却場所エラーで返却できません」と表示された場合、満車もしくはステーションから離れすぎています。サイトにてステーションの場所または返却可能台数をご確認ください。</span></dd>
				</dl>
			</li>
		</ul>
		<div class="notes">
			<ul>
				<li>※1.ご利用時間を1時間で指定いただいている場合、時間を越えると自動的に1日へ変更されます。</li>
			</ul>
		</div>
	</div>
	<div class="list_wrap ic" id="ic_save">
		<div class="notes_top">
			<p>ご利用中であれば、ICカードは自転車についているスマートロックの操作パネルからご登録いただけます。
				<span class="emphasis">
					※ICカードは自転車をご利用中のみご登録可能です。<br>
					※ICカードの種類によっては、ご利用いただけない場合もございます。ご了承ください。
				</span></p>
		</div>
		<ul class="tutorial_list ic_guide">
		<h3 class="sub_title_min" id="ic01">ICカード登録</h3>
			<li>
				<p class="img"><?php echo Asset::img('tutorial/tutorial_ic_img1.png', array("alt"=>"電源ボタンをタッチ",'height'=>"400", 'width'=>'402')); ?></p>
				<dl>
					<dt>①電源ボタンをタッチ</dt>
					<dd class="center"><span class="emphasis">ご利用中に</span>操作パネルの電源を入れます。</dd>
				</dl>
			</li>
			<li>
				<p class="img"><?php echo Asset::img('tutorial/tutorial_ic_img2.png', array("alt"=>"操作パネルを起動",'height'=>"400", 'width'=>'402')); ?></p>
				<dl>
					<dt>②操作パネルを起動</dt>
					<dd class="center">操作パネルが起動されると、スマートロックの操作パネル内のディスプレイに案内が表示されます。希望の内容に添って操作を行います。</dd>
				</dl>
			</li>
			<li>
				<p class="img"><?php echo Asset::img('tutorial/tutorial_ic_img3.png', array("alt"=>"ICカードをかざす",'height'=>"400", 'width'=>'402')); ?></p>
				<dl>
					<dt>③ICカードをかざす</dt>
					<dd>ICカードを操作パネルにかざしてください。</dd>
				</dl>
			</li>
			<li>
				<p class="img"><?php echo Asset::img('tutorial/tutorial_ic_img4.png', array("alt"=>"カード情報を確認",'height'=>"400", 'width'=>'402')); ?></p>
				<dl>
					<dt>④カード情報を確認</dt>
					<dd>カードが登録されていない場合、操作パネル内のディスプレイには「このICカードは登録されていません。」と表示されます。<span class="emphasis">※既に登録されているICカードをかざした場合、「認証OK」が表示されます。自転車の開錠や返却がICカードで操作できます。</span></dd>
				</dl>
			</li>
			<li>
				<p class="img"><?php echo Asset::img('tutorial/tutorial_ic_img5.png', array("alt"=>"選択",'height'=>"400", 'width'=>'402')); ?></p>
				<dl>
					<dt>⑤選択</dt>
					<dd>ディスプレイに「ICカードを登録します。」と表示されるので、操作パネルにあるテンキーの「1」を押します。</dd>
				</dl>
			</li>
			<li>
				<p class="img"><?php echo Asset::img('tutorial/tutorial_ic_img6.png', array("alt"=>"再度ICカードをかざす",'height'=>"400", 'width'=>'402')); ?></p>
				<dl>
					<dt>⑥再度ICカードをかざす</dt>
					<dd>1を押すと「登録するICカードをかざしてください」と表示されるので、再度ICカードをかざしてください。</dd>
				</dl>
			</li>
			<li>
				<p class="img"><?php echo Asset::img('tutorial/tutorial_ic_img7.png', array("alt"=>"カード情報の確認",'height'=>"400", 'width'=>'402')); ?></p>
				<dl>
					<dt>⑦カード情報の確認</dt>
					<dd>ICカード情報の確認が完了し、登録されます。</dd>
				</dl>
			</li>
			<li>
				<p class="img"><?php echo Asset::img('tutorial/tutorial_ic_img8.png', array("alt"=>"暗証番号の登録",'height'=>"400", 'width'=>'402')); ?></p>
				<dl>
					<dt>⑧暗証番号の登録</dt>
					<dd>ICカードの確認完了後、<span class="emphasis">自転車予約時に発行された4桁の暗証番号</span>を入力してください。</dd>
				</dl>
			</li>
			<li>
				<p class="img"><?php echo Asset::img('tutorial/tutorial_ic_img9.png', array("alt"=>"ICカード登録完了",'height'=>"400", 'width'=>'402')); ?></p>
				<dl>
					<dt>⑨ICカード登録完了</dt>
					<dd>ICカードの登録が完了しました。自転車の開錠や返却がICカードでできるようになります。</dd>
				</dl>
			</li>

		</ul>
	</div>
</div>
