phpformclass
============

This PHP class is meant to help you create and validate (serverside) web-forms in an easy way.

##How to use:

1. Include form.php (the class itself)
2. Set up an array which specifies your form
			

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
				
3. Create new form object => $form = new Form($formFields);
4. If page is posted => isset($_POST["submit"]).   
   Check if input is what you specified in $formFields => $form->validate()
5.  Render form $form->render()  
   This function return an array containing the form (including errors).  
   Each array has two indexes:  
   0 = fieldtype  
   1 = field html code
6. If $form->validate() === true  
   $_POST var is cleaned up and contains only valid formfields.  
   Ready to send mail or store data in a database

## Demo:
The Demo folder contains a ready to use dummy form
* Index.php
* /css  
   * bootstrap.min.css
   * custom.css
* /inc
   * formView.php
   * validView.php
* /js
   * bootstrap.min.js
   * jquery-1.11.1.js


##License
The MIT License (MIT)

Copyright (c) 2014 Simon Pilkowski

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
