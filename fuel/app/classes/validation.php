<?php 

/**
 * Extende as validações padrão do Validation
 *
 * Adiciona validação de datas e horários sobre arrays
 *
 */
class Validation extends Fuel\Core\Validation {

	public function _validation_valid_date($date)
	{
		$regex = '/(((0[1-9]|[1-2][0-9]|3[0-1])\/(01|03|05|07|08|10|12))|((0[1-9]|[1-2][0-9]|30)\/(04|06|09|11))|((0[1-9]|[1-2][0-9])\/02))\/(19[0-9]{2})|(20[0-9]{2})/';
		return preg_match($regex, $date);
	}

	public function _validation_valid_time($time)
	{
		$regex = '/([01][0-9]|2[0-3])[h:][0-5][0-9]/';
		return preg_match($regex, $time);
	}

	public function _validation_date_array($dates)
	{
		foreach ($dates as $date)
		{
			if ( ! $this->_validation_valid_date($date)) return 0;
		}
		return 1;
	}

	public function _validation_time_array($times)
	{
		foreach ($times as $time)
		{
			if ( ! $this->_validation_valid_time($time)) return 0;
		}
		return 1;
	}


}
