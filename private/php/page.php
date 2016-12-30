<?php if (!isset($current_page)) die(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-16">
        <link href="<?php echo WebSite::ResourceLink('theme', 'default'); ?>" rel="stylesheet"/>
        <link href="<?php echo WebSite::ResourceLink('theme', 'current'); ?>" rel="stylesheet"/>
        <link href="<?php echo WebSite::ResourceLink('style', 'color'); ?>" rel="stylesheet"/>
        <script type="text/javascript" src="<?php echo WebSite::ResourceLink('script', 'jquery'); ?>"></script>
        <script type="text/javascript" src="<?php echo WebSite::ResourceLink('script', 'bootstrap'); ?>"></script>
        <title><?php echo $current_page->getTitle(); ?></title>
        <?php echo $current_page->getScriptTag(); ?>
    </head>
    <body>
        <?php if ($current_page->hasHeader()) require_once 'header.php'; ?>
        <div class="container" id="maincontainer"><?php echo $current_page->getPageContents(); ?></div>
        <?php if ($current_page->hasFooter()) require_once 'footer.php'; ?>
    </body>
</html>
