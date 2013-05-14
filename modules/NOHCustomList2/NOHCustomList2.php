<?php

if ( !defined( '_PS_VERSION_' ) )
  exit;
  
class NOHCustomList2 extends Module
{
		
	public function __construct()
	{
		$this->name = 'NOHCustomList2';
		$this->tab = 'others';
		$this->author = 'Sergio Gil Perez';
		$this->version = '1.0';	
		$this->ps_versions_compliancy = array('min' => '1.5', 'max' => '1.6');	
		parent::__construct();
		
		$this->displayName = $this->l('NOHCustom list Promotions');
		$this->description = $this->l('Lista de productos promocionados| created by Noises Of Hill');
	}
	
	/*
	Module instalation, create tables, tabs and hooks
	*/
	public function install()
	{	 	
        Configuration::updateValue('NOHCL2_titulo', '');
        Configuration::updateValue('NOHCL2_productos', '');
        return (parent::install() AND $this->registerHook('displayHeader') 
		 		&& $this->registerHook('NOHCustomList2')
		 	);
	}

	

	public function hookNOHCustomList2()
	{				
		$lista = array();
		if (Configuration::get('NOHCL2_productos') != "")
			$lista = explode("|", Configuration::get('NOHCL2_productos'));
		
		if (count($lista > 0))
		{
			global $smarty;
			$pr = array();
			foreach ($lista as $p ) {
				$pr[] = new Product($p);
			}
			$this->context->smarty->assign(array("pr" => $pr));
			return $this->display(__FILE__, 'NOHCustomList2.tpl');

		}
		else
		{
			return 'no hay productos';
		}
	}
	
	public function uninstall()
	{
		Configuration::deleteByName('NOHCL2_titulo');
		Configuration::deleteByName('NOHCL2_productos');
		return (parent::uninstall());
	}  

	public function getContent()
	{
		$output = null;
		$lista = array();
		$lista = explode("|", Configuration::get('NOHCL2_productos'));

 
		if (Tools::isSubmit('titulo'))
		{
			if (isset($_POST['NOCL2_productsList']))
				$lista = $_POST['NOCL2_productsList'];
			else
				$lista = array();
			Configuration::updateValue('NOHCL2_titulo', Tools::getValue('titulo'));
			Configuration::updateValue('NOHCL2_productos', implode("|", $lista));
			$output .= $this->displayConfirmation($this->l('Settings updated'));			
		}
		
		$products = Product::getProducts(4, 0, 0, 'name', 'ASC');
		$output.= '<form method="post" action="'.$_SERVER['REQUEST_URI'].'" enctype="multipart/form-data">
			<fieldset style="width: 800px;">
    				<div id="items">';					
		
			$output .= '<label>Título de la lista de productos</label>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<input type="text" name="titulo" style="width:500px;" id="titulo" size="12" maxlength="400" value="'.Configuration::get('NOHCL2_titulo').'" />';
			$output .= '</div>';

			$output .= '<select name="NOCL2_productsList[]" multiple size=20>';
			foreach ($products as $p) {
				$output .= '<option VALUE="'.$p['id_product'].'" ';
				if (array_search($p['id_product'], $lista) > -1)
					$output .= 'selected="selected"';
				$output .= '>'.$p['id_product'].' - '.$p['name'].'</option>';
			}
			$output .= '</select>';
			 	 	
 	 		$output .= '
 	 				<br>
					<p>Mantén pulsado <strong>CTRL</strong> para seleccionar varios productos </p>

					<div class="margin-form">

					 <input type="submit" name="FSPAsubmitUpdate" id="FSPAsubmitUpdate" value="'.$this->l('Guardar').'" class="button" />
				</div>
				</div>
				</fieldset>
			</form>';
 	 	
 	 	
 	 	
		
 		return $output;

	}
	
	
}
