<?php

if ( !defined( '_PS_VERSION_' ) )
  exit;
  
class NOHCustomList extends Module
{
		
	public function __construct()
	{
		$this->name = 'NOHCustomList';
		$this->tab = 'others';
		$this->author = 'Sergio Gil Perez';
		$this->version = '1.0';	
		$this->ps_versions_compliancy = array('min' => '1.5', 'max' => '1.6');	
		parent::__construct();
		
		$this->displayName = $this->l('NOHCustomList');
		$this->description = $this->l('Lista de productos personalizadas | created by Noises Of Hill');
	}
	
	/*
	Module instalation, create tables, tabs and hooks
	*/
	public function install()
	{	 	
        Configuration::updateValue('NOHCL_titulo', '');
        Configuration::updateValue('NOHCL_productos', '');
        return (parent::install() AND $this->registerHook('displayHeader') 
		 		&& $this->registerHook('NOHCustomList')
		 	);
	}

	

	public function hookNOHCustomList()
	{				
		$lista = array();
		if (Configuration::get('NOHCL_productos') != "")
			$lista = explode("|", Configuration::get('NOHCL_productos'));
		
		if (count($lista > 0))
		{
			global $smarty;
			$pr = array();
			foreach ($lista as $p ) {
				$pr[] = new Product($p);
			}
			$this->context->smarty->assign(array("pr" => $pr));
			return $this->display(__FILE__, 'NOHCustomList.tpl');

		}
		else
		{
			return 'no hay productos';
		}
	}
	
	public function uninstall()
	{
		Configuration::deleteByName('NOHCL_titulo');
		Configuration::deleteByName('NOHCL_productos');
		return (parent::uninstall());
	}  

	public function getContent()
	{
		$output = null;
		$lista = array();
		$lista = explode("|", Configuration::get('NOHCL_productos'));

 
		if (Tools::isSubmit('titulo'))
		{
			if (isset($_POST['NOCL_productsList']))
				$lista = $_POST['NOCL_productsList'];
			else
				$lista = array();
			Configuration::updateValue('NOHCL_titulo', Tools::getValue('titulo'));
			Configuration::updateValue('NOHCL_productos', implode("|", $lista));
			$output .= $this->displayConfirmation($this->l('Settings updated'));			
		}
		
		$products = Product::getProducts(4, 0, 0, 'name', 'ASC');
		$output.= '<form method="post" action="'.$_SERVER['REQUEST_URI'].'" enctype="multipart/form-data">
			<fieldset style="width: 800px;">
    				<div id="items">';					
		
			$output .= '<label>Título de la lista de productos</label>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<input type="text" name="titulo" style="width:500px;" id="titulo" size="12" maxlength="400" value="'.Configuration::get('NOHCL_titulo').'" />';
			$output .= '</div>';

			$output .= '<select name="NOCL_productsList[]" multiple size=20>';
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
	
	public function displayForm()
	{	
		$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
		$fields_form[0]['form'] = array(
			'legend' => array(
				'title' => $this->l('Settings'),
			),
			'input' => array(
				array(
					'type' => 'text',
					'label' => $this->l('Título'),
					'name' => 'titulo',
					'size' => 40,
				),
				
			),
			'submit' => array(
				'title' => $this->l('Save'),
				'class' => 'button'
			)
		);
		 
		$helper = new HelperForm();
		 
		// Module, token and currentIndex
		$helper->module = $this;
		$helper->name_controller = $this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
		 
		// Language
		$helper->default_form_language = $default_lang;
		$helper->allow_employee_form_lang = $default_lang;
		 
		// Title and toolbar
		$helper->title = $this->displayName;
		$helper->show_toolbar = true;        // false -> remove toolbar
		$helper->toolbar_scroll = true;      // yes - > Toolbar is always visible on the top of the screen.
		$helper->submit_action = 'submit'.$this->name;
		$helper->toolbar_btn = array(
			'save' =>
			array(
				'desc' => $this->l('Save'),
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
				'&token='.Tools::getAdminTokenLite('AdminModules'),
			),
			'back' => array(
				'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
				'desc' => $this->l('Back to list')
			)
		);
		 
		// Load current value
		$helper->fields_value['titulo'] = Configuration::get('NOHCL_titulo');
		
		 
		return $helper->generateForm($fields_form);
	}	
	
}
