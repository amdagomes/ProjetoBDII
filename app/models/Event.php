<?php

class Event extends \HXPHP\System\Model
{
  public static function cadastrar(array $post)
  {
    $date = date('m-d-Y');
    $callbackObj = new \stdClass;
    $callbackObj->event = null;
    $callbackObj->status = false;
    $callbackObj->code = null;

    $post = array_merge($post);

    $cadastrar = self::create($post);
    echo $this->$cadastrar->data;
      if($this->$cadastrar->data < $date){
        $callbackObj->code = 'data';
      }
      else{
        $callbackObj->event = $cadastrar;
        $callbackObj->status = true;
      }


    return $callbackObj;
  }

public static function criar(array $post)
{
  $now = new ActiveRecord\DateTime();
  $now->format('custom');
  $callbackObj = new \stdClass;
  $callbackObj->event = null;
  $callbackObj->status = false;
  $callbackObj->errors = array();

  $cadastrar = self::create($post);
  echo $now;
  if ($cadastrar->is_valid()) {
    $callbackObj->event = $cadastrar;
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
