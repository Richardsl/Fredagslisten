<?php
function html($text)
{
	return htmlspecialchars($text, ENT_QUOTES, 'ISO-8859-1');
}

function htmlout($text)
{
	echo html($text);
}