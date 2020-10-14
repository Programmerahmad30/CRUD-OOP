<?php


class DataBase
{
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $dbname = "softcompany";
	private $conn;


	public function __construct()
    {
        //Magic Method Connection Database
        $this->conn = mysqli_connect
        (
            $this->servername, $this->username, $this->password, $this->dbname
        );
        if (!$this->conn)
        {
            die("Error Connect : " . mysqli_connect_error());
        }
    }


    //Insert
    public function insert($sql)
    {
        /*
         * بناخد اتنين بارما الاتصال مع قاعدة البيانات وال (query)الا انت عايز تعملها فى قادة البيانات
         * */
        if (mysqli_query($this->conn, $sql))
        {
            return"Added Success";
        }
        else
        {
            $this->ErrorConnected();
        }
    }

    //Read
    public function read($table)
    {
        $sql = "SELECT * FROM $table";
        //بنعمل اتصال على الداتا بيز ونمرر جملة($sql)
        $result = mysqli_query($this->conn, $sql);

        $data = [];

        if ($result)
        {
            // ($result)-> هل في بيانات ولا لاء
            if (mysqli_num_rows($result))
            {
                //لو فى بيانات رجعها علي شكل assositef Array
                while ($row = mysqli_fetch_assoc($result))
                {
                    $data[] = $row;
                }
                return $data;
            }
        }
        else
        {
            $this->ErrorConnected();
        }
    }


    //Find
    public function find($table,$id)
    {
        $sql = "SELECT * FROM $table WHERE id= '$id'";
        $result = mysqli_query($this->conn, $sql);

        if ($result)
        {
            if (mysqli_num_rows($result))
            {
                return mysqli_fetch_assoc($result);
            }
            return false;
        }
        else
        {
            $this->ErrorConnected();
        }
    }

    //Update
    public function update($sql)
    {
        if (mysqli_query($this->conn, $sql))
        {
            return"Update Success";
        }
        else
        {
            $this->ErrorConnected();
        }
    }

    //Delete
    public function delete($table, $id)
    {
        $sql = "DELETE FROM $table WHERE id = '$id'";
        if (mysqli_query($this->conn, $sql))
        {
            return"Delete Success";
        }
        else
        {
           $this->ErrorConnected();
        }

    }

    //EncryptPassword
    public function enc_password($password)
    {
        return sha1($password);
    }

    //Error
    private function ErrorConnected()
    {
        die("Error : " . mysqli_error($this->conn));
    }
}