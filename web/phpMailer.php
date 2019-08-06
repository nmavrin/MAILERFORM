<?php

/**
 * Created by PhpStorm.
 * User: Nickolay Mavrin
 * Email: mavrinnick@gmail.com
 * Date: 2019-06-10
 * Time: 00:16
 */

require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Защита от спама скрытое поле - в форму добавить input
//<input id="check" name="check" type="hidden" value="" />
//
securityForm();


sendForm();


function sendForm()
{
    // new PHP mailer
    $mail = new PHPMailer();

    try {

        $body = [];
        $bodyArray = [];

        if (isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] == @$_POST['csrf_token']) { // Если нужна защита CSRF
            //обрабатываем полученные переменные.
            if ($_SERVER['REQUEST_METHOD'] == 'POST') //если это пост запрос
            {
                $error = "";
                foreach ($_POST as $key => $value) {
                    $value = trim($value);
                    $value = htmlspecialchars($value, ENT_QUOTES);
                    $_POST[$key] = $value;
                    $value = str_replace("\r", "", $value);
                    $value = str_replace("\n", "<br>", $value);
                    $body .= !empty($value) ?  '<div>'.$key.' : '.$value.'</div><br>' : $body;
                    $bodyArray[$key] = $value;

                }
            }


            echo ' <div class="c-form-success"><div class="c-form-success__icon"><i class="c-icon c-icon-success"></i></div><div class="c-form-success__title">'.'Ваше сообщение успешно отправлено'.'</div></div>';
        } else {
            return;
        }


        $msg = "ok";
        $mail->isSMTP();
        $mail->CharSet = "UTF-8";
        $mail->SMTPAuth = true;

        //Настраиваем почту для отправки через SMTP на хостинге - читаем description.md
        $mail->Host = 'smtp.gmail.com'; // SMTP сервера
        $mail->Username = 'admin@gmail.com'; // Логин на почте
        $mail->Password = 'password'; // Пароль на почте
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('no-reply@domain.com', 'no-reply'); // Адрес самой почты

        // Получатель письма - кто будет получать письма
        $mail->addAddress('mavrinnick@gmail.com');
        // если нужно добавить еще добавляем addAddress $mail->addAddress('newMan@yandex.ru');

        // Прикрипление файлов к письму
        if (!empty($_FILES['myfile']['name'][0])) {
            for ($ct = 0; $ct < count($_FILES['myfile']['tmp_name']); $ct++) {
                $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['myfile']['name'][$ct]));
                $filename = $_FILES['myfile']['name'][$ct];
                if (move_uploaded_file($_FILES['myfile']['tmp_name'][$ct], $uploadfile)) {
                    $mail->addAttachment($uploadfile, $filename);
                } else {
                    $body .= 'Неудалось прикрепить файл '.$uploadfile;
                }
            }
        }

        // -----------------------
        // Само письмо
        // -----------------------
        $mail->isHTML(true);

        $mail->Subject = 'Заявка с сайта';
        $mail->Body = $body;

        if (isset($bodyArray['lang']) )
        {
            if ($mail->send())
            {
                switch ($bodyArray['lang'])
                {
                    case 'ru':
                        echo "<div class=\"c-form-success\"><div class=\"c-form-success__icon\"><i class=\"c-icon c-icon-success\"></i></div><div class=\"c-form-success__title\">' . 'Ваше сообщение успешно отправлено' . '</div></div>";
                        break;
                    case 'en':
                        echo "<div class=\"c-form-success\"><div class=\"c-form-success__icon\"><i class=\"c-icon c-icon-success\"></i></div><div class=\"c-form-success__title\">' . 'Ваше сообщение успешно отправлено' . '</div></div>";
                        break;
                    case 'ar':
                        echo "<div class=\"c-form-success\"><div class=\"c-form-success__icon\"><i class=\"c-icon c-icon-success\"></i></div><div class=\"c-form-success__title\">' . 'Ваше сообщение успешно отправлено' . '</div></div>";
                        break;
                    default:
                        echo "<div class=\"c-form-success\"><div class=\"c-form-success__icon\"><i class=\"c-icon c-icon-success\"></i></div><div class=\"c-form-success__title\">' . 'Ваше сообщение успешно отправлено' . '</div></div>";
                        break;
                }
            }

        }

        // Проверяем отравленность сообщения
        if ($mail->send()) {
            echo "<div class=\"c-form-success\"><div class=\"c-form-success__icon\"><i class=\"c-icon c-icon-success\"></i></div><div class=\"c-form-success__title\">' . 'Ваше сообщение успешно отправлено' . '</div></div>";
        } else {
            echo "Сообщение не было отправлено. Неверно указаны настройки вашей почты";
        }

    } catch (Exception $e) {
        echo "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
    }





}


//function validateForm($data)
//{
//    //   валидация
//
//    $error = '';
//    // валидация полей на пустоту - можно добавлять любое количество полей
//    if (isset($data['name']) and $data['name'] != '') {
//        $error .= "Поле имя не должно быть пустым";
//    }
//
//
//    // проверка email на валидность
//    if (isset($data['email']) && preg_match('[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$', $data['email'])) {
//        $error .= "Укажите email в формате test@gmail.com.<br>";
//    };
//    // проверка телефона на валидность, добавлена валидация имени, если нужен другой то можно раскомментрировать
//    $patern = '7\([0-9]{3}\)[0-9]{3}-[0-9]{2}-[0-9]{2}'; // патерн для 7(___)___-__-__
////    $patern = '^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$'; // патерн для +8(___)___-__-__
//    if (
//        (isset($data['phone']) || isset($data['telephone']) || isset($data['phone_number']) || isset($data['telefon']) || isset($data['Телефон']))
//        && (
//            preg_match($patern, $data['phone']) ||
//            preg_match($patern, $data['telephone']) ||
//            preg_match($patern, $data['phone_number']) ||
//            preg_match($patern, $data['telefon']) ||
//            preg_match($patern, $data['телефон'])
//        )) {
//        $error .= "укажите номер телефона в корректном формате 7(___)___-__-__";
//    };
//
//    return $error;
//}

//безопасность формы
function securityForm()
{
    // Защита от XSS - в обработчике  используется функция htmlspecialchars

    if (isset($_POST['check']) and !empty($_POST['check'])) {
        exit('Защита от спама');
    }


    // Защита от CSRF - если нужен (добавить в форму), если не  используются пользовательские данные
    // в форме создать input: <input name="csrf_token" type="hidden" value="'.generate_form_token(  ).'" />
}

function generate_form_token()
{
    return $_SESSION['csrf_token'] = substr(str_shuffle('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM'), 0, 10);
}






