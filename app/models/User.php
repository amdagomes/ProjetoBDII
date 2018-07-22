<?php

class User extends \HXPHP\System\Model{

	static $validates_uniqueness_of = array(
		array(
			'email',
			'message' => 'Já existe um usuário com este e-mail cadastrado.'
		)
	);

	public static function cadastrar(array $post)
	{
		$callbackObj = new \stdClass;
		$callbackObj->user = null;
		$callbackObj->status = false;
		$callbackObj->errors = array();

		$password = \HXPHP\System\Tools::hashHX($post['password']);

		$post = array_merge($post, $password);

		$cadastrar = self::create($post);

		if ($cadastrar->is_valid()) {
			$callbackObj->user = $cadastrar;
			$callbackObj->status = true;
			return $callbackObj;
		}

		$errors = $cadastrar->errors->get_raw_errors();

		foreach ($errors as $field => $message) {
			array_push($callbackObj->errors, $message[0]);
		}

		return $callbackObj;
	}

	public static function login(array $post)
	{
		$callbackObj = new \stdClass;
		$callbackObj->user = null;
		$callbackObj->status = false;
		$callbackObj->code = null;

		$user = self::find_by_email($post['email']);

		if (!is_null($user)) {
			$password = \HXPHP\System\Tools::hashHX($post['password'], $user->salt);

			if($password['password'] === $user->password){
				$callbackObj->status = true;
			} else{
					$callbackObj->code = 'senha não corresponde';
			}
		}
		else {
			$callbackObj->code = 'dados-incorretos';
		}

		return $callbackObj;
	}

}
