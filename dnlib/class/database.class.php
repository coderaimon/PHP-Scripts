<?php

class Database
{
    private $connection;
    function __construct()
    {
        try {
            $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }

    private function bindParamDatatype($data)
    {
        $params = '';
        foreach ($data as $value) {
            if (is_float($value)) $params .= 'd';
            elseif (is_integer($value)) $params .= 'i';
            elseif (is_string($value)) $params .= 's';
            else $params .= 's';
        }
        return $params;
    }

    private function bindParamlabel($data)
    {
        $label = '';
        foreach ($data as $val) {
            $label .= '?,';
        }
        $label = substr_replace($label, '', -1);
        return $label;
    }

    public function insert($table, $columns, $value)
    {
        $label = $this->bindParamlabel($value);
        $sql = "INSERT INTO $table ($columns) VALUES ($label)";
        $run = $this->connection->prepare($sql);
        $run->bind_param($this->bindParamDatatype($value), ...$value);
        return $run->execute();
    }

    private function paramlebelwithname($data)
    {
        $label = '';
        $columns = explode(',', $data);
        foreach ($columns as $val) {
            $label .= $val . '=?,';
        }
        $label = substr_replace($label, '', -1);
        return $label;
    }

    public function update($table, $columns, $values, $condition)
    {
        $lebel = $this->paramlebelwithname($columns);
        $sql = "UPDATE $table SET $lebel WHERE $condition";
        $result = $this->connection->prepare($sql);
        $result->bind_param($this->bindParamDatatype($values), ...$values);
        return $result->execute();
    }
    
    public function delete($table, $condition)
    {
        $sql = "DELETE FROM $table WHERE $condition";
        return $this->connection->query($sql);
    }

    public function read_all($table, $columns = '*', $condition = '')
    {
        $data = $this->connection->query("SELECT $columns FROM $table $condition");
        return $data->fetch_all(true);
    }
    
    public function read_assoc($table, $columns = '*', $condition = '')
    {
        $data = $this->connection->query("SELECT $columns FROM $table $condition");
        return $data->fetch_assoc() ?? array();
    }

    public function clean($txt){
        return mysqli_real_escape_string($this->connection,$txt);
    }

    public function genarateuid(){
        return md5(time());
    }

}
