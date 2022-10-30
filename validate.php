<?php
header('Content-Type: application/json');

$users = [
    [
        'email' => 'mail@greensight.ru',
        'id' => '1',
        'name' => 'Егор Волков'
    ],
    [
        'email' => 'greensight@mail.ru',
        'id' => '2',
        'name' => 'Владимир Лоскутов'
    ],
    [
        'email' => 'greensight@yandex.ru',
        'id' => '3',
        'name' => 'Павел Ситкин'
    ]
];

if(
    (isset($_POST['name']) and $_POST['name'] != '') and
    (isset($_POST['surname']) and $_POST['surname'] != '') and
    (isset($_POST['email']) and $_POST['email'] != '') and
    (isset($_POST['password']) and $_POST['password'] != '') and
    (isset($_POST['confirm']) and $_POST['confirm'] != '')
    ) {

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];

        if(strpos($email, '@') !== false) {
            
            if($password == $confirm) {

                $result = ['class' => 'alert-danger', 'message' => 'Пользователь с таким email не найден!'];

                foreach ($users as $user) {
                    
                    if($email == $user['email']) {

                        $result = ['class' => 'alert-success', 'message' => 'Вы успешно авторизованы!'];

                    }
                }

                if($result['class'] == 'alert-success') {
                    $log = date('Y-m-d H:i:s') . ' Пользователь с email - ' . $email . ' авторизован.';
                } else {
                    $log = date('Y-m-d H:i:s') . ' Пользователь с email - ' . $email . ' не существует.';
                }

                file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);

            } else {
                $result = ['class' => 'alert-danger', 'message' => 'Пароли не совпадают.'];
            }

        } else {
            $result = ['class' => 'alert-danger', 'message' => 'Почта введена не правильно.'];
        }

} else {
    $result = ['class' => 'alert-danger', 'message' => 'Не все поля заполнены.'];
}



echo json_encode($result);
