<?php

// Format the date and time
function formatDateTime($date){
	return date('F j, Y, g:i a', strtotime($date));
}

// Just date
function formatDate($date){
	return date('F j, Y', strtotime($date));
}

// shorten the text block
function shortenText($text, $chars = 450){
	$text = $text." ";
	$text = substr($text, 0, $chars);
	$text = substr($text, 0, strrpos($text, ' '));		// stop text at a space
	$text = $text."...";
	return $text;
}

// activate navbar
function echoActive($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'active';
}