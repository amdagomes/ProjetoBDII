<?php

class CriareventoController extends \HXPHP\System\Controller
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

    $user_id = $this->auth->getUserId();
    $user = User::find($user_id);

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
			$cadastrarEvento = Event::cadastrar($post, $user_id);

			if ($cadastrarEvento->status === false) {
				$this->load('Helpers\Alert', array(
					'danger',
					'Não foi possível efetuar seu cadastro. Verifique os erros abaixo:',
					$cadastrarEvento->errors
				));
			}
		}
	}

}
