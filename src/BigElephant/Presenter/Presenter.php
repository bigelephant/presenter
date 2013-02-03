<?php namespace BigElephant\Presenter;

abstract class Presenter {

	/**
	 * 
	 */
	protected $object;

	/**
	 * 
	 */
	public function __construct($object)
	{
		$this->object = $object;
	}

	/**
	 * 
	 */
	public function __get($var)
	{
		return $this->object->$var;
	}

	/**
	 * 
	 */
	public function __call($method, $arguments)
	{
		return call_user_func_array(array($this->object, $method), $arguments);
	}
}