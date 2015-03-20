<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";



    $app = new Silex\Application();

    $app['debug']=true;

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon');

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    //Home page route
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.twig');
    });

    //List of stylists, takes input for new stylist
    $app->get("/stylists", function() use ($app) {
        return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
    });

    //List of stylists, creates a new stylist
    $app->post("/stylists", function() use ($app) {
        $stylist = new Stylist($_POST['stylist_name']);
        $stylist->save();
        return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
    });

    //to stylists.twig:
    $app->delete("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
    });

    //List of stylists, deletes all stylists
    $app->post("/delete_stylists", function() use ($app) {
        Stylist::deleteAll();
        Client::deleteAll();
        return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
    });

    //to stylist.twig
    $app->get("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist.twig', array('stylist' => $stylist));
    });


    $app->patch("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $new_name = $_POST['new_name'];
        $stylist->update($new_name);
        return $app['twig']->render('stylist.twig', array('stylist' => $stylist));
    });

    //to stylist_edit.twig
    $app->get("/stylists/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist_edit.twig', array('stylist' => $stylist));
    });

    return $app;

?>
