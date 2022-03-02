<?php

/*
THIS SCRIPT enhances php's "ucwords" function by protecting words like iPhone or e-reader, iOS etc... from having their first letter capitalized 
*/

echo "<br><br>Without UCprotect (normal ucwords):<br>";
echo ucwords("iPhone and e-reader");

echo "<br><br>With UCprotect:<br>";
echo ucprotect("iPhone and e-reader");

function ucprotect($str){ // a ucwords that protects acronyms and other product code numbers
	
	$str=str_replace("\n","\n ",$str);
	
	$strar=explode(" ",trim($str));
	$ret="";
	foreach($strar as $chunk){
		
		preg_match("/^[a-z][A-Z][a-z]/",$chunk,$m);

		if(count($m)>0){ // protects iPhone-like constructions
			
		}else{
			$fc=$chunk[0];
			$chunk[0]=strtoupper($chunk[0]);
		}
		if(preg_match("/[A-Z]\-[a-z]/",$chunk)){ // protection for words with hyphens, such as "e-Reader"
			$chunk[0]=strtolower($chunk[0]);
			$chunk[2]=strtoupper($chunk[2]);
		}

		$ret.=" $chunk";
	}

	$ret=str_replace("\n ","\n",$ret);
	return(trim($ret));
}


?>