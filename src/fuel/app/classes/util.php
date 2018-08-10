<?php
class Util {
	// 県名
	public static function pref_name($id, $no_exists = '') {
		Config::load('master', true); // 定数ファイル
		$prefecture_codes = Config::get('master.PREFECTURE_CODES');
		if (array_key_exists($id, $prefecture_codes))
			$rtn = $prefecture_codes[$id];
		else
			$rtn = $no_exists;
		return $rtn;
	}
	public static function pref_code($name, $no_exists = '') {
		Config::load('master', true); // 定数ファイル
		$prefecture_codes = Config::get('master.PREFECTURE_CODES');
		if ($code = array_search($name, $prefecture_codes)) {
			return $code;
		} else {
			return $no_exists;
		}
	}

	// 時間の差を時間単位で返す（端数は繰り上げ）
	public static function diff_hour($time1, $time2) {
		if (empty($time1)) return '';
		if (empty($time2)) return '';
		if (($diff_time = $time1 - $time2) < 0) return '';
		return ceil($diff_time / 60 / 60);
	}

	// CSVインポート
	public static function replace_fgetcsv($handle){
		$csv_array = fgetcsv($handle);
		if(!$csv_array){
			return false;
		}
		//foreach($csv_array  as $key =>$each){
		//	$csv_array[$key] = mb_convert_kana($each,'ak');
		//}
		return $csv_array;
	}

	/**
	 * ファイル名に使用できない文字を全角文字に変換する
	 * Excelは全角ダブルクォーテーションで不具合でるのでシングルにする
	 *
	 * @param string $value 変換対象文字列
	 * @return string 変換後文字列
	 */
	public static function convertFileName($value)
	{
		$value = str_replace("\\", "￥", $value);
		$value = str_replace("/", "／", $value);
		$value = str_replace(":", "：", $value);
		$value = str_replace("*", "＊", $value);
		$value = str_replace("?", "？", $value);
		$value = str_replace("\"", "'", $value);
		$value = str_replace("”", "'", $value);
		$value = str_replace("<", "＜", $value);
		$value = str_replace(">", "＞", $value);
		$value = str_replace("|", "｜", $value);
		return $value;
	} 
}
