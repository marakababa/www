<?php
//
// ���������� �������� �����������
//
class C_Login extends C_Base
{
	private $login;	// ����� ������������
    protected $content;
    private static $instance;

    //
    //�������� ����������
    //
    public static function GetInstance(){
        if(self::$instance==null){
           return self::$instance=new self();
        }else{
            return self::$instance;
        }
    }
	//
	// �����������.
	//
	protected function __construct()
	{
		parent::__construct();
		$this->login = '';
	}

	//
    // ����������� ���������� �������.
    //
    protected function Input()
    {
		// ����� �� ������� ������������.
        $mUsers = M_Users::GetInstance();
        $mUsers->Logout();
		// C_Base.
        parent::Input();

		// ��������� �������� �����.
        if ($this->IsPost())
        {
	        if ($mUsers->Login($_POST['login'],
		                       $_POST['password'],
						       isset($_POST['remember'])))
			{
				header('Location: index.php');
				die();
			}

			$this->login = $_POST['login'];
        }
    }

    //
    // ����������� ��������� HTML.
    //
    protected function Output()
    {
		// ��������� ����������� ����� �����.
        //$vars = array('login' => $this->login);
    	$this->content = $this->View('.\V\V_Login.php');
		// C_Base.
        parent::Output();
    }
}