<?php
session_start();

include "database.php";

$result = mysqli_query($link, "SELECT * FROM `comments`");

if (isset($_POST['username']) && isset($_POST['comment']) &&isset($_POST['captcha'])) {
    if ($_POST['captcha'] == $_SESSION['captcha']) {
        $sql = "INSERT INTO `comments` (`username`, `comment`) VALUES ('{$_POST['username']}', '{$_POST['comment']}')";
        if (mysqli_query($link, $sql)) {
            header("Location: index.php");
        } else {
            echo "Error: ".mysqli_error($link);
        }
    } else {
        $_SESSION['error'] = 'Wrong code!';
    }
}

function message()
{ //Функция вывода сообщений о результате запроса
    if (isset($_SESSION['error'])) {
        echo '<p style="color:red;">' . $_SESSION['error'] . '</p>';
        unset($_SESSION['error']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    </link>
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Comments section</title>
</head>

<body>
    <div class="container">
        <header class="d-flex justify-content-center py-3">
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link">About</a></li>
            </ul>
        </header>
    </div>
    <section>
        <!-- <template> -->
        <div id="app">
            <div id="image-section">
                <img src="https://hips.hearstapps.com/hmg-prod/images/female-person-holding-christmas-gift-royalty-free-image-1568149103.jpg?crop=1xw:0.99882xh;center,top&resize=980:*"
                    alt="image">
            </div>
            <div id="comment-adding-section">
                <form action="index.php" method="POST">
                    <input id="username" alt="username" name="username" type="text"
                        placeholder="Write your username...">
                    <br>
                    <textarea id="comment" name="comment" placeholder="Write your comment..."></textarea>
                    <div class="captcha">
                        <!-- <input id="confirm" type="checkbox" name="captcha">I'm not a robot!</button> -->
                        <img src="captcha.php" alt="captcha">
                        <br>
                        <br>
                        <input type="text" name="captcha" placeholder="Write code..." />
                        <div class="message-screen">
                            <?php message() ?>
                        </div>
                    </div>
                    <button name="addButton" id="add" type="submit">Send comment</button>
                </form>
            </div>

            <div class="comments-section">

                <div class="comments-head">
                    <p>Comments:</p>
                </div>
                <div id="comments">
                    <ul>
                        <?php
                        while ($comment = mysqli_fetch_assoc($result)) {
                            echo
                                '<li>
                                <p style="font-size: 13px; font-weight: bold;">
                                    ' . $comment["username"] . '
                                </p>
                                <p>
                                    ' . $comment["comment"] . '
                                </p>
                                <form action="delete.php" method="POST">
                                    <input type="hidden" name="del" value="' . $comment["id"] . '" />
                                    <button class="delete" type="submit"><img src="./assets/delete.png"></button>
                                </form>
                            </li>
                            <br>
                            ';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- </template> -->
    </section>

    <footer>

    </footer>
</body>

<!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.7.8/dist/vue.js"></script> -->

</html>