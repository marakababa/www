<?php
    class C_API extends C_Controller{
        private $msql;
        private $musers;
        private $data;
        private static $instance;

        //
        //Ñîçäàíèå ıêçåìïëÿğà
        //
        public static function GetInstance(){
            if(self::$instance==null){
               return self::$instance=new self();
            }else{
                return self::$instance;
            }
        }
        protected function __construct(){
            $this->musers=M_Users::GetInstance();
            $this->data=array();
        }
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
                                        $this->data['ErrorHtml']=$this->View('\V\elements\error.php',array('errmsg'=>$errmsg));
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