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
		
		$this->displayName = $this->l('NOH Home Featured');
		$this->description = $this->l('Lista de productos personalizadas | created by Noises Of Hill');
	}
	
	/*
	Module instalation, create tables, tabs and hooks
	*/
	public function install()
	{	 	
        //Configuration::updateValue('NOHHF_Titulo', '');
        //Configuration::updateValue('NOHHF_SubTitulo', '');
        Configuration::updateValue('NOHHF_Productos', '');
		Configuration::updateValue('NOHHF_verMas', 2);
        return (parent::install() AND $this->registerHook('displayHeader') 
		 		&& $this->registerHook('displayLeftColumn')
		 	);
	}

	

	public function hookDisplayLeftColumn()
	{				
		$lista = array();
		if (Configuration::get('NOHHF_Productos') != "")
			$lista = explode("|", Configuration::get('NOHHF_Productos'));
		$category = new Category();
		$cat = $category->searchByName(2,'The Ibéricos Select');
		if (count($lista > 0))
		{
			global $smarty;
			$pr = array();
			foreach ($lista as $p ) {
				$pr[] = new Product($p);
			}
			$this->context->smarty->assign(array("pr" => $pr, "cat" => Configuration::get('NOHHF_verMas')));
			return $this->display(__FILE__, 'NOHCustomList.tpl');

		}
		else
		{
			return 'no hay productos';
		}
	}
	
	public function uninstall()
	{
		//Configuration::deleteByName('NOHHF_Titulo');
		//Configuration::deleteByName('NOHHF_SubTitulo');
		Configuration::deleteByName('NOHHF_Productos');
		Configuration::deleteByName('NOHHF_verMas');
		return (parent::uninstall());
	}  

	public function getContent()
	{
		$output = null;
		$lista = array();
		if (Configuration::get('NOHHF_Productos') != "")
			$lista = explode("|", Configuration::get('NOHHF_Productos'));
		

 
		if (Tools::isSubmit('NOCL_productsListSelected'))
		{
			if (isset($_POST['NOCL_productsListSelected']))
				$lista = $_POST['NOCL_productsListSelected'];
			else
				$lista = array();

		
			$nuevaLista = implode("|", $lista);
			
			//Configuration::updateValue('NOHHF_Titulo', Tools::getValue('titulo'));
			//Configuration::updateValue('NOHHF_SubTitulo', Tools::getValue('subtitulo'));
			Configuration::updateValue('NOHHF_Productos', $nuevaLista);
			Configuration::updateValue('NOHHF_verMas', $_POST['cat_vermas']);
			$output .= $this->displayConfirmation($this->l('Settings updated'));			
		}
		
		$sql = "SELECT cat.id_category, cl.nombre_corto ";
		$sql .="FROM "._DB_PREFIX_."category AS cat ";
		$sql .="INNER JOIN "._DB_PREFIX_."category_lang AS cl ON cl.id_category = cat.id_category AND id_lang = 4";
		$cat = DB::getInstance()->executeS($sql);
		
		$products = Product::getProducts(4, 0, 0, 'name', 'ASC',false,true,null);
		$output .= '<script type="text/javascript">
					<!--

					function envioFormulario()
					{
						
						 for(i=document.getElementById('."'NOCL_productsListSelected'".').length-1; i>=0; i--)
						  {
						    document.getElementById('."'NOCL_productsListSelected'".').options[i].selected = true;
						  }
						document.getElementById('."'formularioLista'".').submit();

					}
					function arriba() {
					  obj=document.getElementById('."'NOCL_productsListSelected'".');
					  indice=obj.selectedIndex;
					  if (indice>0) cambiar(obj,indice,indice-1);
					}
					function abajo() {
					  obj=document.getElementById('."'NOCL_productsListSelected'".');
					  indice=obj.selectedIndex;
					  if (indice!=-1 && indice<obj.length-1)
					    cambiar(obj,indice,indice+1);
					}
					function cambiar(obj,num1,num2) {
					  proVal=obj.options[num1].value;
					  proTex=obj.options[num1].text;
					  obj.options[num1].value=obj.options[num2].value;  
					  obj.options[num1].text=obj.options[num2].text;  
					  obj.options[num2].value=proVal;
					  obj.options[num2].text=proTex;
					  obj.selectedIndex=num2;
					}
					-->
					</script>';

			$output .= '<script language="JavaScript" type="text/javascript">
<!--

var NS4 = (navigator.appName == "Netscape" && parseInt(navigator.appVersion) < 5);

function addOption(theSel, theText, theValue)
{
  var newOpt = new Option(theText, theValue);
  var selLength = theSel.length;
  theSel.options[selLength] = newOpt;
}

function deleteOption(theSel, theIndex)
{ 
  var selLength = theSel.length;
  if(selLength>0)
  {
    theSel.options[theIndex] = null;
  }
}

function moveOptions(theSelFrom, theSelTo)
{
  
  var selLength = theSelFrom.length;
  var selectedText = new Array();
  var selectedValues = new Array();
  var selectedCount = 0;
  
  var i;
  
  // Find the selected Options in reverse order
  // and delete them from the from Select.
  for(i=selLength-1; i>=0; i--)
  {
    if(theSelFrom.options[i].selected)
    {
      selectedText[selectedCount] = theSelFrom.options[i].text;
      selectedValues[selectedCount] = theSelFrom.options[i].value;
      deleteOption(theSelFrom, i);
      selectedCount++;
    }
  }
  
  // Add the selected text/values in reverse order.
  // This will add the Options to the to Select
  // in the same order as they were in the from Select.
  for(i=selectedCount-1; i>=0; i--)
  {
    addOption(theSelTo, selectedText[i], selectedValues[i]);
  }
  
  if(NS4) history.go(0);
}

//-->
</script>';

			$output.= '<center><form method="post" action="'.$_SERVER['REQUEST_URI'].'" enctype="multipart/form-data" id="formularioLista">
			<fieldset style="width: 800px;">
    				<div id="items">';					
		
			/*
			$output .= '<label>Título de la lista de productos</label>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<input type="text" name="subtitulo" style="width:500px;" id="titulo" size="12" maxlength="400" value="'.Configuration::get('NOHHF_Titulo').'" />';
			$output .= '</div>';

			$output .= '<label>Subtítulo de la lista de productos</label>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<input type="text" name="titulo" style="width:500px;" id="titulo" size="12" maxlength="400" value="'.Configuration::get('NOHHF_Titulo').'" />';
			$output .= '</div>';
			*/

			$output .= '<table border="0"><tr>';
			$output .= '<td>';


			$output .= '<select name="NOCL_productsList[]" id="NOCL_productsList" multiple size="20" style="width:320px;">';
			foreach ($products as $p) {
				if (array_search($p['id_product'], $lista) < -1)
				{
					$output .= '<option VALUE="'.$p['id_product'].'" ';
					$output .= '>'.$p['id_product'].' - '.$p['name'].'</option>';
				}
			}
			$output .= '</select>';
			$output .= '</td>';
			$output .= '<td>';
			$output .='<input type="button" value="--&gt;" onclick="moveOptions(this.form.NOCL_productsList, this.form.NOCL_productsListSelected);" /><br />';
			$output .='<input type="button" value="&lt;--" onclick="moveOptions(this.form.NOCL_productsListSelected, this.form.NOCL_productsList);" />';
			$output .= '</td>';
			$output .= '<td>';

			$output .= '<select name="NOCL_productsListSelected[]" id="NOCL_productsListSelected" multiple size="20" style="width:320px;">';
			foreach ($lista as $p) {
				$producto = new Product($p);
				$output .= '<option VALUE="'.$producto->id.'" ';
				$output .= '>'.$producto->id.' - '.$producto->name[4].'</option>';
				
			}
			$output .= '</select>';
			
			$output .= '</td>';
			$output .= '</tr><tr><td></td><td></td><td>';
			$output .= 'Primero selecciona producto ';
			$output .= '<input type="button" value="Arriba" onclick="arriba()" />';
      		$output .= '<input type="button" value="Abajo" onclick="abajo()" />';
      		$output .= '</td></td>';

			$output .= '</table>';
			$output .= '<p>Selecciona la categoría para "ver mas..."</p>';
			$output .= '<select id="cat_vermas" name="cat_vermas">';
			foreach ($cat as $category)
			{
				$output .= '<option value="'.$category['id_category'].'"';
				if ($category['id_category'] == Configuration::get('NOHHF_verMas'))
					$output .= ' selected';
				$output .= '>'.$category['nombre_corto'].'</option>';
			}	
			$output .= '</select>';
			 	 	
 	 		$output .= '
 	 				<br>
					<p>Mantén pulsado <strong>CTRL</strong> para seleccionar varios productos </p>

					<div class="margin-form">

					 <input type="button" name="FSPAsubmitUpdate" id="FSPAsubmitUpdate" value="'.$this->l('Guardar').'" class="button" onclick="envioFormulario()" />
				</div>
				</div>
				</fieldset>
			</form></center>';
 	 	
 	 	
 	 	
		
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
		$helper->fields_value['titulo'] = Configuration::get('NOHHF_Titulo');
		
		 
		return $helper->generateForm($fields_form);
	}	
	
}
