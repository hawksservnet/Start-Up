<?php

/**
 * The companies detail presenter.
 */
class Presenter_Admin_Companies_detail extends Presenter
{
	/**
	 *
	 */
	public function view()
	{
		// 設立年月
		if (!empty($this->company->establish_date)
		&&         $this->company->establish_date != '0000-00-00') {
			$this->company->establish_year = substr($this->company->establish_date, 0, 4);
			$this->company->establish_month = substr($this->company->establish_date, 5, 2);
		} else {
			$this->company->establish_year = '';
			$this->company->establish_month = '';
		}
	}
}
