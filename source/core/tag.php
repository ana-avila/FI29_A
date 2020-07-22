<?php
class Tag
{
	public $tag;
	public $tagNum;
	public $we;
	public $urlaub;
	public $feiertag;
	public $feiertagName;
	
	function __construct(string $tag, int $tagNum, bool $we, bool $urlaub = false, bool $feiertag = false, string $feiertagName = null)
	{
		$this->tag = $tag;
		$this->tagNum = $tagNum;
		$this->we = $we;
		$this->urlaub = $urlaub;
		$this->feiertag = $feiertag;
		$this->feiertagName = $feiertagName;
	}
}
?>