<?php 
class Conf
{
	private array $conf;
	public function SetConfiguration($url)
	{
		$this->conf['url'] = $url;
	}
	public function GetConfiguration()
	{
		return $this->conf; 
	}
}