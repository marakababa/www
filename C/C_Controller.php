<?php
    class C_Controller{

    //
	// �����������.
	//
	protected   function __construct()
	{
	}

	//
	// ������ ��������� HTTP �������.
	//
	public function Request()
	{
		$this->Input();
		$this->Output();
	}

	//
	// ����������� ���������� �������.
	//
	protected function Input()
	{
	}

	//
	// ����������� ��������� HTML.
	//
	protected function Output()
	{
	}

	//
	// ������ ���������� ������� GET?
	//
	protected function IsGet()
	{
		return $_SERVER['REQUEST_METHOD'] == 'GET';
	}

	//
	// ������ ���������� ������� POST?
	//
	protected function IsPost()
	{
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}

	//
	// ��������� HTML ������� � ������.
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