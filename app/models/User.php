<?php

class User extends \HXPHP\System\Model{
	public static function cadastrar(array $post){
		//$password = \HXPHP\System\Tools::hashHX($post['password']);

		//$post = array_merge($post, $password);

		return self::create($post);
	}
}
