<?php
  $configs = new HXPHP\System\Configs\Config;
  ActiveRecord\Connection::$datetime_format = 'Y-m-d H:i:s';

  //Globais
  $configs->title = 'HXPHP Framework';

  //Configurações de Ambiente - Desenvolvimento
  $configs->env->add('development');

  $configs->env->development->baseURI = '/ProjetoBDII/';

  $configs->env->development->database->setConnectionData([
    'driver' => env('DB_DRIVER', 'mysql'),
    'host' => env('MYSQL_HOST', '127.0.0.1'),
    'user' => env('MYSQL_USER', 'root'),
    'password' => env('MYSQL_PASSWORD', ''),
    'dbname' => env('MYSQL_DATABASE', 'projetobdii'),
    'charset' => env('MYSQL_CHARSET', 'utf8')
  ]);

  $configs->env->development->auth->setURLs('/ProjetoBDII/home/', '/ProjetoBDII/');
  return $configs;
/*

  $configs->env->development->mail->setFrom([
    'from' => 'Remetente',
    'from_mail' => 'email@remetente.com.br'
  ]);

  $configs->env->development->menu->setConfigs([
    'container' => 'nav',
    'container_class' => 'navbar navbar-default',
    'menu_class' => 'nav navbar-nav'
  ]);

  $configs->env->development->menu->setMenus([
    'Home/home' => '%siteURL%',
    'Subpasta/folder-open' => [
      'Home/home' => '%baseURI%/admin/have-fun/',
      'Teste/home' => '%baseURI%/admin/index/',
    ]
  ]);

  $configs->env->development->auth->setURLs('/hxphp/home/', '/hxphp/login/');
  $configs->env->development->auth->setURLs('/hxphp/admin/home/', '/hxphp/admin/login/', 'admin');

  //Configurações de Ambiente - Produção
  $configs->env->add('production');

  $configs->env->production->baseURI = '/';

  $configs->env->production->database->setConnectionData([
    'driver' => 'mysql',
    'host' => 'localhost',
    'user' => 'usuariodobanco',
    'password' => 'senhadobanco',
    'dbname' => 'hxphp',
    'charset' => 'utf8'
  ]);

  $configs->env->production->mail->setFrom([
    'from' => 'Remetente',
    'from_mail' => 'email@remetente.com.br'
  ]);
 */

return $configs;
