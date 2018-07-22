<?php
class IndexController extends \HXPHP\System\Controller
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

    $this->auth->redirectCheck(true);
  }

  public function logarAction()
	{
		$this->auth->redirectCheck(true);

		$this->view->setFile('home');

		$post = $this->request->post();

		if (!empty($post)) {
			$login = User::login($post);

			if ($login->status === true){
				$this->auth->$login($login->user->id, $login->user->email);
			}
			else {
				$this->load('Modules\Messages', 'auth');
				$this->messages->setBlock('alerts');
				$error = $this->messages->getByCode($login->code, array(
					'message' => 'erro na autenticação'
				));

				$this->load('Helpers\Alert', $error);
			}
		}
	}

	public function sairAction()
	{
		return $this->auth->logout();
	}

}
