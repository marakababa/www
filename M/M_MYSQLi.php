<?php

    //
    //Класс для для работы с базой данных
    //
    class M_MYSQLi{
        private $host;
        private $username;
        private $database;
        private $password;
        static public $connection;
        static public $instance;  //Для хранения экземпляра данного класа, предотвращения дубликации класса
        static public function GetInstance($host='localhost', $username='root', $database='testbook', $password=''){
            if( self::$instance == null){
                self::$instance = new M_MYSQLi($host, $username, $database, $password);
            self::$instance->OpenConnection();
            return self::$instance;
            }
        }

        //
        //Конструктор скрыт для запрета
        //создания лишних экземпляров класса
        //
        private function __construct($host, $username, $database, $password){
            $this->host = $host;
            $this->username = $username;
            $this->database = $database;
            $this->password = $password;
        }

        //
        //Открытие соеденения
        //
        public function OpenConnection($nameset='SET NAMES cp1251'){
            $connection=mysqli_connect($this->host, $this->username, $this->password);
            if(!$connection)
                die("Cannot connect to database:".mysqli_error($connection));
            mysqli_select_db($connection, $this->database) or die('Cannot select database:'.mysqli_error());
            mysqli_query($connection, $nameset);
            $this->connection=$connection;
        }

        //
        //Изменение аргументов
        //
        public function ChangeProperties($args=array()){    //Изменение аргументов host, username, database, password
            foreach($args as $key => $value)                //передавать аргументы как массив array('host'=>'localhost')
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
        // $table 		- имя таблицы
	    // $object 		- ассоциативный массив с парами вида "имя столбца - значение"
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
    	// Изменение строк
    	// $table 		- имя таблицы
    	// $object 		- ассоциативный массив с парами вида "имя столбца - значение"
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
    	// Удаление строк
    	// $table 		- имя таблицы
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
?>