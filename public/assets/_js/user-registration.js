function Contact(){

    var validationFlg = false;

    //バリデートテキスト
    var requiredTxt = "<span class='error'>必須項目です</span>",
        hiraganaTxt = "<span class='error'>ひらがなで入力してください。</span>",
        katakanaTxt = "<span class='error'>カタカナで入力してください。</span>",
        zipTxt = "<span class='error'>郵便番号を正しく入力して下さい。</span>",
        telTxt = "<span class='error'>電話番号を正しく入力して下さい。</span>",
        mailTxt = "<span class='error'>メールアドレスの形式が異なります。</span>",
        mailcheckTxt = "<span class='error'>メールアドレスと一致しません。</span>";

    var Target = "",
    Validate = "";

    var $t = $("#form input,#form select,#form textarea");

    //バリデート
    var formValidation = function(Target){

        //エラーの初期化
        if(Target == "all"){
            $("#form span.error").remove();
            $("#form input.error,#form select.error,#form textarea.error").removeClass("error");
            Validate = $(":text,[type=email],[type=tel],select,radio,checkbox,textarea").filter(".required");
        }else{
            Target.parent("dd").find("span.error").remove();
            Target.removeClass("error");
            Validate = Target;
        }

        Validate.each(function(){

            //必須項目のチェック
            $(this).filter(".required").each(function(){

                var thisID = $(this).attr("id");

                //ひらがなのチェック
                if(thisID == "hiragana"){
                    if($(this).val()==""){
                        $(this).parent("dd").append(requiredTxt);
                    }else{
                        if(!$(this).val().match(/^[ぁ-ろわをんー 　\r\n\t]*$/)){
                            $(this).parent("dd").append(hiraganaTxt);
                        }
                    }
                }
                //カタカナのチェック
                else if(thisID == "katakana"){
                    if($(this).val()==""){
                        $(this).parent("dd").append(requiredTxt);
                    }else{
                        if(!$(this).val().match(/^[ァ-ロワヲンー 　\r\n\t]*$/)){
                            $(this).parent("dd").append(katakanaTxt);
                        }
                    }
                }
                //郵便番号のチェック
                else if(thisID == "zip"){
                    if($(this).val()==""){
                        $(this).parent("dd").append(requiredTxt);
                    }else{
                        if(!$(this).val().match(/^[0-9\-]+$/) || $(this).val().length < 7){
                            $(this).parent("dd").append(zipTxt);
                        }
                    }
                }
                //メールアドレスのチェック
                else if(thisID == "email"){
                    if($(this).val()==""){
                        $(this).parent("dd").append(requiredTxt);
                    }else{
                        if(!$(this).val().match(/.+@.+\..+/g)){
                            $(this).parent("dd").append(mailTxt);
                        }
                    }
                }
                //メールアドレス確認のチェック
                else if(thisID == "emailcheck"){
                    if($(this).val()==""){
                        $(this).parent("dd").append(requiredTxt);
                    }else if($(this).val()!=$("input[name="+$(this).attr("name").replace(/^(.+)check$/, "$1")+"]").val()){
                        $(this).parent("dd").append(mailcheckTxt);
                    }
                }

                //電話番号のチェック
                else　if($(this).attr("type") == "tel"){
                    if($(this).val()==""){
                        $(this).parent("dd").append(requiredTxt);
                    }else{
                        if(!$(this).val().match(/^[0-9\-]+$/) || $(this).val().length < 10){
                            $(this).parent("dd").append(telTxt);
                        }
                    }
                }
                //必須項目のチェック
                else{
                    if($(this).val()==""){
                        $(this).parent("dd").append(requiredTxt);
                    }
                }
            });

            $("span.error").each(function(){
                $(this).parent("dd").find('input,select,textarea').addClass("error");
            });

        });

        if($("#form span.error")[0]){
            //エラーがある場合は確認へ行かせない
            validationFlg　= false;
        }else{
            //エラー無し
            validationFlg　= true;
        }
    }

    /* [ 画面読み込み時に入力状況をチェック ] */
    for(var i=0; $t.length>i; i++){
        if($t.eq(i).val()!="") $t.eq(i).parent().prev().addClass("focus");
    }


    $t.blur(function(){

        if($(this).val() == ""){
            $(this).parent().removeClass("focus");
        }
        //バリデート通す
        Target = $(this);
        formValidation(Target);

    });

    $t.focus(function(){

        $(this).parent().addClass("focus");

    });

    //サブミットした時
    $('#form').submit(function(){

        //バリデート通す
        Target = "all";
        formValidation(Target);

        //バリデート通ればサブミット
        if(validationFlg){
            //SUBMIT!!!
        }else{
            var p = $("#form").offset().top;
            $('html,body').animate({ scrollTop: p }, 'fast');
            return false;
        }
    });

    //リセットおした時
    $('#reset-btn').on("click",function(){
        $("span.error").remove();
        $("#form .error").removeClass("error");
        var p = $("#form").offset().top;
        $('html,body').animate({ scrollTop: p }, 'fast' ,function(){
             $("#form dd").removeClass("focus");
            _placeholder();
        });
    });

    //[ 置換 ]
    //--------------------------------------------------
    //[ 半角へ変換 ]
    $('input').change(function(){
        if($(this).attr("type") != "text") return;
        if(!$(this).attr("id").match(/tel|email|email_confirm/g)) return;
        var txt  = $(this).val();
        var han = txt.replace(/[Ａ-Ｚａ-ｚ０-９]/g,function(s){return String.fromCharCode(s.charCodeAt(0)-0xFEE0)});
        $(this).val(han);
    });

    //[ スマホ用プレイスホルダー ]
    //--------------------------------------------------

    var _placeholder = function(){
        $('.placeholder').remove();
        var SMPplaceholder = [];
        if(device.size == "sp"){
            for(var i=0; $('#form').find('input,textarea').length>i; i++){
                if($('#form').find('input,textarea').eq(i).val() == ""){
                    SMPplaceholder[i] = $('#form').find('input,textarea').eq(i).parents('dl').children('dt').text();
                    $('#form').find('input,textarea').eq(i).parents('dl').children('dd').append("<span class='placeholder'>"+SMPplaceholder[i]+"</span>");
                }else{
                    $('#form').find('input,textarea').eq(i).parents('dl').addClass("focus").find(".placeholder").remove();
                }
            }
        }
    }

    _placeholder();
    $w.on("load resize",function(){
    	_placeholder();
	});

    $(document).ready(function(){
        _placeholder();
    });

    //[ パラメータによるお問い合わせの種類変更 ]
    //--------------------------------------------------

    var _contacttype = function(){
        var url = location.href;
        params = url.split("?");
        switch (params[1]){
            case 'recruit':
            $('select[name=contacttype]').find('option').eq(3).prop('selected',true);
            break;
        }
    }

    _contacttype();

}