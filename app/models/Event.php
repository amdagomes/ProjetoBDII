<?php

class Event extends \HXPHP\System\Model
{
  public static function criarEvento(array $post)
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

}
