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
    }
?>
