<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    $app = new Silex\Application();

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon');

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.twig');
    });

    $app->get("/stylists", function() use ($app) {
        return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/stylists", function() use ($app) {
        $stylist = new Stylist($_POST['stylist_name']);
        $stylist->save();
        return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
    });

    //to stylists.twig:
    //$app->delete("/stylists/{id}")
    //$app->post("/delete_stylists")

    //to stylist.twig
    //$app->get("/stylists/{id}")
    //$app->patch("/stylists/{id}")

    //to stylist_edit.twig
    //$app->get("/stylists/{id}/edit")

    return $app;

?>
