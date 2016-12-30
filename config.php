<?php

define(SERVER_ROOT, realpath(dirname(__FILE__)));

define(SITE_THEME,  'cerulean');
define(SITE_NAME,   'Site');

define(WEB_DOMAIN,  'beeselmane.com');
define(WEB_ROOT,    '/');

$header_links_left = array(
    'doge' => 'Doge',
    'ext' => 'Extras',
    'about' => 'About'
);

$header_links_right = array(
    'Projects' => array(
        'The Best' => array(
            'projects_best' => 'The Index Page',
            'corona_docs' => 'Corona-X'
        ),
        '' => array(
            'projects_all' => 'All'
        )
    )
);

$GLOBALS['custom_page_titles'] = array(
    'about' => SITE_NAME . ' - About',
    'home'  => SITE_NAME . ' - Home',
    'doge'  => SITE_NAME . ' - Doge',
    'error' => SITE_NAME . ' - Internal Error',
    'corona_docs' => 'Corona-X Documentation'
);

$GLOBALS['custom_page_links'] = array(
    'ext' => '/h/',
    'corona_docs' => '/cxdoc.php'
);

class WebSite
{
    public static function TitleForPage($page)
    {
        if (isset($GLOBALS['custom_page_titles'][$page])) {
            return $GLOBALS['custom_page_titles'][$page];
        } else {
            return SITE_NAME . ' - ' . $page;
        }
    }

    public static function PathForPage($page)
    {
        return SERVER_ROOT . '/private/pages/' . $page . '.html';
    }

    public static function LinkToPage($page)
    {
        if (isset($GLOBALS['custom_page_links'][$page])) {
            return $GLOBALS['custom_page_links'][$page];
        } else {
            return WEB_ROOT . '?page=' . $page;
        }
    }

    public static function ResourceLink($type, $name)
    {
        return WEB_ROOT . 'load.php?t=' . $type . '&r=' . $name;
    }
}

class WebPage
{
    private $title = SITE_NAME;
    private $header = true;
    private $footer = true;
    private $contents = '';
    private $script = '';

    public function __construct()
    {
        $argv = func_get_args();
        $argc = func_num_args();

        if ($argc > 0) {
            $this->title = $argv[0];
        } if ($argc > 1) {
            $this->contents = $argv[1];
        } if ($argc > 2) {
            $this->contents = $argv[2];
        } if ($argc > 3) {
            $this->header = $argv[3];
        } if ($argc > 4) {
            $this->footer = $argv[4];
        }
    }

    public function setTitle($new_title)
    { $this->title = $new_title; }

    public function getTitle()
    { return $this->title; }

    public function setHasHeader($has_header)
    { $this->header = $has_header; }

    public function hasHeader()
    { return $this->header; }

    public function setHasFooter($has_footer)
    { $this->footer = $has_footer; }

    public function hasFooter()
    { return $this->footer; }

    public function setPageContents($new_contents)
    { $this->contents = $new_contents; }

    public function getPageContents()
    { return $this->contents; }

    public function setPageScript($page_script)
    { $this->script = $page_script; }

    public function getPageScript()
    { return $this->script; }

    public function getScriptTag()
    {
        if (isset($this->script) && $this->script !== '') {
            return '<script type="text/javascript">' . $this->script . '</script>';
        } else {
            return '';
        }
    }
}
