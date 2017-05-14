<?php
include_once('config.php');

class Database
{


    public function db_connect()
    {

        $this->conn = mysqli_connect(HOST, USER_NAME, USER_PASS, DB_NAME);
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

    }

    //Подключение к базе-----------------------------------------------------------------------------------
    public function db_insert($table_name, $arr)
    {

        $conn = $this->db_connect();
        $conn = $this->conn;
        $arr_key = array_keys($arr);

        foreach ($arr_key as $key) {

            $arr_keys = $arr_keys . $key . ",";
            $arr_values = $arr_values . "'" . mysqli_real_escape_string($conn, $arr[$key]) . "',";
        }

        $arr_keys = substr($arr_keys, 0, -1);
        $arr_values = substr($arr_values, 0, -1);

        $sql = "INSERT INTO " . $table_name . " (" . $arr_keys . ") VALUES(" . $arr_values . ")";
        if (mysqli_query($conn, $sql)) {
            //echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    //-----------------------------------------------------------------------------------------------------








    //РЕДАКТИРУЕМ таблица-------------------------------------------------------------------------------------

    public function db_update($table_name, $sql_param)
    {
        $conn = $this->db_connect();
        $conn = $this->conn;

        $sql = "UPDATE " . $table_name . " " . $sql_param;
        if (mysqli_query($conn, $sql)) {
            //echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    //-----------------------------------------------------------------------------------------------------


    //УДАЛЯЕМ из таблицы-------------------------------------------------------------------------------------
    public function db_delete($table_name, $sql_param)
    {
        $conn = $this->db_connect();
        $conn = $this->conn;

        $sql = "DELETE FROM " . $table_name . " " . $sql_param;
        if (mysqli_query($conn, $sql)) {
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    //-----------------------------------------------------------------------------------------------------


    //Выводим из таблицы-------------------------------------------------------------------------------------
    public function db_select($table_name, $from, $sql_param)
    {
        $this->db_connect();
        $conn = $this->conn;

        $sql = "SELECT ".$from." FROM " . $table_name . " " . $sql_param;
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {

                $rows[] = $row;
            }
        }

        mysqli_close($conn);
        return $rows;
    }

    //------------------------------------------


}

?>
