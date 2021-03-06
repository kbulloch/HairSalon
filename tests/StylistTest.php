<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test');

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Diane";
            $id = null;
            $test_stylist = new Stylist($name, $id);

            //Act
            $result = $test_stylist->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_setName()
        {
            //Arrange
            $name = "Diane";
            $id = null;
            $test_stylist = new Stylist($name, $id);

            //Act
            $test_stylist->setName("Gurgen");

            //Assert
            $result = $test_stylist->getName();
            $this->assertEquals("Gurgen", $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Diane";
            $id = 111;
            $test_stylist = new Stylist($name, $id);

            //Act
            $result = $test_stylist->getId();

            //Assert
            $this->assertEquals(111, $result);
        }

        function test_setId()
        {
            //Arrange
            $name = "Diane";
            $id = null;
            $test_stylist = new Stylist($name, $id);

            //Act
            $test_stylist->setId(222);

            //Assert
            $result = $test_stylist->getId();
            $this->assertEquals(222, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Diane";
            $id = null;
            $test_stylist = new Stylist($name, $id);

            //Act
            $test_stylist->save();

            //Assert
            $result = Stylist::getAll();
            $this->assertEquals($test_stylist, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Diane";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $name2 = "Gurgen";
            $test_stylist2 = new Stylist($name2, $id);
            $test_stylist2->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Diane";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $name2 = "Gurgen";
            $test_stylist2 = new Stylist($name2, $id);
            $test_stylist2->save();

            //Act
            Stylist::deleteAll();
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Diane";
            $id = 111;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $name2 = "Gurgen";
            $id2 = 222;
            $test_stylist2 = new Stylist($name2, $id2);
            $test_stylist2->save();

            //Act
            $result = Stylist::find($test_stylist->getId());

            //Assert
            $this->assertEquals($test_stylist, $result);
        }

        function test_delete()
        {
            //Arrange
            $name = "Diane";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $name2 = "Gurgen";
            $test_stylist2 = new Stylist($name2, $id);
            $test_stylist2->save();

            //Act
            $test_stylist->delete();

            //Assert
            $this->assertEquals([$test_stylist2], Stylist::getAll());
        }

        function test_update()
        {
            //Arrange
            $name = "Diane";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $new_name = "Gurgen";

            //Act
            $test_stylist->update($new_name);

            //Assert
            $this->assertEquals($new_name, $test_stylist->getName());
        }

        function test_getClients()
        {
            //Arrange
            $name = "Diane";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $test_stylist_id = $test_stylist->getId();

            $name = "Tommen";
            $test_client = new Client($name, $test_stylist_id, $id);
            $test_client->save();

            $name2 = "Laurence";
            $test_client2 = new Client($name2, $test_stylist_id, $id);
            $test_client2->save();

            //Act
            $result = $test_stylist->getClients();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_deleteClients()
        {
            //Arrange
            $name = "Diane";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $test_stylist_id = $test_stylist->getId();

            $name = "Tommen";
            $test_client = new Client($name, $test_stylist_id, $id);
            $test_client->save();

            $name2 = "Laurence";
            $test_client2 = new Client($name2, $test_stylist_id, $id);
            $test_client2->save();

            //Act
            $test_stylist->deleteClients();
            $result = $test_stylist->getClients();

            //Assert
            $this->assertEquals([], $result);
        }
    }
?>
