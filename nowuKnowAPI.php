<?php
header("Content-Type: application/json");
include("connect.php");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        handleGet($pdo);
        break;
    case 'POST':
        handlePost($pdo, $input);
        break;
    case 'PUT':
        handlePut($pdo, $input);
        break;
    case 'DELETE':
        handleDelete($pdo, $input);
        break;
    default:
        echo json_encode(['message' => 'Invalid request method']);
        break;
}

function handleGet($pdo)
{
    $sql = "SELECT * FROM users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}

function handlePost($pdo, $input)
{
    $sql = "INSERT INTO users (firstName, lastName, userName, email, password, birthday, profilePicture, coverPhoto, userType, phoneNumber) VALUES (:firstName, :lastName, :userName, :email, :password, :birthday, :profilePicture, :coverPhoto, :userType, :phoneNumber)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'firstName' => $input['firstName'],
        'lastName' => $input['lastName'],
        'userName' => $input['userName'],
        'email' => $input['email'],
        'password' => $input['password'],
        'birthday' => $input['birthday'],
        'profilePicture' => $input['profilePicture'],
        'coverPhoto' => $input['coverPhoto'],
        'userType' => $input['userType'],
        'phoneNumber' => $input['phoneNumber'],
    ]);

    echo json_encode(['message' => 'User created successfully']);
}

function handlePut($pdo, $input)
{
    $sql = "UPDATE users SET
  firstName = :firstName,
    lastName = :lastName,
    userName = :userName,
    email = :email,
    password = :password,
    birthday = :birthday,
    profilePicture = :profilePicture,
    coverPhoto = :coverPhoto,
    userType = :userType,
    phoneNumber = :phoneNumber,  
    WHERE userID = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'firstName' => $input['firstName'],
        'lastName' => $input['lastName'],
        'userName' => $input['userName'],
        'email' => $input['email'],
        'password' => $input['password'],
        'birthday' => $input['birthday'],
        'profilePicture' => $input['profilePicture'],
        'coverPhoto' => $input['coverPhoto'],
        'userType' => $input['userType'],
        'phoneNumber' => $input['phoneNumber'],
        'id' => $input['id']
    ]);
    echo json_encode(['message' => 'User updated successfully']);
}

function handleDelete($pdo, $input)
{
    $sql = "DELETE FROM users WHERE userID = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $input['id']]);
    echo json_encode(['message' => 'User deleted successfully']);
}
?>