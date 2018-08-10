        <div id="preentre" class="section-container">
            <div class="section-inner">
                <div class="section-contents">

                    <p class="lead center">下記内容にお間違いがなければ送信をお願いいたします。</p>

                    <div role="form" class="wpcf7" id="wpcf7-f118-p2-o1" lang="ja" dir="ltr">
                        <form action="" method="post" class="wpcf7-form" novalidate="novalidate">
                            <div style="display: none;">
                                <input type="hidden" name="_wpcf7" value="118" />
                                <input type="hidden" name="_wpcf7_version" value="4.6" />
                                <input type="hidden" name="_wpcf7_locale" value="ja" />
                                <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f118-p2-o1" />
                                <input type="hidden" name="_wpnonce" value="59544dd90d" />
                            </div>
                            <div class="form-wrap clearfix">
                                <dl class="top clearfix">
                                    <dt>起業への意思</dt>
                                    <dd>
                                        <span class="conf-list"><?= $preentre_request->getIntention() ?></span>
                                    </dd>
                                </dl>
                                <dl class="top clearfix">
                                    <dt>どういった事業をお考えですか？</dt>
                                    <dd>
                                        <span class="conf-list"><?= $preentre_request->getBusinessType() ?></span>
                                        <span class="conf-list"><?= $preentre_request->business_type_text ?></span>
                                    <dd>
                                </dl>
                                <dl class="top clearfix">
                                    <dt>起業スタイルは<br class="pc">どのようにお考えですか？</dt>
                                    <dd>
                                        <span class="conf-list"><?= $preentre_request->getBusinessStyle() ?></span>
                                        <span class="conf-list"><?= $preentre_request->business_style_text ?></span>
                                    </dd>
                                </dl>
                                <dl class="top clearfix">
                                    <dt>現在どういったお悩みを<br class="pc">持っていますか？</dt>
                                    <dd>
                                      <?php foreach ($preentre_request->getBusinessProblems() as $key => $problem): ?>
                                        <span class="conf-list <?= $preentre_request->getBusinessProblemClass($key) ?>">
                                          <?= $problem ?>
                                        </span>
                                      <?php endforeach; ?>
                                      <span class="conf-list"><?= $preentre_request->problem_text ?></span>
                                    </dd>
                                </dl>
                                <dl class="top clearfix">
                                    <dt>希望するサービス</dt>
                                    <dd>
                                      <?php foreach ($preentre_request->getWishes() as $key => $wish): ?>
                                        <span class="conf-list">
                                          <?= $wish ?>
                                        </span>
                                      <?php endforeach; ?>
                                    </dd>
                                </dl>
                            </div>

                            <div class="btn-list clearfix">
                                <div class="btn w160 h60 icon-none back">
                                    <div class="btn-inner clear">
                                        <a class="overlay-text" id="reset-btn" onClick="history.back(); return false;">
                                            <span class="text en">BACK</span>
                                        </a>
                                        <div class="line"></div>
                                        <div class="line2"></div>
                                    </div>
                                </div>
                                <div id="submit-btn" class="btn">
                                    <div class="btn-inner black">
                                        <button id="submit-btn" type="submit" value="Send" class="wpcf7-form-control wpcf7-submit" onClick="ga('send', 'event', 'プレアントレ登録フォーム送信', 'クリック', 'ボディ', 1);">
                                            <span class="text en">SEND</span><br />
                                        </button>
                                        <div class="line"></div>
                                        <div class="line2"></div>
                                    </div>
                                </div>
                            </div><!--btn_list-->
                            <div class="wpcf7-response-output wpcf7-display-none"></div>
                        </form>
                    </div>

                </div><!-- /.section-contents -->
            </div><!-- /.section-inner -->
        </section><!-- /.section-container -->
