<?php

//
// ������� ���������� �����.
//
abstract class C_Base extends C_Controller
{
	protected $needLogin;	// ������������� �����������
	protected $user;		// �������������� ������������
	private $start_time;	// ����� ������ ��������� ��������
    protected $content;
	//
	// �����������.
	//
	protected function __construct()
	{
		$this->needLogin = false;
		$this->user = null;
	}

	//
	// ����������� ���������� �������.
	//
	protected function Input()
	{
		// ������� ������ ������ � ����������� �������� ������������.
		$mUsers = M_Users::GetInstance();
		$mUsers->ClearSessions();
		$this->user = $mUsers->Get();

		// ��������������� �� �������� �����������, ���� ��� ����������.
		if ($this->user == null && $this->needLogin)
		{
			header("Location: index.php");
			die();
		}

		// �������� ����� ������ ��������� �������.
		$this->start_time = microtime(true);
	}

	//
	// ����������� ��������� HTML.
	//
	protected function Output()
	{
	    // �������� ������ ���� �������.
        $footer=$this->View(".\V\elements\\footer.php");
		$vars = array('content' =>$this->content,'footer'=>$footer);
		$page = $this->View('.\V\V_Base.php',$vars);

		// ����� ��������� �������.
        /*$time = microtime(true) - $this->start_time;
        $page .= "<!-- ����� ��������� ��������: $time ���.-->";*/

		// ����� HTML.
        echo $page;
	}
}













