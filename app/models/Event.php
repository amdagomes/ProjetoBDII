<?php

class Event extends \HXPHP\System\Model
{

    public static function criar(array $post)
    {
      $dataAtual = date('d-m-Y');

      $callbackObj = new \stdClass;
      $callbackObj->event = null;
      $callbackObj->status = false;
      $callbackObj->code = null;

      $dataI = date('d-m-Y', strtotime($post['dataI']));

      if(strtotime($dataI) >= strtotime($dataAtual) && $post['dataF'] == null){
        $dataF = null;
        $cadastrar = self::create($post);
        if ($cadastrar->is_valid()) {
          $callbackObj->event = $cadastrar;

          $callbackObj->status = true;
          $callbackObj->code = 'evento-criado';
          return $callbackObj;
        }
      } else if(strtotime($dataI) >= strtotime($dataAtual) && $post['dataF'] != null){
        $dataF = date('d-m-Y', strtotime($post['dataF']));
          if (strtotime($dataI) <= strtotime($dataF)) {
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
      } else{
        $callbackObj->code = 'data-invalida';
      }


      return $callbackObj;
    }
}
