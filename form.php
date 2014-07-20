<?php
class Form{
	private $formFields;
	private $form = array();
	private $fields = array();
	private $validation = array();

	public function __construct($formFields){
		$this->formFields = $formFields;
		$types = array(
			"text",
			"email",
			"password",
			"number",
			"hidden",
			"textarea",
			"select",
			"checkbox",
			"radio",
			"submit"
		);
		foreach ($types as $type) {
			$this->fields[$type] = 0;
		}
	}

	// Render form
	public function render(){
	    if(isset($_POST) && sizeof($_POST) > 0) $valide = $this->validate();
	    if(!isset($valide) || (isset($valide) && !$valide)){
		    foreach ($this->formFields as $k => $v) {
		    	if($v[0] != "custom" && array_key_exists($v[1]["name"], $this->validation))
		    		$error = $this->validation[$v[1]["name"]];
		    	else
		    		$error = NULL;	    			    		
	    		$this->setItem($v[0],$v[1], $error);
		    }	
			return $this->form;	    	
	    }else{
	    	return false;
	    }

	}

	public function setItem($type,$args, $error){
		$req = isset($args["required"]) ? "required='required'" : "";
		$class = isset($args["class"]) ? $args["class"] : "";
		$class .= isset($error) ? " ".$error."Error" : "";
		if($type === "checkbox" || $type === "radio"){
			$output = "<fieldset class='".$class."'>";
			$legend = isset($args["label"]) ? "<legend>".$args["label"]."</legend>" : "";
			$output .= $legend;
			$items = array();
			foreach ($args["options"] as $option) {
				$checked = (isset($args["value"]) && in_array($option["value"], $args["value"])) ? "checked='checked'" : "";
				$req = ($type === "checkbox") ? "" : $req;
				$selector = $type."_".$this->fields[$type];
				$item = "<label class='".$class."' for='".$selector."'>".$option["label"]."</label>
							<input id='".$selector."' type='".$type."' name='".$args["name"]."[]' ".$checked." value='".$option["value"]."' ".$req.">";
				$output .= $item;
				$this->fields[$type]++;
				array_push($items, $item);
			}
			$output .= "</fieldset>";
			$data = array($type, array("html" => $output, "items" => $items));
			if( sizeof($legend) > 0) $data[1]["legend"] = $legend;
		}elseif($type === "select"){
			$opt = "";		
			$selector = $type."_".$this->fields[$type];
			foreach($args["options"] as $k=>$option){
				$value = isset($option["value"]) ? "value='".$option["value"]."'" : "";
				$disabled = isset($option["disabled"]) ? "disabled='disabled' selected='selected'" : "";
				$selected = (isset($args["value"]) && $args["value"] === $option["value"]) ? "selected='selected'" : "1";
				$opt .= "<option ".$value." ".$disabled." ".$selected." >".$option["text"]."</option>";
			}	
			$output =  "<label for='".$selector."' class='".$class."' >".$args["label"]."</label>
						<select id='".$selector."' class='".$class."' name='".$args["name"]."' ".$req.">".$opt."</select>";	
			$this->fields[$type]++;	
			$data = array($type, $output);
		}elseif($type === "custom"){
			$output = $args["html"];
			$data = array($type, $output);
		}else{
			$placeholder = isset($args["placeholder"]) ? "placeholder='".$args["placeholder"]."'" : "";
			$value = isset($args["value"]) ? $args["value"] : "";
			$name = "name='".$args["name"]."'";
			$selector = $type."_".$this->fields[$type];
			$min = isset($args["min"]) ? "min='".$args["min"]."'" : "";
			$max = isset($args["max"]) ? "max='".$args["max"]."'" : "";			
			$output =  isset($args["label"]) ? "<label for='".$selector."' class='".$class."'>".$args["label"]."</label>" : "";
			if($type === "textarea"){
				$output .= "<textarea id='".$selector."' class='".$class."' ".$placeholder." ".$name." ".$req.">".$value."</textarea>";
				$data = array($type, $output);
			}
			else{
				$output .= "<input id='".$selector."' class='".$class."' ".$name." value='".$value."' ".$placeholder." ".$req." type='".$type."' ".$min." ".$max.">";
				$data = array($type, $output);				
			}
			$this->fields[$type]++;							
		}
		array_push($this->form, $data);
		return true;	
	}


	public function validate(){
		foreach ($_POST as $k => $v) {
			if(is_array($v)){
				if(sizeof($v) < 1) unset($_POST[$k]); 				
			}
			else{
				if(strlen($v) < 1) unset($_POST[$k]);				
			}
		}
		foreach($this->formFields as $k=>$row){
			$type = $row[0];
			$name = isset($row[1]["name"]) ? $row[1]["name"] : false;
			if($type != "custom" && $name){
				$required = isset($row[1]["required"]) ? true : false;
				if($required && !array_key_exists($name, $_POST)){
					$this->validation[$name] = "required";
				}elseif(array_key_exists($name, $_POST)){
					$this->formFields[$k][1]["value"] = $_POST[$name];
					if(method_exists($this, "validate".ucfirst($type))){
						if(!$this->{"validate".$type}($_POST[$name], $row)){
							$this->validation[$name] = "invalid";
						}
					}
				}
			}
		}
		if(sizeof($this->validation) < 1){
			return true;			
		}else{
			return false;
		}
	}






	public function validateText($text, $args){
		return $this->__checkString($text, $args);
	}

	public function validateTextarea($text, $args){
		return $this->__checkString($text, $args);
	}

	public function validateEmail($mail){
		preg_match("/\S*\@[a-zA-z0-9-.]*\.[a-z]*/", $mail, $match);
		if(sizeof($match) > 0 && $mail === $match[0])
			return true;
		else
			return false;
	}

	public function validatePassword($password, $args){
		return $this->__checkString($password, $args);			
	}

	public function validateNumber($number,$args){
		if(is_int(filter_var($number, FILTER_VALIDATE_INT))){
			if(isset($args["min"]) && $number < $args["min"]){
				return false;
			}
			if(isset($args["max"]) && $number > $args["max"]){
				return false;
			}
		}else{
			return false;
		}
		return true;
	}

	public function validateHidden($hidden,$args){
		if(isset($args[1]["value"]) && $args[1]["value"] === $hidden)
			return true;
		else
			return false;
	}

	public function validateSubmit($submit,$args){
		return (isset($args[1]["value"]) && $submit === $args[1]["value"]) ? true : false;
	}

	public function validateSelect($value,$args){
		return $this->__checkOptions($value,$args);
	}
	
	public function validateRadio($value,$args){
		return $this->__checkOptions($value,$args);
	}	
	
	public function validateCheckbox($value,$args){
		return $this->__checkOptions($value,$args);
	}
	
	private function __checkString($text,$args){
			if(isset($args[1]["pattern"])){
				preg_match($args[1]["pattern"], $text, $match);
				if(sizeof($match) > 0 && $text === $match[0])
					return true;
				else
					return false;				
			}else{
				return true;
			}
	}

	private function __checkOptions($value,$args){
		$input = array();
		if(is_array($value)){
			foreach($value as $v){
				$input[$v] = true;
				foreach ($args[1]["options"] as $option) {
					if($option["value"] === $v)
						unset($input[$v]);
				}
			}			
		}else{
			$input[$value] = true;
			foreach ($args[1]["options"] as $option) {
				if($option["value"] === $value){
					unset($input[$value]);
				}
			}
		}		
		if(sizeof($input) > 0)	
			return false;
		else
			return true;
	}
}



?>