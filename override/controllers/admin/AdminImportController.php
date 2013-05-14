<?php

class AdminImportController extends AdminImportControllerCore
{
	protected static function split($field)
	{
		if (empty($field))
			return array();

		$separator = Tools::getValue('multiple_value_separator');
		if (is_null($separator) || trim($separator) == '')
			$separator = ',';

		do $uniqid_path = _PS_UPLOAD_DIR_.uniqid(); while (file_exists($uniqid_path));
		file_put_contents($uniqid_path, $field);
	    $fd = fopen($uniqid_path, 'r'); 
		$tab = fgetcsv($fd, MAX_LINE_SIZE, $separator);
		fclose($fd);
		unlink($uniqid_path);

		if (empty($tab) || (!is_array($tab)))
			return array();
		return $tab;
	}
}

