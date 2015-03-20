<?php

    /***********
    *Your class should have the following methods:
    __construct, getters and setters for all properties,
    save, getAll, deleteAll, find, update, and delete.
    *************/


    class Client
    {
        private $name;
        private $stylist_id;
        private $id;

        function __construct($name, $stylist_id, $id = null)
        {
            $this->name = $name;
            $this->stylist_id = $stylist_id;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getStylistId()
        {
            return $this->stylist_id;
        }

        function setStylistId($new_stylist_id)
        {
            $this->stylist_id = $new_stylist_id;
        }

        function getid()
        {
            return $this->id;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO clients (name, stylist_id) VALUES ('{$this->getName()}', {$this->getStylistId()}) RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        //function getAll()
        //function find($search_id)
        //function update()
        //function delete()




        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients *;");
        }
    }

?>
