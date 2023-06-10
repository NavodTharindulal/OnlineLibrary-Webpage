<?php if (!empty($msg)) { ?>
<div class="alert alert-success alert-dismissible fade in">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>SUCCESS!</strong> <?php echo $msg; ?> 
</div>
<?php
} 
if (!empty($errors)) { 
?>
<div class="alert alert-danger alert-dismissible fade in">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>ERROR(S)</strong><br>
<?php 
foreach ($errors as $error) {
echo '- ' . $error . '<br>';
}
?>
</div>
<?php } ?>