<?php

    /**
     * Class C_API
     * $msql - подключение к базе данных и набор функций по работе с ней.
     * $musers - набор функций по работе с пользователями
     * $data - данные возвращаемы в виде JSON объекта
     * $instance - переменная хранящая экземпляр данного класса
     */
    class C_API extends C_Controller{
        private $msql;
        private $musers;
        private $data;
        private static $instance;

        /**
         * GetInstance()
         * Возвращает экземпляр данного класса еслм он уже был создан,
         * иначе создаёт его. Прдотвращение множества копий класса и чрезмерного использования памяти.
         */
        public static function GetInstance(){
            if(self::$instance==null){
               return self::$instance=new self();
            }else{
                return self::$instance;
            }
        }

        /**
         *
         */
        protected function __construct(){
            $this->musers=M_Users::GetInstance();
            $this->data=array();
        }

        /**
         *  Input()
         *  "Вынимает" данные из запроса POST
         */
        protected function Input(){
            if( $this->IsPost() && isset($_POST['command']) ){
                switch($_POST['command']){
                    case 'LogIn':{
                        if(isset($_POST['username'])&&isset($_POST['password'])){
                            $musers=$this->musers;
                            $username= $_POST['username'];
                            $password= $_POST['password'];
                            $data=$this->data;
                            if($musers->Login($username,$password))
                                $this->data['LogIn']=true;
                            else{
                                $this->data['LogIn']=false;
                                if(isset($_POST['html']) && $_POST['html']=="yes"){
                                    if(isset($_POST['errmsg'])){
                                        $errmsg=$_POST['errmsg'];
                                        $this->data['ErrorHtml']=$this->View("{$GLOBALS['__elements']}error.php",array('errmsg'=>$errmsg));
                                    }
                                }
                            }
                        }
                        break;
                }
                    case 'ErrorHtml':{

                        break;
                }
            }
        }
    }
        protected function Output(){
            echo json_encode($this->data);
        }
}