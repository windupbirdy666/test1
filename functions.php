<?php

function isSSL() { 
    return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
}

function addParamsToUrl($url, $params) {
    if ($url == ""){
        return "";
    }
    
    $delimiter = "?";
    // Returns a string if the URL has parameters or NULL if not
    if (parse_url($url, PHP_URL_QUERY)) {
        $delimiter = "&";
    }
    
	foreach ($params as $key => $value) {
		$url .= $delimiter . $key . '=' . $value;
        $delimiter = "&";
	}
    
    return $url;
}
    
function stringInJsConcatenation($url) {
    $arr = str_split($url, 4);
    $res = "";
    foreach ($arr as $letter) {
        /*if ($letter == "\\") {
            $letter = "\\\\";
        }*/
        $res .= '"' . $letter . '"+';
    }
    $res .= '""';
    return $res;
}

function getAffLink($aff_links){
    $total_weight = 0;
    foreach ($aff_links as $link => $weight) {
        $total_weight += $weight;
    }
    
    $rand_num = mt_rand(1, $total_weight);
    
    $current_weight_summ = 0;
    foreach ($aff_links as $link => $weight) {
        $current_weight_summ += $weight;
        if ($rand_num <= $current_weight_summ) {
            return $link;
        }
    }
    
    //$links = array_keys($my_arr);
    //$my_arr[$keys[1]] = "not so much bling";
    
}

// Берем код страны из заголовка, переданного CloudFlare. Если его нет, то возвращает NULL
function getCountryCode() {
	if (array_key_exists ("HTTP_CF_IPCOUNTRY", $_SERVER)) {
        return $_SERVER["HTTP_CF_IPCOUNTRY"];
    }
    return NULL;
}


?>

