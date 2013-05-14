<?php

if ( !defined( '_PS_VERSION_' ) )
  exit;
  
class factSpa extends Module
{
	private $lang = 4;
	
	public function __construct()
	{
		$this->name = 'factSpa';
		$this->tab = 'billing_invoicing';
		$this->author = 'prestashop-facil.com';
		$this->version = '3.0';		
		$this->ps_versions_compliancy = array('min' => '1.5', 'max' => '1.6');	
		parent::__construct();
		
		$this->displayName = $this->l('Optimized Invoice');
		$this->description = $this->l('Turn your invoice and delivery documents into elegant and custom ones with your favorite colours. Developed by prestaMarketing.com');		
	
	}
	
	/*
	Module instalation, create tables, tabs and hooks
	*/
	public function install()
	{		
		
		Configuration::updateValue('FSPA_razonSocial','');
		Configuration::updateValue('FSPA_nombre','');
		Configuration::updateValue('FSPA_cif','');
		Configuration::updateValue('FSPA_domicilio','');
		Configuration::updateValue('FSPA_localidad','');
		Configuration::updateValue('FSPA_Provincia','');
		Configuration::updateValue('FSPA_Pais','');
		Configuration::updateValue('FSPA_telefono','');
		Configuration::updateValue('FSPA_fax','');
		Configuration::updateValue('FSPA_mail','');
		Configuration::updateValue('FSPA_otro','');
		Configuration::updateValue('FSPA_color','#000000');
		Configuration::UpdateValue('FSPA_textColor','#ffffff');
		Configuration::updateValue('FSPA_details',0);
		
		#Guardando archivos de respaldo anteriores ---------------------------------------------		
		
		#Guardando TPLs originales que generan el PDF
		$this->escribirArchivos("/pdf",'/modules/factSpa/back/pdf/','tpl');
		
		#Guardando /classes/order/OrderInvoice.php original.
		$texto = "";
		$fichero = fopen(_PS_ROOT_DIR_.'/override/classes/order/OrderInvoice.php','r');
		while ($trozo = fgets($fichero, 1024)){
			$texto .= $trozo;
		}
		$xmlFile = _PS_MODULE_DIR_ ."factSpa/back/override/classes/order/OrderInvoice.php";
		
		$xmlHandle = fopen($xmlFile, "w");
		fwrite($xmlHandle, $texto);
		fclose($xmlHandle);
		
		#Guardando modelos originales en /classes/pdf.
		$this->escribirArchivos("/override/classes/pdf",'/modules/factSpa/back/override/classes/pdf/','php');
		
		if (_PS_VERSION_ == '1.5.4.0')
		{
			$texto = "";
			$fichero = fopen(_PS_ROOT_DIR_.'/classes/pdf/PDFGenerator.php','r');
			while ($trozo = fgets($fichero, 1024)){
				$texto .= $trozo;
			}
			$xmlFile = _PS_MODULE_DIR_ ."factSpa/back/classes/pdf/PDFGenerator.php";
			
			$xmlHandle = fopen($xmlFile, "w");
			fwrite($xmlHandle, $texto);
			fclose($xmlHandle);
		} 
				
		#Guardando PdfInvoiceController.php original
		$texto = "";
		$fichero = fopen(_PS_ROOT_DIR_.'override/controllers/front/PdfInvoiceController.php','r');
		while ($trozo = fgets($fichero, 1024)){
			$texto .= $trozo;
		}
		$xmlFile = _PS_MODULE_DIR_ ."factSpa/back/override/controllers/front/PdfInvoiceController.php";
		$xmlHandle = fopen($xmlFile, "w");
		fwrite($xmlHandle, $texto);
		fclose($xmlHandle);
				
		#Guardando archivos de respaldo anteriores ---------------------------------------------	
		
		#Sustituyendo archivos -----------------------------------------------------------------
				
		#Sustituyendo TPLs en /pdf
		$this->escribirArchivos("/modules/factSpa/archivos/pdf",'/pdf/','tpl');
		
		#Sustituyendo PDFs en /override/clases/order
		$this->escribirArchivos("/modules/factSpa/archivos/override/classes/order",'/override/classes/order/','php');
		
		if (_PS_VERSION_ == '1.5.4.0')
		{
			$texto = "";
			$fichero = fopen(_PS_MODULE_DIR_ .'factSpa/archivos/classes/pdf/PDFGenerator.php','r');
			while ($trozo = fgets($fichero, 1024)){
				$texto .= $trozo;
			}
			$xmlFile = _PS_ROOT_DIR_ ."/classes/pdf/PDFGenerator.php";
			
			$xmlHandle = fopen($xmlFile, "w");
			fwrite($xmlHandle, $texto);
			fclose($xmlHandle);
		} 
		
		#Sustituyendo PDFs en /override/clases/pdf
		$this->escribirArchivos("/modules/factSpa/archivos/override/classes/pdf",'/override/classes/pdf/','php');
		
		#Sustituyendo PDFs en /override/controllers/front
		$this->escribirArchivos("/modules/factSpa/archivos/override/controllers/front",'/override/controllers/front/','php');		
		
		#Sustituyendo archivos -----------------------------------------------------------------
		
		
		
				
		return (parent::install() AND $this->registerHook('displayHeader') 
			&& $this->registerHook('displayBackOfficeHeader')
			);
	}
	
	public function uninstall()
	{		
		Configuration::deleteByName('FSPA_razonSocial');
		Configuration::deleteByName('FSPA_nombre');
		Configuration::deleteByName('FSPA_cif');
		Configuration::deleteByName('FSPA_domicilio');
		Configuration::deleteByName('FSPA_localidad');
		Configuration::deleteByName('FSPA_Provincia');
		Configuration::deleteByName('FSPA_telefono');
		Configuration::deleteByName('FSPA_Pais');
		Configuration::deleteByName('FSPA_fax');
		Configuration::deleteByName('FSPA_mail');
		Configuration::deleteByName('FSPA_otro');
		Configuration::deleteByName('FSPA_color');
		Configuration::deleteByName('FSPA_textColor');
		Configuration::deleteByName('FSPA_details');

		#Restaurando archivos originales -----------------------------------------------------------------
				
		#Sustituyendo TPLs en /pdf
		$this->escribirArchivos("/modules/factSpa/back/pdf",'/pdf/','tpl');
		
		#Sustituyendo PDFs en /override/clases/order
		$this->escribirArchivos("/modules/factSpa/back/override/classes/order",'/override/classes/order/','php');
		
		if (_PS_VERSION_ == '1.5.4.0')
			$this->escribirArchivos("/modules/factSpa/back/classes/pdf",'/classes/pdf/','php');
			
		#Sustituyendo PDFs en /override/clases/pdf
		$this->escribirArchivos("/modules/factSpa/back/override/classes/pdf",'/override/classes/pdf/','php');
		
		#Sustituyendo PDFs en /override/controllers/front
		$this->escribirArchivos("/modules/factSpa/back/override/controllers/front",'/override/controllers/front/','php');		
		
		#Restaurando archivos originales -----------------------------------------------------------------
		

		return (parent::uninstall());
		
	}
     
	public function hookDisplayBackOfficeHeader()
	{
		$this->context->controller->addJS(($this->_path).'js/ColourPicker.js', 'all');
		$this->context->controller->addJS(($this->_path).'js/Colour.js', 'all');
		$this->context->controller->addJS(($this->_path).'js/initcolor.js', 'all');
		
	}
		
	
	public function getContent()
	{
		global $cookie;

		/* display the module name */
 	 	$output = '<h2>'.$this->displayName.' '.$this->version.'</h2>';
 	 	
 	 	/* update params */
 	 	
 	 	if (isset($_POST['FSPAsubmitUpdate'])) {
 	 								
			Configuration::updateValue('FSPA_razonSocial',  $_POST['razonSocial']);
			Configuration::updateValue('FSPA_nombre', $_POST['nombre']);
			Configuration::updateValue('FSPA_cif', $_POST['cif']);
			Configuration::updateValue('FSPA_domicilio',  $_POST['domicilio']);
			Configuration::updateValue('FSPA_localidad', $_POST['localidad']);
			Configuration::updateValue('FSPA_Provincia', $_POST['provincia']);
			Configuration::updateValue('FSPA_telefono', $_POST['telefono']);
			Configuration::updateValue('FSPA_Pais', $_POST['pais']);
			Configuration::updateValue('FSPA_fax', $_POST['fax']);
			Configuration::updateValue('FSPA_mail', $_POST['mail']);
			Configuration::updateValue('FSPA_otro', $_POST['otro']);
			Configuration::updateValue('FSPA_color', $_POST['color']);
			Configuration::updateValue('FSPA_textColor',$_POST['colorText']);
			Configuration::updateValue('FSPA_details',(int) $_POST['detalles']);
			
			
			$output = $this->displayConfirmation($this->l('Configure Saved'));			
 	 	 	
 	 	}
 	 	
 	 	$output.= '<form method="post" action="'.$_SERVER['REQUEST_URI'].'" enctype="multipart/form-data">
			<fieldset style="width: 800px;">
    				<div id="items">';
					
		
			$output .= '<label>'.$this->l('Company Name').'</label>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<input type="text" name="razonSocial" style="width:500px;" id="razónSocial" size="12" maxlength="400" value="'.Configuration::get('FSPA_razonSocial').'" />';
			$output .= '</div>';
			
			//-----------------------------------------------------
			
			$output .= '<label>'.$this->l('Name').'</label>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<input type="text" name="nombre" style="width:500px;" id="nombre" size="12" maxlength="400" value="'.Configuration::get('FSPA_nombre').'" />';
			$output .= '</div>';
			
			//-----------------------------------------------------
			
			$output .= '<label>'.$this->l('VAT number').'</label>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<input type="text" name="cif" style="width:100px;;" id="cif" size="50" maxlength="10" value="'.Configuration::get('FSPA_cif').'" />';
			$output .= '</div>';
			
			//-----------------------------------------------------
			
			$output .= '<label>'.$this->l('Social Address').'</label>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<input type="text" name="domicilio" style="width:500px;" id="domicilio" size="12" maxlength="400" value="'.Configuration::get('FSPA_domicilio').'" />';
			$output .= '</div>';
			
			//-----------------------------------------------------
			
			$output .= '<label>'.$this->l('City').'</label>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<input type="text" name="localidad" style="width:500px;" id="localidad" size="12" maxlength="400" value="'.Configuration::get('FSPA_localidad').'" />';
			$output .= '</div>';
			
			//-----------------------------------------------------
			
			$output .= '<label>'.$this->l('State').'</label>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<input type="text" name="provincia" style="width:500px;" id="provincia" size="12" maxlength="400" value="'.Configuration::get('FSPA_Provincia').'" />';
			$output .= '</div>';

			//-----------------------------------------------------
			
			$output .= '<label>'.$this->l('Country').'</label>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<input type="text" name="pais" style="width:500px;" id="pais" size="12" maxlength="400" value="'.Configuration::get('FSPA_Pais').'" />';
			$output .= '</div>';
			
			//-----------------------------------------------------
			
			$output .= '<label>'.$this->l('Phone').'</label>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<input type="text" name="telefono" style="width:150px;" id="telefono" size="12" maxlength="15" value="'.Configuration::get('FSPA_telefono').'" />';
			$output .= '</div>';
			
			//-----------------------------------------------------
			
			$output .= '<label>'.$this->l('Fax').'</label>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<input type="text" name="fax" style="width:150px;" id="fax" size="12" maxlength="15" value="'.Configuration::get('FSPA_fax').'" />';
			$output .= '</div>';
			
			//-----------------------------------------------------
			
			$output .= '<label>'.$this->l('mail').'</label>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<input type="text" name="mail" style="width:500px;" id="mail" size="12" maxlength="400" value="'.Configuration::get('FSPA_mail').'" />';
			$output .= '</div>';
			
			//-----------------------------------------------------
			
			$output .= '<label>'.$this->l('Other interesting information').'</label>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<input type="text" name="otro" style="width:500px;" id="otro" size="12" maxlength="400" value="'.Configuration::get('FSPA_otro').'" />';
			$output .= '</div>';	
			
			//-----------------------------------------------------
			
			$modo = Configuration::get('FSPA_details');
			$modo_detallesNO = '';
			$modo_detallesSI ='';
			if($modo == '1')
				$modo_detallesSI = 'selected';
			else
				$modo_detallesNO = 'selected';
			
			$output .= '<label>'.$this->l('Show full details on invoice rows?').'</label><br>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<select name="detalles" id="detalles" style="width:50px;"><option value="0" '.$modo_detallesNO.'>'.$this->l('No').'</option><option value="1" '.$modo_detallesSI.'>'.$this->l('Yes').'</option></select>';
			$output .= '</div>';
			
			
			//-----------------------------------------------------
			
			$output .= '<label>'.$this->l('Background colour').'</label><br>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<input type="hidden" name="color" style="width:100px;" id="color" size="12" maxlength="7" value="'.Configuration::get('FSPA_color').'"  />';
			$output .= '</div>';

			$output .= '<div id="colourPicker" style="margin-left:250px;"></div><br>';

			//-----------------------------------------------------
			
			$output .= '<label>'.$this->l('Text colour').'</label><br>';
			$output .= '<div class="margin-form" style="padding-left:0">';
			$output .= '<input type="hidden" name="colorText" style="width:100px;" id="colorText" size="12" maxlength="7" value="'.Configuration::get('FSPA_textColor').'"  />';
			$output .= '</div>';

			$output .= '<div id="colourPicker01" style="margin-left:250px;"></div><br>';			
 	 	
 	 		$output .= '
					<div class="margin-form">
					 <input type="submit" name="FSPAsubmitUpdate" id="FSPAsubmitUpdate" value="'.$this->l('Save').'" class="button" />
				</div>
				</div>
				</fieldset>
			</form>'; 	
 	 	
		
 		return $output;

	}	

	private function escribirArchivos($origen, $destino, $extension)
	{
		$path = _PS_ROOT_DIR_ .$origen;
		$dir = dir($path);
    	while( ( $file = $dir->read() ) !== false )
        if( is_file( $path .'/'. $file ) and preg_match( '/^(.+)\.'.$extension.'$/i' , $file ) )
		{
			$texto = "";
			$fichero = fopen($path.'/'.$file,'r');
			while ($trozo = fgets($fichero, 1024)){
				$texto .= $trozo;
			}
			$xmlFile = _PS_ROOT_DIR_.$destino.$file;
			$xmlHandle = fopen($xmlFile, "w");
			fwrite($xmlHandle, $texto);
			fclose($xmlHandle);
				
        }   
   	    $dir->close();	
	}
	
}
?>