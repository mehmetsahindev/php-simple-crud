<?php
require_once('./vendor/autoload.php');
require_once('./config/db.php');
require_once('./model/User.php');
require_once('./model/Response.php');

use Jenssegers\Blade\Blade;
use Bramus\Router\Router;

// Create Router instance
$router = new Router();

$router->get('/', function () {
    try {
        // Get all users
        $database = new Db();
        $conn = $database->getConnection();
        $query = $conn->prepare('select * from users');
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_ASSOC);

        // Set response model
        $response = new Response('Employee Details', null, null, $users, null);

        // Get parameters from url to set error and success
        if (isset($_GET['add'])) {
            if ($_GET['add'] === 'ok') $response->setSuccess('Employee added.');
            if ($_GET['add'] === 'no') $response->setError('Employee could not be added.');
        }
        if (isset($_GET['delete'])) {
            if ($_GET['delete'] === 'ok') $response->setSuccess('Employee deleted.');
            if ($_GET['delete'] === 'no') $response->setError('Employee could not be deleted.');
        }
        if (isset($_GET['update'])) {
            if ($_GET['update'] === 'ok') $response->setSuccess('Employee updated.');
            if ($_GET['update'] === 'no') $response->setError('Employee could not be updated.');
        }

        // Render view with response
        $blade = new Blade('view', 'cache');
        echo $blade->render('homepage', $response->returnAsArray());
        exit;
    } catch (PDOException $e) {
        echo "Server Error";
        exit;
    }
});

$router->get('/add-user', function () {
    // Set response model
    $response = new Response('Add Employee', null, null, null, null);

    // Render view
    $blade = new Blade('view', 'cache');
    echo $blade->render('form', $response->returnAsArray());
    exit;
});

$router->post('/add-user', function () {
    $blade = new Blade('view', 'cache');

    // Get post datas
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    try {
        // Set User model with post datas
        $newUser = new User(null, $name, $email, $phone);

        $userName = $newUser->getName();
        $userEmail = $newUser->getEmail();
        $userPhone = $newUser->getPhone();

        // Add user to database
        $database = new Db();
        $conn = $database->getConnection();
        $query = $conn->prepare('insert into users (name, email, phone) values (:name, :email, :phone)');
        $query->bindParam(":name", $userName, PDO::PARAM_STR);
        $query->bindParam(":email", $userEmail, PDO::PARAM_STR);
        $query->bindParam(":phone", $userPhone, PDO::PARAM_STR);
        $query->execute();

        $rowCount = $query->rowCount();

        // Check if user added to database
        if ($rowCount === 0) {
            $response = new Response('Add Employee', null, 'Failed to add user.', null, $_POST);
            echo $blade->render('form', $response->returnAsArray());
            exit;
        }

        // Redirect, if user added successfully
        header("Location: /?add=ok");
        exit;
    } catch (PDOException $e) {
        echo "Server Error";
        exit;
    } catch (UserException $e) {
        // Catch user model exceptions and response.
        $response = new Response('Add Employee', null, $e->getMessage(), null, $_POST);
        echo $blade->render('form', $response->returnAsArray());
        exit;
    }
});

$router->get('/user/{userId}/delete', function ($userId) {
    $blade = new Blade('view', 'cache');
    try {
        // Delete user if exist.
        $database = new Db();
        $conn = $database->getConnection();
        $query = $conn->prepare('delete from users where id = :userId');
        $query->bindParam(":userId", $userId, PDO::PARAM_INT);
        $query->execute();

        $rowCount = $query->rowCount();

        // Check user exists.
        if ($rowCount === 0) {
            header('Location: /?delete=no');
            exit;
        }

        header("Location: /?delete=ok");
        exit;
    } catch (PDOException $e) {
        echo "Server Error";
        exit;
    }
});

$router->get('/user/{userId}', function ($userId) {
    try {
        // Get user from database
        $database = new Db();
        $conn = $database->getConnection();
        $query = $conn->prepare('select * from users where id = :userId');
        $query->bindParam(":userId", $userId, PDO::PARAM_INT);
        $query->execute();

        $rowCount = $query->rowCount();

        // Check if user exist. Redirect homepage if not exist.
        if ($rowCount === 0) {
            header('Location: /');
            exit;
        }

        $user = $query->fetch(PDO::FETCH_ASSOC);

        $response = new Response('Set Employee Details', null, null, null, $user);

        $blade = new Blade('view', 'cache');
        echo $blade->render('form', $response->returnAsArray());
        exit;
    } catch (PDOException $e) {
        echo "Server Error";
        exit;
    }
});

$router->post('/user/{userId}', function ($userId) {
    $blade = new Blade('view', 'cache');

    // Get post datas
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    try {
        // Set user model with post datas
        $newUser = new User(null, $name, $email, $phone);

        $userName = $newUser->getName();
        $userEmail = $newUser->getEmail();
        $userPhone = $newUser->getPhone();

        // Update user
        $database = new Db();
        $conn = $database->getConnection();
        $query = $conn->prepare('update users set name = :name, email = :email, phone = :phone where id = :userId');
        $query->bindParam(":name", $userName, PDO::PARAM_STR);
        $query->bindParam(":email", $userEmail, PDO::PARAM_STR);
        $query->bindParam(":phone", $userPhone, PDO::PARAM_STR);
        $query->bindParam(":userId", $userId, PDO::PARAM_INT);
        $query->execute();

        $rowCount = $query->rowCount();

        // Check if user updated.
        if ($rowCount === 0) {
            $response = new Response('Set Employee Details', null, 'Failed to update employee.', null, $_POST);
            echo $blade->render('form', $response->returnAsArray());
            exit;
        }

        header("Location: /?update=ok");
        exit;
    } catch (PDOException $e) {
        echo "Server Error";
        exit;
    } catch (UserException $e) {
        $response = new Response('Set Employee Details', null, $e->getMessage(), null, $_POST);
        echo $blade->render('form', $response->returnAsArray());
        exit;
    }
});

$router->run();
