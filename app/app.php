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

    //Home page route, takes input for a new stylist
    $app->get("/", function() use ($app) {
        $stylists = Stylist::getAll();
        return $app['twig']->render('stylists.twig', array('stylists' => $stylists));
    });

    //Shows list of stylists, takes input for new stylist
    $app->get("/stylists", function() use ($app) {
        return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
    });

    //Shows list of stylists, creates a new stylist
    $app->post("/stylists", function() use ($app) {
        $stylist = new Stylist($_POST['stylist_name']);
        $stylist->save();
        return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
    });

    //Shows list of stylists, deletes a single stylist
    $app->delete("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
    });

    //Shows list of stylists, deletes all stylists
    $app->post("/delete_stylists", function() use ($app) {
        Stylist::deleteAll();
        Client::deleteAll();
        return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
    });

    //Personal page for a single stylist
    $app->get("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $clients = $stylist->getClients();
        return $app['twig']->render('stylist.twig', array('stylist' => $stylist, 'clients' => $clients));
    });

    //Update a single stylist's name
    $app->patch("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $new_name = $_POST['new_name'];
        $stylist->update($new_name);
        $clients = $stylist->getClients();
        return $app['twig']->render('stylist.twig', array('stylist' => $stylist, 'clients' => $clients));
    });

    //Options to edit a single stylist
    $app->get("/stylists/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist_edit.twig', array('stylist' => $stylist));
    });

    //Shows single stylist page, add a new client
    $app->post("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist_id = $stylist->getId();
        $name = $_POST['name'];
        $client = new Client($name, $stylist_id);
        $client->save();
        $clients = $stylist->getClients();
        return $app['twig']->render('stylist.twig', array('stylist' => $stylist, 'clients' => $clients));
    });

    //Shows single stylist page, deletes all associated clients
    $app->delete("/stylists/{id}/delete_clients", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->deleteClients();
        $clients = $stylist->getClients();
        return $app['twig']->render('stylist.twig', array('stylist' => $stylist, 'clients' => $clients));
    });

    return $app;

?>
