<?php
	function ConvertToDuration($time)
	{
		if($time >= 24)
		{
			$days = (int)($time / 24);
			$hours = (int)($time % 24);
			$minutes = (int)(($time - (int)$time) * 60);
			$fulldate = "".$days." Jours ".$hours." Heures ".$minutes." Minutes";
		}
		else {
			$hours = (int)$time;
			$minutes = (int)(($time - (int)$time) * 60);
			$fulldate = "".$hours." Heures ".$minutes." Minutes";
			}	
			return $fulldate;
	}

	function ConvertToDurationHour($time)
	{
		if($time >= 60)
		{
			$hours = (int)($time / 60);
			$minutes = (int)(($time - (int)$time));
			$fulldate = "".$hours." Heures ".$minutes." Minutes";
		}
		else {
			$minutes = (int)$time;
			$fulldate = "".$minutes." Minutes";
			}	
			return $fulldate;
	}

?>