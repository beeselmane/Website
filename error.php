<?php

require_once 'config.php';

$page = 'error';
$current_page = new WebPage(WebSite::TitleForPage($page));

ob_start();
include WebSite::PathForPage($page);
$c = eval(ob_get_contents());
ob_end_clean();

$current_page->setPageContents($c);
require_once 'private/php/page.php';
