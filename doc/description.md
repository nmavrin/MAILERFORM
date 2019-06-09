https://snipp.ru/view/146 - вот здесь полная информация, но на всякий случай добавил тут если сайт ляжет

ОСНОВНЫЕ ШАГИ:
1. Создаем новый почтовый ящик на любом удобном почтовом сервере (YANDEX, GOOGLE и тп).
2. Проверяем не подключили ли мы или не установлена ли двухфакторная авторизация на почтовом ящике
3. Разрешаем ипользовать п/я "ненадежные приложения"


Яндекс Почта
$mail->Host = 'ssl://smtp.yandex.ru';
$mail->Port = 465;
$mail->Username = 'Логин@yandex.ru';
$mail->Password = 'Пароль';


Mail.ru
$mail->Host = 'ssl://smtp.mail.ru';
$mail->Port = 465;
$mail->Username = 'Логин@mail.ru';
$mail->Password = 'Пароль';


Gmail
$mail->Host = 'ssl://smtp.gmail.com';
$mail->Port = 465;
$mail->Username = 'Логин@gmail.com';
$mail->Password = 'Пароль';

ВАЖНО! 
Если возникает ошибка при отправки почты, то нужно отключить двухфакторную авторизацию 
и разблокировать «ненадежные приложения» в настройках конфиденциальности аккаунта 
https://myaccount.google.com/security?pli=1


Рамблер
$mail->Host = 'ssl://smtp.rambler.ru';
$mail->Port = 465;
$mail->Username = 'Логин@rambler.ru';
$mail->Password = 'Пароль';


iCloud
$mail->Host = 'ssl://smtp.mail.me.com';
$mail->Port = 587;
$mail->Username = 'Логин@icloud.com';
$mail->Password = 'Пароль';
6
Мастерхост
$mail->Host = 'ssl://smtp.masterhost.ru';
$mail->Port = 465;
$mail->Username = 'Логин@домен.ru';
$mail->Password = 'Пароль';
7
Timeweb
Лимит – 2000 писем в день, но не более 5 в секунду.

$mail->Host = 'ssl://smtp.timeweb.ru';
$mail->Port = 465;
$mail->Username = 'Логин@домен.ru';
$mail->Password = 'Пароль';
8
Хостинг Центр (hc.ru)
Доступ к сторонним почтовым серверам по SMTP-портам (25, 465, 587) ограничен, разрешена отправка не более 300 сообщений в сутки.

$mail->Host = 'smtp.домен.ru';
$mail->SMTPSecure = 'TLS';
$mail->Port = 25;
$mail->Username = 'Логин@домен.ru';
$mail->Password = 'Пароль';
9
REG.RU
Лимит – 3000 писем в день.

$mail->Host = 'ssl://serverXXX.hosting.reg.ru';
$mail->Port = 465;
$mail->Username = 'Логин@домен.ru';
$mail->Password = 'Пароль';
Имя сервера можно узнать в разделе «Информация о включенных сервисах и паролях доступа»:

	
10
ДЖИНО
В разделе «Услуги» нужно включить опцию «SMTP-сервер»:



$mail->Host = 'ssl://smtp.jino.ru';
$mail->Port = 465;
$mail->Username = 'Логин@домен.ru';
$mail->Password = 'Пароль';
11
nic.ru
В настройках веб-сервера необходимо включить PHP расширение «openssl».

$mail->Host = 'ssl://mail.nic.ru';
$mail->Port = 465;
$mail->Username = 'Логин@домен.ru';
$mail->Password = 'Пароль';
12
beget.com
$mail->Host = 'ssl://smtp.beget.com';
$mail->Port = 465;
$mail->Username = 'Логин@домен.ru';
$mail->Password = 'Пароль';
