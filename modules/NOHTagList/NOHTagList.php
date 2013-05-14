<?php

if ( !defined( '_PS_VERSION_' ) )
  exit;
  
class NOHTagList extends Module
{
		
	public function __construct()
	{
		$this->name = 'NOHTagList';
		$this->tab = 'others';
		$this->author = 'Sergio Gil Perez';
		$this->version = '1.0';	
		$this->ps_versions_compliancy = array('min' => '1.5', 'max' => '1.6');	
		parent::__construct();
		
		$this->displayName = $this->l('NOHTagList');
		$this->description = $this->l('Lista de productos por etiquetas | created by Noises Of Hill');
	}
	
	/*
	Module instalation, create tables, tabs and hooks
	*/
	public function install()
	{	 	
        Configuration::updateValue('NOHTL_titulo', '');
        Configuration::updateValue('NOHTL_productos', '');
        Configuration::updateValue('NOHTL_etiqueta', '');
        Configuration::updateValue('NOHTL_NumProductos',5);
        return (parent::install() AND $this->registerHook('displayHeader') 
		 		&& $this->registerHook('NOHTabList')
		 	);
	}

	

	public function hookNOHTabList()
	{				
		if (Configuration::get('NOHTL_etiqueta') != "")
		{
			

			$sql = 'SELECT p.id_product,l.name ';
			$sql .= 'FROM '._DB_PREFIX_.'product AS p, '._DB_PREFIX_.'product_lang AS l ';
			$sql .= "WHERE p.id_product IN( SELECT id_product FROM "._DB_PREFIX_."product_tag WHERE id_tag = (SELECT id_tag FROM "._DB_PREFIX_."tag WHERE name='".Configuration::get('NOHTL_etiqueta')."')) AND l.id_product = p.id_product AND l.id_lang = 4";
			$array = Db::getInstance()->executeS($sql);
			global $smarty;
			if (count($array) <= Configuration::get('NOHTL_NumProductos'))
				$this->context->smarty->assign(array("pr" => $array));
			else
				$this->context->smarty->assign(array("pr" => array_slice($array, 0, Configuration::get('NOHTL_NumProductos'))));
				 
			return $this->display(__FILE__, 'NOHTagList.tpl');

		}
		else
		{
			return 'no hay productos';
		}
	}
	
	public function uninstall()
	{
		Configuration::deleteByName('NOHTL_titulo');
		Configuration::deleteByName('NOHTL_productos');
		Configuration::deleteByName('NOHTL_etiqueta');
		Configuration::deleteByName('NOHTL_NumProductos');
		return (parent::uninstall());
	}  

	public function getContent()
	{
		$output = null;
		$lista = array();
		$lista = explode("|", Configuration::get('NOHTL_productos'));

 
		if (Tools::isSubmit('titulo'))
		{
			
			Configuration::updateValue('NOHTL_titulo', Tools::getValue('titulo'));
			Configuration::updateValue('NOHTL_etiqueta', Tools::getValue('etiqueta'));
			Configuration::updateValue('NOHTL_NumProductos', Tools::getValue('numProductos'));

			$output .= $this->displayConfirmation($this->l('Settings updated'));			
		}
		
		$products = Product::getProducts(4, 0, 0, 'name', 'ASC');
		$output.= '<form method="post" action="'.$_SERVER['REQUEST_URI'].'" enctype="multipart/form-data">
			<fieldset style="width: 800px;">
    				<div id="items">';					
		
			$output .= '<label>Título de la lista de productos</label>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<input type="text" name="titulo" style="width:500px;" id="titulo" size="12" maxlength="400" value="'.Configuration::get('NOHTL_titulo').'" />';
			$output .= '</div>';

			$output .= '<label>Etiqueta</label>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<input type="text" name="etiqueta" style="width:500px;" id="etiqueta" size="12" maxlength="400" value="'.Configuration::get('NOHTL_etiqueta').'" />';
			$output .= '</div>';

			$output .= '<label>Número de productos que quieres visualizar</label>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<input type="text" name="numProductos" style="width:500px;" id="numProductos" size="12" maxlength="400" value="'.Configuration::get('NOHTL_NumProductos').'" />';
			$output .= '</div>';

 	 		$output .= '
 	 				<br>
					<div class="margin-form">
					 <input type="submit" name="FSPAsubmitUpdate" id="FSPAsubmitUpdate" value="'.$this->l('Guardar').'" class="button" />
				</div>
				</div>
				</fieldset>
			</form>';
 	 	
 	 	
 	 	
		
 		return $output;

	}
	
	
	
}
