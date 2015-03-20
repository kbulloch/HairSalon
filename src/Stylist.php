<?php

    class Stylist
    {
        private $name;

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
    }

?>
