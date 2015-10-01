<?php
//
// Контроллер страницы авторизации
//
class C_Login extends C_Base
{
	private $login;	// логин пользователя
    protected $content;
    private static $instance;

    //
    //Создание экземпляра
    //
    public static function GetInstance(){
        if(self::$instance==null){
           return self::$instance=new self();
        }else{
            return self::$instance;
        }
    }
	//
	// Конструктор.
	//
	protected function __construct()
	{
		parent::__construct();
		$this->login = '';
	}

	//
    // Виртуальный обработчик запроса.
    //
    protected function Input()
    {
		// Выход из системы пользователя.
        $mUsers = M_Users::GetInstance();
        $mUsers->Logout();
		// C_Base.
        parent::Input();

		// Обработка отправки формы.
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
    // Виртуальный генератор HTML.
    //
    protected function Output()
    {
		// Генерация содержимого формы входа.
        //$vars = array('login' => $this->login);
    	$this->content = $this->View('.\V\V_Login.php');
		// C_Base.
        parent::Output();
    }
}