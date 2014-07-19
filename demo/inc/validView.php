<h1>PHP Form Class</h1>
<p class="lead">See your valid input.</p>
<table class="table">
	<?php

		foreach ($_POST as $k => $v) {
			if(!is_array($v)){
				print "<tr><td>".$k."</td><td>".$v."</td></tr>";
			}else{
				foreach ($v as $i=>$item) {
					if($i === 0)
						print "<tr><td>".$k."</td><td>".$item."</td></tr>";
					else
						print "<tr><td></td><td>".$item."</td></tr>";
				}
			}
		}
	?>
</table