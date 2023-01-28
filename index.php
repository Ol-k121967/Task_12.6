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

//getPartsFromFullname
// принимает как аргумент одну строку — склеенное ФИО. Возвращает как результат массив из трёх элементов с ключами ‘name’, ‘surname’ и ‘patronomyc’.
// Пример: как аргумент принимается строка «Иванов Иван Иванович», а возвращается массив [‘surname’ => ‘Иванов’ ,‘name’ => ‘Иван’, ‘patronomyc’ => ‘Иванович’].
function getPartsFromFullname($fullname) {
	$personName = explode(' ', $fullname);
	$FIO = [
		'surname' => $personName[0],
		'name' => $personName[1], 
		'patronomyc' => $personName[2],
	];
	return $FIO;
};

//getShortName
//принимающую как аргумент строку, содержащую ФИО вида «Иванов Иван Иванович» и возвращающую строку вида «Иван И.», 
//где сокращается фамилия и отбрасывается отчество. Для разбиения строки на составляющие используйте функцию getPartsFromFullname.

function getShortName($fullname){
	$shortname = "";
	$shortname .= getPartsFromFullname($fullname)['name'];
	$shortname .= " ";
	$shortname .= mb_substr(getPartsFromFullname($fullname)['surname'], 0, 1);
	$shortname .= ".";
	return $shortname;
};

//getGenderFromName
//Будем производить определение следующим образом:
//внутри функции делим ФИО на составляющие с помощью функции getPartsFromFullname;
//изначально «суммарный признак пола» считаем равным 0;
//если присутствует признак мужского пола — прибавляем единицу;
//если присутствует признак женского пола — отнимаем единицу.
//после проверок всех признаков, если «суммарный признак пола» больше нуля — возвращаем 1 (мужской пол);
//после проверок всех признаков, если «суммарный признак пола» меньше нуля — возвращаем -1 (женский пол);
//после проверок всех признаков, если «суммарный признак пола» равен 0 — возвращаем 0 (неопределенный пол).
//Признаки женского пола: отчество заканчивается на «вна»; имя заканчивается на «а»; фамилия заканчивается на «ва»;
//Признаки мужского пола: отчество заканчивается на «ич»; имя заканчивается на «й» или «н»; фамилия заканчивается на «в».
function getGenderFromName($person){
	$gender = 0;
	$fullname = getPartsFromFullname($person);
	$searchName = mb_substr($fullname['name'], mb_strlen($fullname['name']) - 1);
	$searchSurnameFemale = mb_substr($fullname['surname'], mb_strlen($fullname['surname']) - 2);
	$searchSurnameMale = mb_substr($fullname['surname'], mb_strlen($fullname['surname']) - 1);
	$searchPatronomycFemale = mb_substr($fullname['patronomyc'], mb_strlen($fullname['patronomyc']) - 3);
	$searchPatronomycMale = mb_substr($fullname['patronomyc'], mb_strlen($fullname['patronomyc']) - 2);
	if (($searchName == 'й' || $searchName == 'н') || ($searchSurnameMale == 'в') || ($searchPatronomycMale == 'ич')) {
		$gender++;
	}elseif (($searchName == 'а') || ($searchSurnameFemale == 'ва') || ($searchPatronomycFemale == 'вна')) {
		$gender--;
	}
	if($gender > 0){
		$printGender = "мужской пол";
	}elseif ($gender < 0) {
		$printGender = "женский пол";
	}else {
		$printGender = "неопределенный пол";
	}
	return $printGender;
};



?>
    </main>
    <footer class="footer">

    </footer>
</body>

<script src="./JS/init.js"></script>
</html>
