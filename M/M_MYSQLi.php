<?php

    //
    //����� ��� ��� ������ � ����� ������
    //
    class M_MYSQLi{
        private $host;
        private $username;
        private $database;
        private $password;
        static public $connection;
        static public $instance;  //��� �������� ���������� ������� �����, �������������� ���������� ������
        static public function GetInstance($host='localhost', $username='root', $database='testbook', $password=''){
            if( self::$instance == null){
                self::$instance = new M_MYSQLi($host, $username, $database, $password);
            self::$instance->OpenConnection();
            return self::$instance;
            }
        }

        //
        //����������� ����� ��� �������
        //�������� ������ ����������� ������
        //
        private function __construct($host, $username, $database, $password){
            $this->host = $host;
            $this->username = $username;
            $this->database = $database;
            $this->password = $password;
        }

        //
        //�������� ����������
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
        //��������� ����������
        //
        public function ChangeProperties($args=array()){    //��������� ���������� host, username, database, password
            foreach($args as $key => $value)                //���������� ��������� ��� ������ array('host'=>'localhost')
                $this->$key = $value;
        }

        //
        // SELECT       - ������
	    // $query    	- ������ ����� SQL �������
	    // ���������	- ������ ��������� ��������
	    //
        public function Select($query){
            $result = mysqli_query($this->connection, $query);
		if (!$result)
			die(mysqli_error($this->connection));
			$arr = mysqli_fetch_all($result,1);
		return $arr;
        }

        //
        // INSERT       - ������
        // $table 		- ��� �������
	    // $object 		- ������������� ������ � ������ ���� "��� ������� - ��������"
	    // ���������	- ������������� ����� ������
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
    	// ��������� �����
    	// $table 		- ��� �������
    	// $object 		- ������������� ������ � ������ ���� "��� ������� - ��������"
    	// $where		- ������� (����� SQL �������)
    	// ���������	- ����� ���������� �����
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
    	// �������� �����
    	// $table 		- ��� �������
    	// $where		- ������� (����� SQL �������)
    	// ���������	- ����� ��������� �����
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