<?php

//
// Менеджер пользователей
//
class M_Users
{	
	private static $instance;	// экземпляр класса
	private $msql;				// драйвер БД
	private $sid;				// идентификатор текущей сессии
	private $uid;				// идентификатор текущего пользователя
	private $onlineMap;			// карта пользователей online
	
	//
	// Получение экземпляра класса
	// результат	- экземпляр класса MSQL
	//
	public static function GetInstance()
	{
		if (self::$instance == null)
			self::$instance = new M_Users();
		return self::$instance;
	}

	//
	// Конструктор
	//
	public function __construct()
	{
		$this->msql = M_MYSQLi::GetInstance();
		$this->sid = null;
		$this->uid = null;
		$this->onlineMap = null;
	}

	/**
	 * Очистка неиспользуемых сессий
	 * Удаление сессий которые были созданы час назад
	 */
	/*public function ClearSessions()
	{
		$min = date('Y-m-d H:i:s', time() - 60 * 20);
		$t = "ss_timelast < '%s'";
		$where = sprintf($t, $min);
		$this->msql->Delete('sessions', $where);
	}*/

	/**
	* Авторизация
	* @param $login 		- логин
	* @param $password 	- пароль
	* @param $remember 	- нужно ли запомнить в куках
	* @return bool	- true или false
	*/
	public function Login($login, $password, $remember = true)
	{
		// вытаскиваем пользователя из БД 
		$user = $this->GetByLogin($login);
		if ($user == null)
			return false;
		$id_user = $user['us_id'];
		// проверяем пароль
		if ($user['us_pass'] != md5($password))
			return false;

		// запоминаем имя и md5(пароль)
		if ($remember)
		{
			$expire = time() + 3600 * 24 * 100;
			setcookie('login', $login, $expire);
			setcookie('password', md5($password), $expire);
		}		
				
		// открываем сессию и запоминаем SID
		$this->sid = $this->OpenSession($id_user);
		
		return true;
	}
	
	/**
	* Выход
	*/
	public function Logout()
	{
		setcookie('login', '', time() - 1);
		setcookie('password', '', time() - 1);
        setcookie('ssid',time() - 1);
		unset($_COOKIE['login']);
		unset($_COOKIE['password']);
		unset($_SESSION['sid']);
		$this->sid = null;
		$this->uid = null;
	}

	//TODO Сделать функцию создания пользователя
	public function Register($login, $password, $args = array()){

	}


	//
	// Получение пользователя
	// $id_user		- если не указан, брать текущего
	// результат	- объект пользователя
	//
	public function Get_user($id_user = null)
	{
		// Если id_user не указан, берем его по текущей сессии.
		if ($id_user == null)
			$id_user = $this->GetUid();
			
		if ($id_user == null)
			return null;
			
		// А теперь просто возвращаем пользователя по id_user.
		$t = "SELECT users.us_id, users.us_name, users.us_email, fields.field_name, users2fields.field_content, user_types.user_type_name
			  FROM users
			  LEFT JOIN users2fields ON users.us_id = users2fields.user_id
			  LEFT JOIN fields ON fields.field_id = users2fields.field_id
			  LEFT JOIN user_types ON user_types.user_type_id = users.us_type_id
			  WHERE us_id = '%d'";
		$query = sprintf($t, $id_user);
		$result = $this->msql->Select($query);
		$array= array(
			'id' => $result[0]['us_id'],
			'login' => $result[0]['us_name'],
			'user_type' => $result[0]['user_type_name'],
			'email' => $result[0]['us_email'],
		);
		foreach ($result as $row){
			$array[$row['field_name']] = $row['field_content'];
		}
		return new User($array);
	}
	
	//
	// Получает пользователя по логину
	//
	public function GetByLogin($login)
	{	
		$t = "SELECT * FROM users WHERE us_name = '%s'";
		$query = sprintf($t, mysqli_real_escape_string($this->msql->connection,$login));
		$result = $this->msql->Select($query);
		return $result[0];
	}
			
	//
	// Проверка наличия привилегии
	// $priv 		- имя привилегии
	// $id_user		- если не указан, значит, для текущего
	// результат	- true или false
	//
	public function Can($priv, $id_user = null)
	{		
		if ($id_user == null)
		    $id_user = $this->GetUid();
		    
		if ($id_user == null)
		    return false;
		    
		$t = "SELECT count(*) as cnt FROM privs2roles p2r
			  LEFT JOIN users u ON u.id_role = p2r.id_role
			  LEFT JOIN privs p ON p.id_priv = p2r.id_priv 
			  WHERE u.id_user = '%d' AND p.name = '%s'";
		
		$query  = sprintf($t, $id_user, $priv);
		$result = $this->msql->Select($query);
		
		return ($result[0]['cnt'] > 0);
	}

	//
	// Проверка активности пользователя
	// $id_user		- идентификатор
	// результат	- true если online
	//
	public function IsOnline($id_user)
	{		
		if ($this->onlineMap == null)
		{	    
		    $t = "SELECT DISTINCT ss_us_id FROM sessions";
		    $query  = sprintf($t, $id_user);
		    $result = $this->msql->Select($query);
		    
		    foreach ($result as $item)
		    	$this->onlineMap[$item['us_id']] = true;
		}
		
		return ($this->onlineMap[$id_user] != null);
	}
	
	//
	// Получение id текущего пользователя
	// результат	- UID
	//
	public function GetUid()
	{	
		// Проверка кеша.
		if ($this->uid != null)
			return $this->uid;	

		// Берем по текущей сессии.
		$sid = $this->GetSid();
				
		if ($sid == null)
			return null;
			
		$t = "SELECT ss_us_id FROM sessions WHERE ss_sid = '%s'";
		$query = sprintf($t, mysqli_real_escape_string($this->msql->connection,$sid));
		$result = $this->msql->Select($query);

		// Если сессию не нашли - значит пользователь не авторизован.
		if (count($result) == 0)
			return null;
			
		// Если нашли - запоминм ее.
		$this->uid = $result[0]['us_id'];
		return $this->uid;
	}

	//
	// Функция возвращает идентификатор текущей сессии
	// результат	- SID
	//
	private function GetSid()
	{
		// Проверка кеша.
		if ($this->sid != null)
			return $this->sid;
	
		// Ищем SID в сессии.
		$sid = $_SESSION['sid'];
								
		// Если нашли, попробуем обновить time_last в базе. 
		// Заодно и проверим, есть ли сессия там.
		if ($sid != null)
		{
			$session = array();
			$session['ss_timelast'] = date('Y-m-d H:i:s');
			$t = "ss_sid = '%s'";
			$where = sprintf($t, mysqli_real_escape_string($this->msql->connection,$sid));
			$affected_rows = $this->msql->Update('sessions', $session, $where);

			if ($affected_rows == 0)
			{
				$t = "SELECT count(*) FROM sessions WHERE ss_sid = '%s'";
				$query = sprintf($t, mysqli_real_escape_string($this->msql->connection,$sid));
				$result = $this->msql->Select($query);
				
				if ($result[0]['count(*)'] == 0)
					$sid = null;			
			}			
		}		
		
		// Нет сессии? Ищем логин и md5(пароль) в куках.
		// Т.е. пробуем переподключиться.
		if ($sid == null && isset($_COOKIE['login']))
		{
			$user = $this->GetByLogin($_COOKIE['login']);
			
			if ($user != null && $user['us_pass'] == $_COOKIE['password'])
				$sid = $this->OpenSession($user['us_id']);
		}
		
		// Запоминаем в кеш.
		if ($sid != null)
			$this->sid = $sid;
		
		// Возвращаем, наконец, SID.
		return $sid;		
	}
	
	//
	// Открытие новой сессии
	// результат	- SID
	//
	private function OpenSession($id_user)
	{
		// генерируем SID
		$sid = $this->GenerateStr(32);
				
		// вставляем SID в БД
		$now = date('Y-m-d H:i:s'); 
		$session = array();
		$session['ss_us_id'] = $id_user;
		$session['ss_sid'] = $sid;
		$session['ss_timestart'] = $now;
		$session['ss_timelast'] = $now;
		$this->msql->Insert('sessions', $session); 
				
		// регистрируем сессию в PHP сессии
		$_SESSION['sid'] = $sid;
        $expire = time()+3600*3;
		setcookie('ssid',$sid,$expire);
		// возвращаем SID
		return $sid;	
	}

	//
	// Генерация случайной последовательности
	// $length 		- ее длина
	// результат	- случайная строка
	//
	private function GenerateStr($length = 10)
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;  

		while (strlen($code) < $length) 
            $code .= $chars[mt_rand(0, $clen)];  

		return $code;
	}
}
