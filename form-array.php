<?php
			$formFields = array(
					["text" , array( 
						"label" => "Textfield (required):",
						"name" => "textfield", 
						"placeholder" => "Placeholder Textfield",
						"class" => "form-control",
						"required" => true
					)],		
					["text" , array(
						"label" => "Pattern (only chars in a-z):", 
						"name" => "pattern", 
						"placeholder" => "Placeholder Pattern",
						"pattern" => "/[a-z]+/",
						"class" => "form-control"

					)],												
					["email" , array(
						"label" => "Mail (valid email):", 
						"name" => "email", 
						"placeholder" => "Placeholder Mail",
						"class" => "form-control"

					)],	
					["password" , array(
						"label" => "Password:", 
						"name" => "password", 
						"placeholder" => "Placeholder Password",
						"class" => "form-control"

					)],							
					["number", array(
						"label" => "Number (only numbers between 1-100):",
						"name"	=> "number",
						"min"	=> 1,
						"max"	=> 100,
						"class" => "form-control"
					)],		
					["textarea", array(
						"label" => "Message:", 
						"name" => "message", 
						"placeholder" => "Placeholder message",
						"class" => "form-control"

					)],
					["hidden", array(
						"name" 	=> "hidden",
						"value" => "hidden"
					)],
					["select", array(
						"name" => "person",
						"label" => "Select an option:",
						"class" => "form-control",
						"options" => array(
							[
								"value" => "",
								"disabled" => true,
								"text" 	=> "Select an option"
							],
							[
								"value" => "option1",
								"text" 	=> "Option 1",
							],
							[
								"value" => "option2",
								"text" 	=> "Option 2",
							]					
						)
					)],
					["checkbox", array(
						"name"		=> "checkbox",
						"label"	=> "Select checkboxes",
						"required"	=> true,
						"options"	=> array(
							[
								"label" => "Box 1",
								"value" => "1"
							],
							[
								"label" => "Box 2",
								"value" => "2"
							],							
							[
								"label" => "Box 3",
								"value" => "3"
							]							
						)
					)],
					["radio", array( 
						"name"		=> "radio",
						"label"	=> "Select a Radiobutton",
						"options"	=> array(
							[
								"label" => "Radio 1",
								"value" => "1"
							],
							[
								"label" => "Radio 2",
								"value" => "2"
							],						
							[
								"label" => "Radio 3",
								"value" => "3"
							]
						)
					)],
					["custom", array(
						"html" => "<p>Custom HTML Code<hr></p>"
					)],					
					["submit", array(
						"name" => "submit", 
						"value"=> "Submit",
						"class" => "btn btn-primary"
					)]								
				);
?>