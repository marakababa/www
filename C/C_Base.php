<?php

//
// Базовый контроллер сайта.
//
abstract class C_Base extends C_Controller
{
	protected $needLogin;	// необходимость авторизации
	protected $user;		// авторизованный пользователь
	private $start_time;	// время начала генерации страницы
    protected $content;
	//
	// Конструктор.
	//
	protected function __construct()
	{
		$this->needLogin = false;
		$this->user = null;
	}

	//
	// Виртуальный обработчик запроса.
	//
	protected function Input()
	{
		// Очистка старых сессий и определение текущего пользователя.
		$mUsers = M_Users::GetInstance();
		$mUsers->ClearSessions();
		$this->user = $mUsers->Get();

		// Перенаправление на страницу авторизации, если это необходимо.
		if ($this->user == null && $this->needLogin)
		{
			header("Location: index.php");
			die();
		}

		// Засекаем время начала обработки запроса.
		$this->start_time = microtime(true);
	}

	//
	// Виртуальный генератор HTML.
	//
	protected function Output()
	{
	    // Основной шаблон всех страниц.
        $footer=$this->View(".\V\elements\\footer.php");
		$vars = array('content' =>$this->content,'footer'=>$footer);
		$page = $this->View('.\V\V_Base.php',$vars);

		// Время обработки запроса.
        /*$time = microtime(true) - $this->start_time;
        $page .= "<!-- Время генерации страницы: $time сек.-->";*/

		// Вывод HTML.
        echo $page;
	}
}













