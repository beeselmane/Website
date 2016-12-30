<?php

class HeaderBuilder
{
    private static function BuildEntry($key, $value, $islink = false)
    {
        if ($islink || is_string($value)) {
            return '<li><a href="' . WebSite::LinkToPage($key) . '">' . $value . '</a></li>';
        } else {
            $result =  '<li class="dropdown">';
            $result .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
            $result .= $key . '<b class="caret"></b>';
            $result .= '</a>';
            $result .= '<ul class="dropdown-menu">';

            foreach ($value as $section => $links)
            {
                if ($section !== '') $result .= '<li class="dropdown-header">' . $section . '</li>';
                foreach ($links as $key => $newvalue) $result .= HeaderBuilder::BuildEntry($key, $newvalue, true);
                $result .= '<li class="divider"></li>';
            }

            // Sorry for the hax, but it works.. I promise :)
            $result = substr($result, 0, -strlen('<li class="divider"></li>'));
            $result .= '</ul>';
            $result .= '</li>';

            return $result;
        }
    }

    public static function Build($array)
    {
        $result = '';
        foreach ($array as $key => $value) $result .= HeaderBuilder::BuildEntry($key, $value);
        return $result;
    }
}

?>
<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo WebSite::LinkToPage('home'); ?>">
                <?php echo SITE_NAME; ?>
            </a>
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse" id="navbar-main">
            <ul class="nav navbar-nav"><?php echo HeaderBuilder::Build($header_links_left); ?></ul>
            <ul class="nav navbar-nav navbar-right"><?php echo HeaderBuilder::Build($header_links_right); ?></ul>
        </div>
    </div>
</div><br><br><br>
<?php if (SITE_THEME == "readable") { ?><br><?php } ?>
