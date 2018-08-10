$(function() {
	// 表示しているリストの開催月を抽出
	var selector_options = [];
	$(".event-item").each(function() {
		var item_class = $(this).attr('class').match(/start(\S*)/);
		var option = item_class[1];
		if (selector_options.indexOf(option) < 0) {
			selector_options.push(option);
		}
	})
	// 開催月から絞り込むセレクターのオプションを設定する
	$.each(selector_options, function(i,value) {
		var option = '<option value="'+ value +'">'+ value +'</option>';
		$(".event-select-group select").append(option);
	})
	// セレクター選択されたら、そのクラスだけを表示する
	$(".event-select-group select").change(function() {
		var item_class = $(this).val();
		if (item_class == '') {
			// 全部表示
			$(".event-item").css('display', 'block')
		} else {
			// 選択されたクラスだけ表示
			$(".event-item").css('display', 'none')
			$(".start"+ item_class).css('display', 'block')
		}
	});
})
