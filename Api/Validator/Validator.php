<?php
namespace Api\Validator;

use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator
{
	protected $errors ;

	/*
		VARIDATE data from route GET, POST, PUT or any other request methods
	*/
	public function validate($request,array $rules){
       foreach ($rules as $field => $rule) {
       	    try {
       	     	$rule->setName($field)->assert($request->getParam($field));
       	    } catch (NestedValidationException $e) {
       	     	$this->errors[$field] = $e->getMessages();
       	    }
       }

        return $this;
	}

	/*
		VARIDATE data from route path
	*/
	public function validateAttribute($request, array $rules){
       foreach ($rules as $field => $rule) {
       	    try {
       	     	$rule->setName($field)->assert($request->getAttribute($field));
       	    } catch (NestedValidationException $e) {
       	     	$this->errors[$field] = $e->getMessages();
       	    }
       }

        return $this;
	}

	public function validateVariable( $field, $data, $rule ){

   	    try {
   	     	$rule->setName($field)->assert($data);
   	    } catch (NestedValidationException $e) {
   	     	$this->errors[$field] = $e->getMessages();
   	    }

        return $this;
	}

	public function validation(){
		return !empty($this->errors);
	}

	public function getValidationErrors(){
		return $this->errors;
	}
}
