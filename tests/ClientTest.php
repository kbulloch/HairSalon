<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test');

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Client::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Francis";
            $stylist_id = 111;
            $id = null;
            $test_client = new Client($name, $stylist_id, $id);

            //Act
            $result = $test_client->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_setName()
        {
            //Arrange
            $name = "Francis";
            $stylist_id = 111;
            $id = null;
            $test_client = new Client($name, $stylist_id, $id);

            $new_name = "Lucious";

            //Act
            $test_client->setName($new_name);

            //Assert
            $this->assertEquals($new_name, $test_client->getName());
        }

        function test_getStylistId()
        {
            //Arrange
            $name = "Francis";
            $stylist_id = 111;
            $id = null;
            $test_client = new Client($name, $stylist_id, $id);

            //Act
            $result = $test_client->getStylistId();

            //Assert
            $this->assertEquals(111, $result);
        }

        function test_setStylistId()
        {
            //Arrange
            $name = "Francis";
            $stylist_id = 111;
            $id = null;
            $test_client = new Client($name, $stylist_id, $id);

            //Act
            $test_client->setStylistId(222);

            //Assert
            $this->assertEquals(222, $test_client->getStylistId());
        }


        function test_getId()
        {
            //Arrange
            $name = "Francis";
            $stylist_id = 111;
            $id = 777;
            $test_client = new Client($name, $stylist_id, $id);

            //Act
            $result = $test_client->getId();

            //Assert
            $this->assertEquals(777, $result);
        }

        function test_setId()
        {
            //Arrange
            $name = "Francis";
            $stylist_id = 111;
            $id = 777;
            $test_client = new Client($name, $stylist_id, $id);

            //Act
            $test_client->setId(222);

            //Assert
            $result = $test_client->getId();
            $this->assertEquals(222, $result);
        }

        // function test_save()
        // {
        //     //Arrange
        //     $name = "Francis";
        //     $stylist_id = 111;
        //     $id = null;
        //     $test_client = new Client($name, $stylist_id, $id);
        //
        //     //Act
        //     $test_client->save();
        //
        //     //Assert
        //     $result = Client::getAll();
        //     $this->assertEquals($test_client, $result[0]);
        // }
    }
























?>
