<?php
    class C_Controller{

    //
	// Конструктор.
	//
	protected   function __construct()
	{
	}

	//
	// Полная обработка HTTP запроса.
	//
	public function Request()
	{
		$this->Input();
		$this->Output();
	}

	//
	// Виртуальный обработчик запроса.
	//
	protected function Input()
	{
	}

	//
	// Виртуальный генератор HTML.
	//
	protected function Output()
	{
	}

	//
	// Запрос произведен методом GET?
	//
	protected function IsGet()
	{
		return $_SERVER['REQUEST_METHOD'] == 'GET';
	}

	//
	// Запрос произведен методом POST?
	//
	protected function IsPost()
	{
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}

	//
	// Генерация HTML шаблона в строку.
	//
	protected function View($fileName, $vars = array())
	{
		foreach ($vars as $k => $v)
		$$k = $v;

		ob_start();
		include "$fileName";
		return ob_get_clean();
	}
}