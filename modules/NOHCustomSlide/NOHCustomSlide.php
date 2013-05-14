<?php

include_once(_PS_MODULE_DIR_.'NOHCustomSlide/classes/NOHCustomDiapo.php');

if ( !defined( '_PS_VERSION_' ) )
  exit;
  
class NOHCustomSlide extends Module
{
		
	public function __construct()
	{
		$this->name = 'NOHCustomSlide';
		$this->tab = 'slideshows';
		$this->author = 'Sergio Gil Perez';
		$this->version = '1.0';	
		$this->ps_versions_compliancy = array('min' => '1.5', 'max' => '1.6');	
		parent::__construct();
		
		$this->displayName = $this->l('NoisesOfHill - Custom Slide');
		$this->description = $this->l('Custom Slide | created by Noises Of Hill');		
		
		
        $this->tabClassName = 'AdminNOHCustomSlide';
        $this->tabParentName = 'AdminCatalog';	
				
		$this->lang = $this->context->language->id;
		if ($this->lang > 6) $this->lang = 4;	
	}
	
	/*
	Module instalation, create tables, tabs and hooks
	*/
	public function install()
	{	 	
        if (!$id_tab) {
        	$tab = new Tab();
            $tab->class_name = $this->tabClassName;
            $tab->id_parent = Tab::getIdFromClassName($this->tabParentName);
            $tab->module = $this->name;
            $languages = Language::getLanguages();
            foreach ($languages as $language)
                $tab->name[$language['id_lang']] = $this->displayName;
            $tab->add();
    	}			
		
        $this->createTables();		 
		
		return (parent::install() AND $this->registerHook('displayHeader') 
		 	&& $this->registerHook('displayHome'));
	}

	public function hookDisplayHeader()
	{
		$this->context->controller->addJS(($this->_path).'js/slides.min.jquery.js', 'all');
		$this->context->controller->addJS(($this->_path).'js/jsStart.js', 'all');
		$this->context->controller->addCSS(($this->_path).'css/NOHCustomSlide.css', 'all');
	}

	public function hookDisplayHome()
	{				
		global $smarty;
		$diapositivas = NOHCustomDiapo::getQuery();
		if (count($diapositivas) > 0)
		{
			$this->context->smarty->assign(array("diapositivas" => $diapositivas));
			return $this->display(__FILE__, 'NOHCustomSlide.tpl');
		}
	}
	
	public function uninstall()
	{
		$id_tab = Tab::getIdFromClassName($this->tabClassName);
    	if ($id_tab) {
		     $tab = new Tab($id_tab);
		     $tab->delete();
		}
		$this->destroyTables();
		
		return (parent::uninstall());
	}  
	
	
	
	private function createTables()
	{	
		
		$querySlide = 'CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'nohCustomSlide (';
		$querySlide.='id_nohCustomSlide int(10) unsigned NOT NULL Key AUTO_INCREMENT,';
		$querySlide.='img_url varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , ';
		$querySlide.='img_alt varchar(200)  CHARACTER SET utf8 COLLATE utf8_general_ci NULL , ';
		$querySlide.='img_title varchar(200)  CHARACTER SET utf8 COLLATE utf8_general_ci NULL , ';
		$querySlide.='title varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , ';
		$querySlide.='description varchar(99999) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,';	
		$querySlide.='url varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , ';
		$querySlide.='url_text varchar(200)  CHARACTER SET utf8 COLLATE utf8_general_ci NULL )';
			
		Db::getInstance()->Execute($querySlide);		
		
	}
	
	private function destroyTables() {		
		$query = 'DROP table '._DB_PREFIX_.'nohCustomSlide';
		Db::getInstance()->Execute($query);
	}	


	
	
	
	
	
	
}