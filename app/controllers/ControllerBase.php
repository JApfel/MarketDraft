<?php

	class ControllerBase	{
	
		function convertTimeZone($dateString)	{
			$date = new DateTime($dateString, new DateTimeZone('America/New_York'));
			$date->setTimezone(new DateTimeZone('UTC'));
			
			return $date;
		}
	}