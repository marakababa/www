<?php

    //
    // ласс дл¤ дл¤ работы с базой данных
    //
    class M_MYSQLi{
        private $host;
        private $username;
        private $database;
        private $password;
        static public $connection;
        static public $instance;  //ƒл¤ хранени¤ экземпл¤ра данного класа, предотвращени¤ дубликации класса

		/**
		 * Функция создание экземпляра класса M_MYSQLi
		 * При вызове функции без передачи аргументов, аргументы будут взяты из файла settings.json.
		 * Если в файле отсутстуют нехоторое из настроек они будут взяты по умолчанию.
		 * @since 1.0
		 * @param $host (String) = 'localhost' - адрес на котором расположена база данных
		 * @param $username (String) = 'root' - имя пользователя для доступа к базе
		 * @param $databas (String) = 'testsys' - имя базы данных в хоторой будут распологаться данные
		 * @param $password (String) = '' - пароль от базы данных
		 * @param $opencon (Bool) = true - создавать соединение с базой данные при создании экземпляра или нет
		 * @return M_MYSQLi
		 */
        static public function GetInstance($host = 'localhost', $username = 'root', $database = 'testsys', $password = '', $opencon = true){

			$user = new User(array(
				'user_id' => '1'
			));
			if(isset($GLOBALS['__host']))
				$host = $GLOBALS['__host'];
			if(isset($GLOBALS['__user']))
				$username = $GLOBALS['__user'];
			if(isset($GLOBALS['__password']))
				$password = $GLOBALS['__password'];
			if(isset($GLOBALS['__database']))
				$database = $GLOBALS['__database'];
            if( self::$instance == null)
                self::$instance = new M_MYSQLi($host, $username, $database, $password);
			if($opencon)
				self::$instance->OpenConnection();
			return self::$instance;
        }

        /**
		 * Конструктор класса M_MYSQLi
        */
        private function __construct($host, $username, $database, $password){
            $this->host = $host;
            $this->username = $username;
            $this->database = $database;
            $this->password = $password;
        }

        /**
		 * Создает соединение с базой данных. Вызывается автматически при создании экземпляра класса.
		 *
        */
        public  function OpenConnection($nameset='SET NAMES utf-8'){
            $connection=mysqli_connect($this->host, $this->username, $this->password);
            if(!$connection)
                die("Cannot connect to database:".mysqli_error($connection));
            mysqli_select_db($connection, $this->database) or die('Cannot select database:'.mysqli_error());
            mysqli_query($connection, $nameset);
            $this->connection=$connection;
        }

        /**
		 * Изменеие параметров
		 * @param array('user' => 'root' ) - Где ключ это имя параметра, а значение это передаваемый аргумент
        */
        public function ChangeProperties($args=array()){
            foreach($args as $key => $value)
                $this->$key = $value;
        }

        //
        // SELECT       - запрос
	    // $query    	- полный текст SQL запроса
	    // результат	- массив выбранных объектов
	    //
        public function Select($query){
            $result = mysqli_query($this->connection, $query);
		if (!$result)
			die(mysqli_error($this->connection));
			$arr = mysqli_fetch_all($result,1);
		return $arr;
        }

        //
        // INSERT       - запрос
        // $table 		- им¤ таблицы
	    // $object 		- ассоциативный массив с парами вида "им¤ столбца - значение"
	    // результат	- идентификатор новой строки
        //
        public function Insert($table, $object){
		$columns = array();
		$values = array();
		foreach ($object as $key => $value){
			$key = mysqli_real_escape_string($this->connection,$key . '');
			$columns[] = $key;

			if ($value === null){
				$values[] = 'NULL';
			}
			else{
				$value = mysqli_real_escape_string($this->connection,$value . '');
				$values[] = "'$value'";
			}
		}
		$columns_s = implode(',', $columns);
		$values_s = implode(',', $values);
		$query = "INSERT INTO $table ($columns_s) VALUES ($values_s)";
		$result = mysqli_query($this->connection,$query);
		if (!$result)
			die(mysqli_error($this->connection));

		return mysqli_insert_id($this->connection);
	    }

    	//
    	// »зменение строк
    	// $table 		- им¤ таблицы
    	// $object 		- ассоциативный массив с парами вида "им¤ столбца - значение"
    	// $where		- условие (часть SQL запроса)
    	// результат	- число измененных строк
    	//
    	public function Update($table, $object, $where)
    	{
    		$sets = array();

    		foreach ($object as $key => $value)
    		{
    			$key = mysqli_real_escape_string($this->connection,$key . '');

    			if ($value === null)
    			{
    				$sets[] = "$key=NULL";
    			}
    			else
    			{
    				$value = mysqli_real_escape_string($this->connection,$value . '');
    				$sets[] = "$key='$value'";
    			}
    		}

    		$sets_s = implode(',', $sets);
    		$query = "UPDATE $table SET $sets_s WHERE $where";
    		$result = mysqli_query($this->connection,$query);

    		if (!$result)
    			die(mysqli_error($this->connection));

    		return mysqli_affected_rows($this->connection);
    	}

    	//
    	// ”даление строк
    	// $table 		- им¤ таблицы
    	// $where		- условие (часть SQL запроса)
    	// результат	- число удаленных строк
    	//
        public function Delete($table, $where){
		$query = "DELETE FROM $table WHERE $where";
		$result = mysqli_query($this->connection,$query);

		if (!$result)
			die(mysqli_error($this->connection));

		return mysqli_affected_rows($this->connection);
	    }
        /*public function EchoAll(){
            echo $this->host . '<br>';
            echo $this->username . '<br>';
            echo $this->database . '<br>';
            echo $this->password . '<br>';
        }*/
    }