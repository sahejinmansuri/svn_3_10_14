
<?php 

$wysiwyg_root = '/var/www/html/incash/svn/WIGI/App/Editor'; 
include '/var/www/html/incash/svn/WIGI/App/Editor/php/init.php'; ?>

<form action="demo.php" method="post">
<table>
<tr><td><input type="text" name="subject" value="<?php=htmlspecialchars($subject);?>" /></td></tr>
<tr><td><?php echo wysiwyg('wysiwyg_id', 'message', $message); ?></td></tr>
<tr><td><input type="submit" value="Submit" name="submit" /></td></tr>
</table>
</form>
