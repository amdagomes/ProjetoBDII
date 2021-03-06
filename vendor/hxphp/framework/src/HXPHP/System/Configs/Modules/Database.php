<?php

namespace HXPHP\System\Configs\Modules;

class Database
{
    public $driver;

    public $host;

    public $user;

    public $password;

    public $dbname;

    public $charset;

    public function __construct()
    {
        $this->setConnectionData([
            'driver'   => 'mysql',
            'host'     => '127.0.0.1',
            'user'     => 'root',
            'password' => '',
            'dbname'   => 'projetobdii',
            'charset'  => 'utf8',
        ]);
    }

    public function setConnectionData(array $data): self
    {
        foreach ($data as $param => $value) {
            if (!property_exists($this, $param)) {
                throw new \Exception("O parametro <$param> nao existe. Verifique a sintaxe e tente novamente", true);
            }
            $this->$param = $value;
        }

        return $this;
    }
}
