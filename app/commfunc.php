<?php
/**
 * [addPlantelDocente agrega un plantel a la cadena del docente para guardarlo en la base d edatos]
 * @param [strin] $plants [los planteles en los que trabaja el docnete actualmente CSV]
 * @param [string] $plant [el plantel en el que se quiere registrar al docente]
 */
function addPlantelDocente($plants,$plant){
	if(strpos($plants,$plant) === false){
		if(strlen($plants) > 0){
			return $plants.','.$plant;
		}else{
			return $plant;
		}
	}else{
		return $plants;
	}
}

/**
 * [materias que se descartan por defecto]
 * @param  [string] $mat [materia a revisar]
 * @return [boolean]      [true=> descartar]
 */
function matDesc($mat){
	$matdesc = ["ACTIVIDADES CULTURALES",
				"SERVICIO SOCIAL",				
				"INGLES",
				"ELECTIVA",
				"SEMINARIO",				
				"PRACTICA PROFESIONAL"];

	$desc = false;

	foreach($matdesc as $md){
		$desc = strpos($mat, $md) !== false || $desc;
	}

	return $desc;

}
