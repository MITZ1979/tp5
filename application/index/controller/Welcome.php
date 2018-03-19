<?php
namespace app\index\controller;

class Welcome extends Base
{
    public function welcome()
    {
        $this->display('welcome:welcome');
        return $this->view->fetch();
    }
}
?>

