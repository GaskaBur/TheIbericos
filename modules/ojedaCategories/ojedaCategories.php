<?php

if ( !defined( '_PS_VERSION_' ) )
  exit;
  
class ojedaCategories extends Module
{
		
	public function __construct()
	{
		$this->name = 'ojedaCategories';
		$this->tab = 'others';
		$this->author = 'Sergio Gil Perez';
		$this->version = '1.0';	
		$this->ps_versions_compliancy = array('min' => '1.5', 'max' => '1.6');	
		parent::__construct();
		
		$this->displayName = $this->l('NoisesOfHill - Muestras las categorias en layout Principal');
		$this->description = $this->l('Ojeda Categorias | created by Noises Of Hill');
	}
	
	/*
	Module instalation, create tables, tabs and hooks
	*/
	public function install()
	{	 	
        return (parent::install() AND $this->registerHook('displayHeader') 
		 	&& $this->registerHook('displayHome')
		 	&& $this->registerHook('ojedaCategories')
		 	);
	}

	public function hookDisplayHeader()
	{
		
	}


	public function hookDisplayHome()
	{				
		
		$categories = array();
		echo Tools::getValue('category');

		foreach (Category::getHomeCategories(Context::getContext()->language->id) as $key ) {
			$c = array();
			$c['cat'] = $key;
			$c['cat']['subCat'] = Category::getChildren($key['id_category'],Context::getContext()->language->id);
			$categories[]= $c;
		};
		//var_dump($categories);
		//print_r($categories);
		global $smarty;
		$this->context->smarty->assign(array("categories" => $categories));
		return $this->display(__FILE__, 'ojedaCategories.tpl');
	}

	public function hookOjedaCategories()
	{				
		
		$categories = array();
		foreach (Category::getHomeCategories(Context::getContext()->language->id) as $key ) {
			$c = array();
			$c['cat'] = $key;
			$c['cat']['subCat'] = Category::getChildren($key['id_category'],Context::getContext()->language->id);
			$categories[]= $c;
		};

		//var_dump($categories);
		//print_r($categories);
		global $smarty;
		$this->context->smarty->assign(array("categories" => $categories));
		return $this->display(__FILE__, 'ojedaCategories.tpl');
	}
	
	public function uninstall()
	{
		return (parent::uninstall());
	}  
	
}