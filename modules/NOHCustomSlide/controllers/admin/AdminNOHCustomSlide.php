<?php

include_once(_PS_MODULE_DIR_.'NOHCustomSlide/classes/NOHCustomDiapo.php');

class AdminNOHCustomSlideController extends AdminController 
{
	public function __construct() {
		$this->_list = array();
    	$this->context = Context::getContext();
    	$this->table = 'nohCustomSlide';
   		$this->className = 'NOHCustomDiapo';
    	$this->fields_list = array(
	    	'id_nohCustomSlide' => array('title' => $this->l('ID'),'width' => 25 ),
			'title' => array('title' => $this->l('Titulo'),'width' => 'auto'),
			'description' => array('title' => $this->l('Descripción'),'width' => 'auto'),
			'url' => array('title' => $this->l('Enlace'),'width' => 'auto'),		 	
	    	'url_text' => array('title' => $this->l('Texto enlace'),'width' => 'auto'),
	    	'img_url' => array('title' => $this->l('Imagen URL'), 'width' => 'auto'),
			'img_alt' => array('title' => $this->l('Imagen alt'),'width' => 'auto'),
			'img_title' => array('title' => $this->l('Imagen title'),'width' => 'auto'),
	    );

    $this->bulk_actions = 
      array('delete' => array('text' => $this->l('Delete selected'),'confirm' => $this->l('Delete selected items?')),
			'enableSelection' => array('text' => $this->l('Enable selection')),
	    	'disableSelection' => array('text' => $this->l('Disable selection'))
	    	);
    parent::__construct();
  }

  public function renderList() {
    $this->addRowAction($this->l('edit'));
    $this->addRowAction($this->l('delete'));    
    return parent::renderList();
  }

  public function renderForm()
  {
    $this->fields_form = 
      array(
	    'legend' => array(
			      'title' => $this->l('Noises of Hill | Custom Slide'),
			      ),
	    'input' => array(
				
				 array(
				   'type' => 'text',
				   'label' => $this->l('Titulo'),
				   'name' => 'title',
				   'maxlength' => 500,
				   'size' => 50,
				   'required' => true,
				   'desc' => $this->l('Titulo que aparecerá en la Slide.'),
				   ),
				 array(
				   'type' => 'textarea',
				   'label' => $this->l('Descripción'),
				   'name' => 'description',
				   'cols' => 50,                                     
                   'rows' => 7, 
                   'maxlength' => 99999,
				   'desc' => $this->l('Texto (html) que aparecerá en el Slide'),
				   ),
				 array(
					'type' => 'text',
					'label' => $this->l('URL'),
					'name' => 'url',
					'maxlength' => 500,
				    'size' => 50,
					'required' => true,
					'desc' => $this->l('Enlace del elemento del slide'),
				),      
			     array(
				   'type' => 'text',
				   'label' => $this->l('Texto enlace'),
				   'name' => 'url_text',
				   'size' => 50,
				   'maxlength' => 200,
				   'desc' => $this->l('Texto que aparecerá para seguir el enlace (Si está vacio se muestra enlace)'),
				   ),
			     array(
				   'type' => 'text',
				   'label' => $this->l('Imagen URL'),
				   'name' => 'img_url',
				   'maxlength' => 500,
				   'size' => 50,
				   'required' => true,
				   'desc' => $this->l('Pon aquí la URL de la imagen que quieres mostrar en el Slide.'),
				   ),
				 array(
				   'type' => 'text',
				   'label' => $this->l('Imagen alt'),
				   'name' => 'img_alt',
				   'size' => 50,
				   'maxlength' => 200,
				   'desc' => $this->l('Atributo alt que se mostrará en caso de que el enlace de la imagen este roto o sea incorrecto.'),
				   ), 
				 array(
				   'type' => 'text',
				   'label' => $this->l('Imagen title'),
				   'name' => 'img_title',
				   'size' => 50,
				   'maxlength' => 200,
				   'desc' => $this->l('Atributo title de la imagen.'),
				   ), 
			     ));

    $this->fields_form['submit'] = 
      array(
	    'title' => $this->l('Save   '),
	    'class' => 'button'
	    );
    return parent::renderForm();
  }
}