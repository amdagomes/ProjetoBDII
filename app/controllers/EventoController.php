<?php

class EventoController extends \HXPHP\System\Controller
{
  public function __construct($configs)
  {
    parent::__construct($configs);

    $this->load(
      'Services\Auth',
      $configs->auth->after_login,
      $configs->auth->after_logout,
      true
    );

    $this->auth->redirectCheck();

    $this->load(
      'Helpers\Menu',
      $this->request,
      $this->configs
    );

  }

	public function criarAction()
	{
		$this->view->setFile('index');

		$post = $this->request->post();

		if (!empty($post)) {
			$cadastrarEvento = Event::criar($post);


        $this->load('Modules\Messages', 'auth');
				$this->messages->setBlock('alerts');
				$error = $this->messages->getByCode($cadastrarEvento->code);

				$this->load('Helpers\Alert', $error);
			
		}
	}
}
