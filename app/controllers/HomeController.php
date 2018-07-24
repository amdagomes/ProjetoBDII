<?php
class HomeController extends \HXPHP\System\Controller
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

		$this->view->setTitle('Eventos Acadêmicos')
					->setVar('user', $user);

	}

}
