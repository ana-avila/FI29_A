<?php
class Jahr
{
	public $jahr;
	private $jahrNum;
	public $schaltJahr;
	public $monate = array();
	
	function __construct(string $jahr)
	{
		$this->jahr = $jahr;
		$this->jahrNum = (int) $jahr;
		if($this->jahrNum % 400 == 0)
		{
			$this->schaltJahr = true;
		}
		elseif($this->jahrNum % 100 == 0 && $this->jahrNum % 400 != 0)
		{
			$this->schaltJahr = false;
		}
		elseif($this->jahrNum % 4 == 0 && $this->jahrNum % 100 != 0)
		{
			$this->schaltJahr = true;
		}
		else
		{
			$this->schaltJahr = false;
		}
		
	}
}
?>