        <div id="preentre" class="section-container">
            <div class="section-inner">
                <div class="section-contents">

                    <p class="lead center">下記フォームをご入力いただき、プレアントレへの登録をお願いいたします。</p>

                    <div role="form" class="wpcf7" id="wpcf7-f118-p2-o1" lang="ja" dir="ltr">
                        <form action="" method="post" class="wpcf7-form" novalidate="novalidate">
                            <div style="display: none;">
                                <input type="hidden" name="_wpcf7" value="118" />
                                <input type="hidden" name="_wpcf7_version" value="4.6" />
                                <input type="hidden" name="_wpcf7_locale" value="ja" />
                                <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f118-p2-o1" />
                                <input type="hidden" name="_wpnonce" value="59544dd90d" />
                            </div>
                            <div class="form-wrap input clearfix">
                            <dl class="clearfix">
                                <dt>起業への意思</dt>
                                <dd>
                                    <span class="wpcf7-form-control-wrap intention">
                                        <span class="wpcf7-form-control wpcf7-radio radio-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="intention" value="1"
                                                  <?= (Input::post("intention") == 1)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">起業すべきか迷っている</span>
                                            </span>
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="intention" value="2"
                                                  <?= (Input::post("intention") == 2)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">起業する事は決めたが、起業時期は未定である</span>
                                            </span>
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="intention" value="3"
                                                  <?= (Input::post("intention") == 3)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">起業する事を決め、1年以内に起業する予定</span>
                                            </span>
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="intention" value="4"
                                                  <?= (Input::post("intention") == 4)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">起業する事を決め、2～3年以内に起業する予定</span>
                                            </span>
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="intention" value="5"
                                                  <?= (Input::post("intention") == 5)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">個人事業主として起業済み</span>
                                            </span>
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="intention" value="6"
                                                  <?= (Input::post("intention") == 6)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">今の処　起業の意思は無い</span>
                                            </span>
                                        </span>
                                    </span>
                                </dd>
                            </dl>
                            <dl class="clearfix">
                                <dt>どういった事業をお考えですか？</dt>
                                <dd>
                                    <span class="wpcf7-form-control-wrap business">
                                        <span class="wpcf7-form-control wpcf7-radio radio-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="business_type" value="1"
                                                  <?= (Input::post("business_type") == 1)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">テック系ベンチャー（情報通信・IT・IoT・AI等）</span>
                                            </span>
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="business_type" value="2"
                                                  <?= (Input::post("business_type") == 2)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">Webサービス（Webショップ、Webサービス、アプリ等）</span>
                                            </span>
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="business_type" value="3"
                                                  <?= (Input::post("business_type") == 3)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">飲食店・小売店</span>
                                            </span>
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="business_type" value="4"
                                                  <?= (Input::post("business_type") == 4)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">ソーシャルビジネス（社会的課題起業）</span>
                                            </span>
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="business_type" value="5"
                                                  <?= (Input::post("business_type") == 5)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">農業・林業</span>
                                            </span>
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="business_type" value="6"
                                                  <?= (Input::post("business_type") == 6)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">在宅ワーク</span>
                                            </span>
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="business_type" value="7"
                                                  <?= (Input::post("business_type") == 7)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">フランチャイズ</span>
                                            </span>
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="business_type" value="8"
                                                  <?= (Input::post("business_type") == 8)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">その他</span>
                                                <input type="text" name="business_type_text" value="<?= Input::post("business_type_text") ?>" size="40" class="wpcf7-form-control wpcf7-text text other-text pc" aria-invalid="false" placeholder="任意記入" />
                                            </span>
                                        </span>
                                        <!-- <span class="wpcf7-list-item sp">
                                        <input type="text" name="business_type_text" value="<?= Input::post("business_type_text") ?>" size="40" class="wpcf7-form-control wpcf7-text text other-text" aria-invalid="false" placeholder="任意記入" />
                                        </span> -->
                                    </span>
                                </dd>
                            </dl>
                            <dl class="clearfix">
                                <dt>起業スタイルは<br class="pc">どのようにお考えですか？</dt>
                                <dd>
                                    <span class="wpcf7-form-control-wrap entrepreneurial_style">
                                        <span class="wpcf7-form-control wpcf7-radio radio-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="business_style" value="1"
                                                  <?= (Input::post("business_style") == 1)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">個人事業主</span>
                                            </span>
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="business_style" value="2"
                                                  <?= (Input::post("business_style") == 2)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">個人事業主を法人化</span>
                                            </span>
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="business_style" value="3"
                                                  <?= (Input::post("business_style") == 3)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">合同会社（合資会社、合名会社）</span>
                                            </span>
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="business_style" value="4"
                                                  <?= (Input::post("business_style") == 4)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">株式会社</span>
                                            </span>
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="business_style" value="5"
                                                  <?= (Input::post("business_style") == 5)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">NPO法人（特定非営利活動法人）</span>
                                            </span>
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="business_style" value="6"
                                                  <?= (Input::post("business_style") == 6)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">一般社団法人</span>
                                            </span>
                                            <span class="wpcf7-list-item">
                                                <input type="radio" name="business_style" value="7"
                                                  <?= (Input::post("business_style") == 7)?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">その他</span>
                                                <input type="text" name="business_style_text" value="<?= Input::post("business_style_text") ?>" size="40" class="wpcf7-form-control wpcf7-text text other-text pc" aria-invalid="false" placeholder="任意記入" />
                                            </span>
                                        </span>
                                        <!-- <span class="wpcf7-list-item sp">
                                        <input type="text" name="business_style_text" value="<?= Input::post("business_style_text") ?>" size="40" class="wpcf7-form-control wpcf7-text text other-text" aria-invalid="false" placeholder="任意記入" />
                                        </span> -->
                                    </span>
                                </dd>
                            </dl>
                            <dl class="clearfix">
                                <dt>現在どういったお悩みを<br class="pc">持っていますか？（複数回答可）</dt>
                                <dd>
                                    <span class="wpcf7-form-control-wrap trouble">
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="problem01" value="1"
                                                  <?= (Input::post("problem01"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label long">自分が起業に向いているか<br>分からない</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="problem02" value="1"
                                                  <?= (Input::post("problem02"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label long">自分が本当にやりたい事業が<br>分からない</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="problem03" value="1"
                                                  <?= (Input::post("problem03"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label long">自分の事業アイデアに自信がない／具体的な事業計画が定まらない</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="problem04" value="1"
                                                  <?= (Input::post("problem04"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label long">起業について周囲の理解が<br>得られない</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="problem05" value="1"
                                                  <?= (Input::post("problem05"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">起業メンバーが集まらない</span>
                                            </span>
                                        </span>
                                        <!-- ここからメンバー -->
                                        <span class="check-inner-wrap">
                                            <span class="wpcf7-form-control wpcf7-checkbox checkbox-container">
                                                <span class="wpcf7-list-item">
                                                    <input type="checkbox" name="problem06" value="1"
                                                      <?= (Input::post("problem06"))?'checked="checked"':'' ?> />
                                                    <span class="wpcf7-list-item-label">エンジニア（IT系）</span>
                                                </span>
                                            </span>
                                            <span class="wpcf7-form-control wpcf7-checkbox checkbox-container">
                                                <span class="wpcf7-list-item">
                                                    <input type="checkbox" name="problem07" value="1"
                                                      <?= (Input::post("problem07"))?'checked="checked"':'' ?> />
                                                    <span class="wpcf7-list-item-label">エンジニア（IT系以外）</span>
                                                </span>
                                            </span>
                                            <span class="wpcf7-form-control wpcf7-checkbox checkbox-container">
                                                <span class="wpcf7-list-item">
                                                    <input type="checkbox" name="problem08" value="1"
                                                      <?= (Input::post("problem08"))?'checked="checked"':'' ?> />
                                                    <span class="wpcf7-list-item-label">営業</span>
                                                </span>
                                            </span>
                                            <span class="wpcf7-form-control wpcf7-checkbox checkbox-container">
                                                <span class="wpcf7-list-item">
                                                    <input type="checkbox" name="problem09" value="1"
                                                      <?= (Input::post("problem09"))?'checked="checked"':'' ?> />
                                                    <span class="wpcf7-list-item-label">経理・財務</span>
                                                </span>
                                            </span>
                                            <span class="wpcf7-form-control wpcf7-checkbox checkbox-container">
                                                <span class="wpcf7-list-item">
                                                    <input type="checkbox" name="problem10" value="1"
                                                      <?= (Input::post("problem10"))?'checked="checked"':'' ?> />
                                                    <span class="wpcf7-list-item-label">社長・経営者</span>
                                                </span>
                                            </span>
                                            <span class="wpcf7-form-control wpcf7-checkbox checkbox-container">
                                                <span class="wpcf7-list-item">
                                                    <input type="checkbox" name="problem11" value="1"
                                                      <?= (Input::post("problem11"))?'checked="checked"':'' ?> />
                                                    <span class="wpcf7-list-item-label">その他</span>
                                                </span>
                                            </span>
                                        </span>
                                        <!-- ここまでメンバー -->
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="problem12" value="1"
                                                  <?= (Input::post("problem12"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label long">立ち上げ資金の目途がつかない／資金調達について教えてほしい</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="problem13" value="1"
                                                  <?= (Input::post("problem13"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">立ち上げ時の顧客の目途がつかない</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="problem14" value="1"
                                                  <?= (Input::post("problem14"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">用地・店舗物件が見つからない</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="problem15" value="1"
                                                  <?= (Input::post("problem15"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label long">創業助成金、創業融資などを受けたいが良くわからない（教えてほしい）</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="problem16" value="1"
                                                  <?= (Input::post("problem16"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">事業計画書の作り方が解らない</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="problem17" value="1"
                                                  <?= (Input::post("problem17"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">創業に伴う手続き・届け出が良く解らない</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="problem18" value="1"
                                                  <?= (Input::post("problem18"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label long">経理について教えてほしい（帳簿の作成、決算処理、確定申告、等）</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="problem19" value="1"
                                                  <?= (Input::post("problem19"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">税金について教えてほしい</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="problem20" value="1"
                                                  <?= (Input::post("problem20"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label long">従業員採用の仕方、<br>留意点など教えてほしい</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="problem21" value="1"
                                                  <?= (Input::post("problem21"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label long">労働保険、社会保険、厚生年金について（手続きについて）教えてほしい</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item" style="margin-bottom:10px;">
                                                <input type="checkbox" name="problem22" value="1"
                                                  <?= (Input::post("problem22"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">その他</span>
                                                <input type="text" name="problem_text" value="<?= Input::post("problem_text") ?>" size="40" class="wpcf7-form-control wpcf7-text text other-text pc" aria-invalid="false" placeholder="任意記入" />
                                            </span>
                                        </span>
                                    </span>
                                    <!-- <span class="wpcf7-list-item sp">
                                    <input type="text" name="problem_text" value="<?= Input::post("problem_text") ?>" size="40" class="wpcf7-form-control wpcf7-text text other-text" aria-invalid="false" placeholder="任意記入" />
                                    </span> -->
                                    <span class="wpcf7-form-control-wrap trouble">
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="problem" value="99" />
                                                <span class="wpcf7-list-item-label">特になし</span>
                                            </span>
                                        </span>
                                    </span>
                                </dd>
                            </dl>
                            <dl class="clearfix">
                                <dt>希望するサービス<br class="pc">（複数回答可）</dt>
                                <dd>
                                    <span class="wpcf7-form-control-wrap desiredservice">
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="wish01" value="1"
                                                  <?= (Input::post("wish01"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">起業ノウハウ系のセミナー・イベント</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="wish02" value="1"
                                                  <?= (Input::post("wish02"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">起業仲間との出会い／コミュニティ</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="wish03" value="1"
                                                  <?= (Input::post("wish03"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">顧客・取引先とのマッチング／交流</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="wish04" value="1"
                                                  <?= (Input::post("wish04"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">投資家とのマッチング／交流</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="wish05" value="1"
                                                  <?= (Input::post("wish05"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label long">専門家相談<br>（社労士、税理士、弁護士等）</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="wish06" value="1"
                                                  <?= (Input::post("wish06"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label long">金融機関（銀行・政策金融公庫・信用保証協会等）相談</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="wish07" value="1"
                                                  <?= (Input::post("wish07"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">プレゼンテーション機会の提供</span>
                                            </span>
                                        </span>
                                        <span class="wpcf7-form-control wpcf7-checkbox checkbox-container one-row">
                                            <span class="wpcf7-list-item">
                                                <input type="checkbox" name="wish08" value="1"
                                                  <?= (Input::post("wish08"))?'checked="checked"':'' ?> />
                                                <span class="wpcf7-list-item-label">ビジネスプランコンテストの開催</span>
                                            </span>
                                        </span>
                                    </span>
                                </dd>
                            </dl>
                        </div>
                        
			<div id="pre-entre-container"><div class="caution-container">
                <h3 class="title">プレアントレメンバー期限について</h3>
                <ul>
                    <li>メンバーズサロンのキャパシティの関係上、プレアントレメンバーの期限を「三か月」とさせていただきます。<br>
                        ※承認された月の翌月から「三か月間」（例：3/1承認された場合、6月末までが有効期間となります）<br>
                        期間満了後も引き続きプレアントレメンバーをご希望の場合はInformation（受付）を通してコンシェルジュの面談を経て継続承認された場合にのみ更新いたします。</li>
                    <li>起業する意思のない人。既に起業している人。目的外で施設を利用しようとする人はプレアントレメンバーにはなれません。</li>
                    <li>プレアントレメンバーの期間満了後も、メンバーとしてラウンジの利用、セミナーへの参加などが可能です。</li>
                </ul>
            </div></div>
            
                        <div class="btn-list clearfix">
                            <div class="btn w160 h60 icon-none back">
                                <div class="btn-inner clear">
                                    <a class="overlay-text" id="reset-btn" href="">
                                        <span class="text en">RESET</span>
                                    </a>
                                    <div class="line"></div>
                                    <div class="line2"></div>
                                </div>
                            </div>
                            <div id="" class="btn">
                                <div class="btn-inner black">
                                    <button id="submit-btn" type="submit" value="Send" class="wpcf7-form-control wpcf7-submit">
                                        <span class="text en">CONFIRM</span><br />
                                    </button>
                                    <div class="line"></div>
                                    <div class="line2"></div>
                                </div>
                            </div>
                        </div><!--btn_list-->
                        <div class="wpcf7-response-output wpcf7-display-none"></div>
                        </form>
                    </div>

                    <div id="event-info-container" style="display:none;">
                        <div id="event-title_text"><?php //echo $_GET['event_title'] ?></div>
                        <div id="event-url_text"><?php //echo $_GET['event_url'] ?></div>
                    </div>

                </div><!-- /.section-contents -->
            </div><!-- /.section-inner -->
        </section><!-- /.section-container -->
