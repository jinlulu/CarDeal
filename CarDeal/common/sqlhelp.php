<?php

namespace sqlhelp;


class sqlhelp
{
    private $dbHost     = "127.0.0.1";
    private $dbUsername = "root";
    private $dbPassword = "root";
    private $dbName     = "hw201202";

    //初始化方法
    public function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $conn = mysqli_connect($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
                $this->db->query("set names utf8");
            }
        }
    }

    //获取单行数据
    public function get_row($sql){
        $result = $this->query($sql);
        if ($result->num_rows > 0) {
            // output value? check it later before submit to blackbroad
            return $result->fetch_assoc();
        }
        return null;
    }

    //获取多行数据
    public function get_rows($sql){
        $result = $this->query($sql);
        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

    //执行sql
    public function query($sql){
		$result = $this->db->query($sql);
        if($result){
            return $result;
        }else{
            die('error_sql: '.$sql.' <br> mysqli_error: '.mysqli_error($this->db));
        }
        //return $this->db->query($sql) or die('error: '.$sql);
    }

    //获取上次插入语句的主键
	public function get_insert_id(){
        $id = mysqli_insert_id($this->db);
        return $id;
    }

    //通过数组插入数据
    public function insert_by_arr($arr,$table){
        $i=0;
        $insertkey = "";
        $insertvalue = "";
        foreach($arr as $key=>$value){
            if ($i==0){
                $insertkey = "`".$key."`";
                $insertvalue = "'".$value."'";
            } else {
                $insertkey.= ",`".$key."`";
                $insertvalue.=",'".$value."'";
            }
            $i++;
        }
        $sql = "insert into $table($insertkey) values($insertvalue)";
        $this->query($sql);
        return $this->get_insert_id();
    }

    //通过数组更新数据
    public function update_by_arr($arr,$table,$where){
        $i=0;
        $change = "";
        foreach ($arr as $key=>$value){
            if ($i==0){
                $change = "`$key`='$value'";
            } else{
                if($value === null){
                    $change .=" ,`$key`= NULL ";
                }else{
                    $change .=",`$key`='$value'";
                }
            }
            $i++;
        }
        $sql = "update `$table` set $change where $where";
        return $this->query($sql);
    }

}