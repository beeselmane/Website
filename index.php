<?php

require_once 'config.php';

$page = (isset($_GET['page']) ? $_GET['page'] : 'home');
$current_page = new WebPage(WebSite::TitleForPage($page));

ob_start();
include WebSite::PathForPage($page);
$c = eval(ob_get_contents());
ob_end_clean();

$current_page->setPageContents($c);
require_once 'private/php/page.php';
