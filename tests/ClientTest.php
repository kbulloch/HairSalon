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

        function test_save()
        {
            //Arrange
            $name = "Francis";
            $stylist_id = 111;
            $id = null;
            $test_client = new Client($name, $stylist_id, $id);

            //Act
            $test_client->save();

            //Assert
            $result = Client::getAll();
            $this->assertEquals($test_client, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Francis";
            $stylist_id = 111;
            $id = null;
            $test_client = new Client($name, $stylist_id, $id);
            $test_client->save();

            $name2 = "Billy";
            $test_client2 = new Client($name2, $stylist_id, $id);
            $test_client2->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Francis";
            $stylist_id = 111;
            $id = null;
            $test_client = new Client($name, $stylist_id, $id);
            $test_client->save();

            $name2 = "Billy";
            $test_client2 = new Client($name2, $stylist_id, $id);
            $test_client2->save();

            //Act
            Client::deleteAll();
            $result = Client::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Francis";
            $stylist_id = 111;
            $id = null;
            $test_client = new Client($name, $stylist_id, $id);
            $test_client->save();

            $name2 = "Billy";
            $test_client2 = new Client($name2, $stylist_id, $id);
            $test_client2->save();

            //Act
            $result = Client::find($test_client->getId());

            //Assert
            $this->assertEquals($test_client, $result);
        }

        function test_delete()
        {
            //Arrange
            $name = "Francis";
            $stylist_id = 111;
            $id = null;
            $test_client = new Client($name, $stylist_id, $id);
            $test_client->save();

            $name2 = "Billy";
            $test_client2 = new Client($name2, $stylist_id, $id);
            $test_client2->save();

            //Act
            $test_client->delete();

            //Assert
            $this->assertEquals([$test_client2], Client::getAll());
        }

        function test_update()
        {
            //Arrange
            $name = "Francis";
            $stylist_id = 111;
            $id = null;
            $test_client = new Client($name, $stylist_id, $id);
            $test_client->save();

            $new_name = "Wallace";

            //Act
            $test_client->update($new_name);

            //Assert
            $this->assertEquals($new_name, $test_client->getName());
        }
    }
?>
