<?php

    class Stylist
    {
        private $name;
        private $id;

        function __construct($name)
        {
            $this->name = $name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO stylists (name) VALUES ('{$this->getName()}');");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists *;");
        }
    }

?>
