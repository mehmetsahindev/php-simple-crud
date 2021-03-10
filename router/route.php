<?php
require_once('./vendor/autoload.php');
require_once('./config/db.php');
require_once('./model/User.php');

use Jenssegers\Blade\Blade;
use Bramus\Router\Router;

// Create Router instance
$router = new Router();

$router->get('/', function () {
    try {
        $database = new Db();
        $conn = $database->getConnection();
        $query = $conn->prepare('select * from users');
        $query->execute();

        $users = $query->fetchAll(PDO::FETCH_ASSOC);
        $blade = new Blade('view', 'cache');
        echo $blade->render('homepage', ['data' => $users]);
        exit;
    } catch (PDOException $e) {
        echo "Server Error";
        exit;
    }
});

$router->get('/add-user', function () {
    $blade = new Blade('view', 'cache');
    echo $blade->render('form', ['title' => 'Add Employee']);
    exit;
});

$router->post('/add-user', function () {
    $blade = new Blade('view', 'cache');
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    try {
        $newUser = new User(null, $name, $email, $phone);

        $userName = $newUser->getName();
        $userEmail = $newUser->getEmail();
        $userPhone = $newUser->getPhone();

        $database = new Db();
        $conn = $database->getConnection();
        $query = $conn->prepare('insert into users (name, email, phone) values (:name, :email, :phone)');
        $query->bindParam(":name", $userName, PDO::PARAM_STR);
        $query->bindParam(":email", $userEmail, PDO::PARAM_STR);
        $query->bindParam(":phone", $userPhone, PDO::PARAM_STR);
        $query->execute();

        $rowCount = $query->rowCount();

        if ($rowCount === 0) {
            echo $blade->render('form', ['error' => 'Failed to add user.', 'formData' => $_POST, 'title' => 'Add Employee']);
            exit;
        }

        header("Location: /");
        exit;
    } catch (PDOException $e) {
        echo "Server Error";
        exit;
    } catch (UserException $e) {
        echo $blade->render('form', ['error' => $e->getMessage(), 'formData' => $_POST, 'title' => 'Add Employee']);
        exit;
    }
});

$router->get('/user/{userId}/delete', function ($userId) {
    $blade = new Blade('view', 'cache');
    try {
        $database = new Db();
        $conn = $database->getConnection();
        $query = $conn->prepare('delete from users where id = :userId');
        $query->bindParam(":userId", $userId, PDO::PARAM_INT);
        $query->execute();

        $rowCount = $query->rowCount();

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
        $database = new Db();
        $conn = $database->getConnection();
        $query = $conn->prepare('select * from users where id = :userId');
        $query->bindParam(":userId", $userId, PDO::PARAM_INT);
        $query->execute();

        $rowCount = $query->rowCount();

        if ($rowCount === 0) {
            header('Location: /');
            exit;
        }

        $user = $query->fetch(PDO::FETCH_ASSOC);

        $blade = new Blade('view', 'cache');
        echo $blade->render('form', ['formData' => $user, 'title' => 'Set Employee Details']);
        exit;
    } catch (PDOException $e) {
        echo "Server Error";
        exit;
    } catch (UserException $e) {
        echo $blade->render('form', ['error' => $e->getMessage(), 'formData' => $_POST]);
        exit;
    }
});

$router->post('/user/{userId}', function ($userId) {
    $blade = new Blade('view', 'cache');
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    try {
        $newUser = new User(null, $name, $email, $phone);

        $userName = $newUser->getName();
        $userEmail = $newUser->getEmail();
        $userPhone = $newUser->getPhone();

        $database = new Db();
        $conn = $database->getConnection();
        $query = $conn->prepare('update users set name = :name, email = :email, phone = :phone where id = :userId');
        $query->bindParam(":name", $userName, PDO::PARAM_STR);
        $query->bindParam(":email", $userEmail, PDO::PARAM_STR);
        $query->bindParam(":phone", $userPhone, PDO::PARAM_STR);
        $query->bindParam(":userId", $userId, PDO::PARAM_INT);
        $query->execute();

        $rowCount = $query->rowCount();

        if ($rowCount === 0) {
            echo $blade->render('form', ['error' => 'Failed to update employee.', 'formData' => $_POST, 'title' => 'Set Employee Details']);
            exit;
        }

        header("Location: /");
        exit;
    } catch (PDOException $e) {
        echo "Server Error";
        exit;
    } catch (UserException $e) {
        echo $blade->render('form', ['error' => $e->getMessage(), 'formData' => $_POST, 'title' => 'Set Employee Details']);
        exit;
    }
});

$router->run();
