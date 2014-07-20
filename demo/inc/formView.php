<h1>PHP Form Class</h1>
<p class="lead">Welcome to the easy way of creating and validating web-forms.</p>

<form role="form" method="post" action="#">
<?php
	// render form and save return in $form var
	$data = $form->render();
	foreach ($data as $item) {
	#$item[0] => type of the formfield 
	#$item[1] => formfiled html code
		if(!is_array($item[1])){
		?>    
			<div class="form-group"><?php print $item[1]; ?> </div>
		<?php
		}else{
		?>
			<div class="form-group"><?php print $item[1]["html"]; ?> </div>
		<?php
		}
	}

?>
</form>