<?php

class Event extends \HXPHP\System\Model
{

    public static function criar(array $post)
    {
      $dataAtual = date('Y-m-d');
      $callbackObj = new \stdClass;
      $callbackObj->event = null;
      $callbackObj->status = false;
      $callbackObj->code = null;
      $dataI = $post['dataI'];
      $dataF = $post['dataF'];

      if(strtotime($dataI) >= strtotime($dataAtual) && strtotime($dataI) <= strtotime($dataF) || $dataF == null){
          $cadastrar = self::create($post);
          if ($cadastrar->is_valid()) {
            $callbackObj->event = $cadastrar;

            $callbackObj->status = true;
            $callbackObj->code = 'evento-criado';
            return $callbackObj;
          }

      } else{
        $callbackObj->code = 'data-invalida';
      }

      return $callbackObj;
    }

}
