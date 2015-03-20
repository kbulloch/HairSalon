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

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        //function setStylistId()

        function getStylistId()
        {
            return $this->stylist_id;
        }



        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients *;");
        }
    }

?>
