<?php

if ( !defined( '_PS_VERSION_' ) )
  exit;
  
class portadacms extends Module
{
		
	public function __construct()
	{
		$this->name = 'portadacms';
		$this->tab = 'others';
		$this->author = 'Sergio Gil Perez';
		$this->version = '1.0';	
		$this->ps_versions_compliancy = array('min' => '1.5', 'max' => '1.6');	
		parent::__construct();
		
		$this->displayName = $this->l('portadacms');
		$this->description = $this->l('portadacms | created by Noises Of Hill | 2013');		
		
		
       	
	}
	
	/*
	Module instalation, create tables, tabs and hooks
	*/
	public function install()
	{	 	
       Configuration::updateValue('cmsPortada',1);
       return (parent::install() AND $this->registerHook('displayHome'));
	}

	

	

	public function hookDisplayHome()
	{				
		$cms = new CMS(Configuration::get('cmsPortada'));
		global $smarty;
		$this->context->smarty->assign(array("content" => $cms->content[Context::getContext()->language->id]));
		return $this->display(__FILE__, 'portadacms.tpl');
		
	}


	
	public function uninstall()
	{
				
		return (parent::uninstall());
	}  


	public function getContent()
	{
		global $cookie;

		/* display the module name */
 	 	$output = '<center><h2>'.$this->displayName.' '.$this->version.'</h2></center>';
 	 	
 	 	/* update params */
 	 	
 	 	if (isset($_POST['portadaCMS'])) {

 	 		Configuration::updateValue('cmsPortada',$_POST['cmselect']);
 	 		$output = $this->displayConfirmation($this->l('<center>Dato actualizado!!</center>'));
 	 	 	 	 	
 	 	}
 	 	
 	 	$output.= '<center><form method="post" action="'.$_SERVER['REQUEST_URI'].'" enctype="multipart/form-data">
			<fieldset style="width: 800px;">
    				<div id="items">';
					
			$cms = CMS::listCms();
			$output .= '<p>'.$this->l('CMS de portada: ').'</p>';
			$output .= '<div>';
			$output .= '<select id="cmselect" name="cmselect">';
			foreach ($cms as $key) {
				$output .= '<option value="'.$key['id_cms'].'"';
				if ((int)Configuration::get('cmsPortada') == (int)$key['id_cms'])
					$output .= ' selected';
				$output .= '>'.$key['meta_title'].'</option>';
			}
			$output .= '</select>';
			$output .= '</div>';
			
			$output .= '
					<br>
					<center>
					 <input type="submit" name="portadaCMS" id="portadaCMS" value="'.$this->l('Save').'" class="button"  />
					 </center>
					 
				
				</div>
				<div>';
			$output .= '<br><br><br><p>Noises of Hill - 2013</p></div></fieldset></form></center>'; 	
 	 	
		
 		return $output;

	}


	
	



	
	
	
	
	
	
}