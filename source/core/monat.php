<?php
class Monat
{
	public $monat;
	public $monatNum;
	public $tage = array();
	
	function __construct(string $monat, int $monatNum)
	{
		$this->monat = $monat;
		$this->monatNum = $monatNum;
	}
}
?>