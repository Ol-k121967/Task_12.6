<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задание 12.6</title>
</head>
<body>
    <header class="header">

    </header>
    <main class="main">
    <?php

$example_persons_array = [
    [
        'fullname' => 'Иванов Иван Иванович',
        'job' => 'tester',
    ],
    [
        'fullname' => 'Степанова Наталья Степановна',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Пащенко Владимир Александрович',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Громов Александр Иванович',
        'job' => 'fullstack-developer',
    ],
    [
        'fullname' => 'Славин Семён Сергеевич',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Цой Владимир Антонович',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Быстрая Юлия Сергеевна',
        'job' => 'PR-manager',
    ],
    [
        'fullname' => 'Шматко Антонина Сергеевна',
        'job' => 'HR-manager',
    ],
    [
        'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Бардо Жаклин Фёдоровна',
        'job' => 'android-developer',
    ],
    [
        'fullname' => 'Шварцнегер Арнольд Густавович',
        'job' => 'babysitter',
    ],
];

//getFullnameFromParts
// принимает как аргумент три строки — фамилию, имя и отчество. Возвращает как результат их же, но склеенные через пробел.
// Пример: как аргументы принимаются три строки «Иванов», «Иван» и «Иванович», а возвращается одна строка — «Иванов Иван Иванович».
function getFullnameFromParts($surname, $name, $patronomyc){
	$fullname = "";
	$fullname .= $surname;
	$fullname .= " ";
	$fullname .= $name;
	$fullname .= " ";
	$fullname .= $patronomyc;
	return $fullname;
};




?>
    </main>
    <footer class="footer">

    </footer>
</body>

<script src="./JS/init.js"></script>
</html>