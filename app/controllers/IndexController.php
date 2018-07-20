<?php
class IndexController extends \HXPHP\System\Controller
{
    public function cadastrarAction(){

    	$this->view->setFile('index');

    	$cadastrarUsuario = User::cadastrar($this->request->post());
    }
}
