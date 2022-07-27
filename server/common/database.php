<?php
class Database
{
    private const HOSTNAME = "localhost";
    private const USER = "root";
    private const PASSWORD = "";
    private const DB = "ecommerce-oop";

    protected function connectDb()
    {
        if ($db = new mysqli(self::HOSTNAME, self::USER, self::PASSWORD, self::DB)) {
            return $db;
        }
    }
}
?>