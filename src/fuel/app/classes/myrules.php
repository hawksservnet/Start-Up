<?php
// app/classes/myrules.php
class MyRules
{
	// 重複チェック
	// ソフトデリート対応
	// update対応
	public static function _validation_unique($val, $table_field, $id = null)
	{
		list($table, $field) = explode('.', $table_field);
		if (empty($id)) {
			$result = DB::select("$field")
				->where('deleted_at', null)
				->where($field, '=', $val)
				->from($table)->execute();
		} else {
			$result = DB::select("$field")
				->where('deleted_at', null)
				->where('id', '!=', $id)
				->where($field, '=', $val)
				->from($table)->execute();
		}
		return ! ($result->count() > 0);
	}
	public static function _validation_unique2($val, $table_field, $id = null)
	{
		list($table, $field) = explode('.', $table_field);
		if (empty($id)) {
			$result = DB::select("$field")
				->where($field, '=', $val)
				->from($table)->execute();
		} else {
			$result = DB::select("$field")
				->where('id', '!=', $id)
				->where($field, '=', $val)
				->from($table)->execute();
		}
		return ! ($result->count() > 0);
	}
	/**
	 * 金額は10円単位
	 */
	public static function _validation_price_unit($val, $unit = 10)
	{
		if (empty($val % $unit)) {
			// 10円単位
			return true;
		} else {
			return false;
		}
	}
	/**
	 * フィールド以上の金額であること
	 */
	public static function _validation_ge_field($val, $field)
	{
		$valid = Validation::active();
		if (empty($val)) return true;
		if (empty($valid->input($field))) return true;
		
		if ($val < $valid->input($field)) {
			$valid->set_message('ge_field', ':label には:param:2以上の金額を入力してください。');
			return false;
		}
		return true;
	}
	/**
	 * フィールドと同じ値であること
	 */
	public static function _validation_eq_field($val, $field)
	{
		$valid = Validation::active();
		if (empty($val)) return true;
		if (empty($valid->input($field))) return true;
		
		if ($val != $valid->input($field)) {
			$valid->set_message('eq_field', ':label には:param:2と同じ値を入力してください。');
			return false;
		}
		return true;
	}
	/**
	 * 半角英数
	 */
	public static function _validation_alphanum($val, $add_pattern = '')
	{
		$valid = Validation::active();
		if (!empty($val)) {
			if (preg_match("/^[a-zA-Z0-9". $add_pattern ."]+$/", $val)) {
				return true;
			} else {
				$valid->set_message('alphanum', ':label には半角英数字で入力してください。');
				return false;
			}
		}
		return true;
	}
	/**
	 * ひらがな
	 */
	public static function _validation_hiragana($val)
	{
		$valid = Validation::active();
		if (!empty($val)) {
			if (preg_match("/^[ぁ-ん]+$/u", $val)) {
				return true;
			} else {
				$valid->set_message('hiragana', ':label にはひらがなで入力してください。');
				return false;
			}
		}
		return true;
	}
	/**
	 * 半角数字
	 */
	public static function _validation_num($val, $add_pattern = '')
	{
		$valid = Validation::active();
		if (!empty($val)) {
			if (preg_match("/^[0-9". $add_pattern ."]+$/", $val)) {
				return true;
			} else {
				$valid->set_message('num', ':label には半角数字で入力してください。');
				return false;
			}
		}
		return true;
	}
	/**
	 * 郵便番号は半角７桁、ハイフン付き
	 */
	public static function _validation_zip($val)
	{
		$valid = Validation::active();
		if (isset($val)) {
			if (preg_match("/^\d{3}-\d{4}$/", $val)) {
				return true;
			} else {
				$valid->set_message('zip', ':label には７桁の半角数字（ハイフン付き）で入力してください。');
				return false;
			}
		}
		return true;
	}
	/**
	 * 電話番号
	 */
	public static function _validation_phone($val)
	{
		$valid = Validation::active();
		if (!empty($val)) {
			if (preg_match("/^[0-9]+-[0-9-]+$/", $val)) {
				return true;
			} else {
				$valid->set_message('phone', ':label にはハイフン付き半角数字で入力してください。');
				return false;
			}
		}
		return true;
	}
}
