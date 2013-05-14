<?php

if ( !defined( '_PS_VERSION_' ) )
  exit;
  

class menuTopOjeda extends Module
{
	private $lang = 4;	
	
	public function __construct()
	{
		$this->name = 'menuTopOjeda';
		$this->tab = 'others';
		$this->author = 'Sergio Gil Perez';
		$this->version = '1.0';	
		parent::__construct();
		
		$this->displayName = $this->l('NoisesOfHill - menu Top Ojeda');
		$this->description = $this->l('menu Top Ojeda | created by Noises Of Hill');		
		
		
	}
	
	
	public function install() {       
		
		return (parent::install() AND $this->registerHook('menuTopOjeda')
			);
	}

	public function hookMenuTopOjeda() {
		return $this->display(__FILE__, 'menuTopOjeda.tpl');
  	}
	
	public function uninstall()
	{	
		return (parent::uninstall());
	}
	
}