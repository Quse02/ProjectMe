<?php
class Employee extends stdClass{
	public function Name() {
		return "{$this->Last_Name}, {$this->First_Name}";
	}
	
	public function Mailto() {
		return "<a href='mailto:{$this->Email}'>{$this->Email}</a>";
	}
	
	public function hyperlink()	{
		return "<a href='{$this->hyperlink}'>Link to Publication</a>";
	}
}





