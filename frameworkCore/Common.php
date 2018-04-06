<?php
function handleSelectComponent($item,$value,$type){
	if($item==$value){
		if($type == 's')
			return 'selected';
		elseif($type == 'c')
			return 'checked';
	}
}

function generateSelectOption($items,$valueName,$keyName,$key,$otherAttr){
	$option = '<option value="0">--Bitte w&auml;hlen Sie--</option>';
	foreach ($items as $item){
		$option = $option . '<option value="' . $item[$valueName] . '"'; 
		if($item[$keyName]==$key)
			$option = $option . ' selected ';
		if($otherAttr != ''){
			$option = $option . $otherAttr . '= "' . $item[$otherAttr] . '" ';
		}
		$option = $option . '>' . $item[$keyName] . '</option>';
	}
	return $option; 
}

function checkUnique($id){
	session_start();
	//echo $id;
	//print_r($_SESSION);
	$id = isset($id) ? $id : '';
	if($id == $_SESSION['originator'])
		return true;
	else
		return false;
}