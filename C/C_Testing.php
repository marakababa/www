<?
    Class C_Testing extends C_Controller
    {
        private static $instance;

        //
        //�������� ����������
        //
        public static function GetInstance()
        {
            if (self::$instance == null) {
                return self::$instance = new self();
            } else {
                return self::$instance;
            }
        }

        protected function Input()
        {

        }

        protected function  Output()
        {
            if ($this->IsGet())
                echo $this->View("V\\V_Testing.php");
            if($this->IsPost())
                echo $this->View("{$_POST['page']}");
        }
    }