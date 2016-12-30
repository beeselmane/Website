<?php

require_once 'config.php';

$doc = (isset($_GET['doc']) ? $_GET['doc'] : 'corona_docs');
$docdirname = '/private/cxdox/';
$docdir = realpath(dirname(__FILE__)) . $docdirname;
$current_page = new WebPage($doc);

if ($doc == 'corona_docs') {
    $list = scandir($docdir);
    $contents = '<pre>';

    foreach ($list as $key => $value)
    {
        if ($value[0] != '.')
        {
            $last_dot = strrpos($value, '.');
            if ($last_dot === FALSE) continue;
            $extension = substr($value, $last_dot + 1);

            $basename = substr($value, 0, $last_dot);
            $contents .= '<a href="' . $_SERVER['QUERY_STRING'] . '?doc=' . $basename . '&type=' . $extension . '">';
            $contents .= $basename . ' (' . $extension . ')' . '</a>' . "\n";
        }
    }

    $contents .= '</pre>';
    $current_page->setPageContents($contents);
} else {
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
    } else {
        $type = 'html';
    }

    if ($type === 'html') {
        $current_page->setPageContents(file_get_contents($docdir . $doc . '.' . $type));
    } else if ($type === 'pdf') {
        $location = WebSite::ResourceLink('cx', $doc . '.' . $type);
        header('Location: ' . $location);
    } else {
        $current_page->setPageContents('<pre>Error: Invalid type "' . $type . '" specified for document!</pre>');
    }
}

require_once 'private/php/page.php';
