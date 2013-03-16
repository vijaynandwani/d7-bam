<?php
// $Id$

/**
 * @file
 * Example of overriding the page.tpl.php file.
 */
?>
<h1>Every page will have this heading</h1>
<?php print render($page['content']); ?>