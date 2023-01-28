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

//getGenderDescription
//Как аргумент в функцию передается массив, схожий по структуре с массивом $example_persons_array. Как результат функции возвращается информация в следующем виде:
//Гендерный состав аудитории: Мужчины - 55.5% Женщины - 35.5% Не удалось определить - 10.0%
//Используйте для решения функцию фильтрации элементов массива, функцию подсчета элементов массива, функцию getGenderFromName, округление.
function getGenderDescription($arrayExample){
	for ($i=0; $i < count($arrayExample); $i++) { 
		$person = $arrayExample[$i]['fullname'];
		$gender[$i] = getGenderFromName($person);
		};
	$numbersMale = array_filter($gender, function($gender) {
   	return $gender == "мужской пол";
   });
	$numbersFemale = array_filter($gender, function($gender) {
   	return $gender == "женский пол";
   });
	$numbersOther = array_filter($gender, function($gender) {
   	return $gender == "неопределенный пол";
	});
	$resultMale = count($numbersMale)/count($arrayExample) * 100;
	$resultFemale = count($numbersFemale)/count($arrayExample) * 100;
	$resultOth = count($numbersOther)/count($arrayExample) * 100;

	echo 'Гендерный состав аудитории: <hr>' . 'Мужчины - ' . round($resultMale, 2). '%<br>' . 'Женщины - ' . round($resultFemale, 2) . '%<br>' . 'Не удалось определить - ' . round($resultOth, 2) . '%<br>';
};

//getPerfectPartner
//Как первые три аргумента в функцию передаются строки с фамилией, именем и отчеством (именно в этом порядке). При этом регистр может быть любым: ИВАНОВ ИВАН ИВАНОВИЧ, ИваНов Иван иванович.
//Как четвертый аргумент в функцию передается массив, схожий по структуре с массивом $example_persons_array.
//Алгоритм поиска идеальной пары:
//приводим фамилию, имя, отчество (переданных первыми тремя аргументами) к привычному регистру;
//склеиваем ФИО, используя функцию getFullnameFromParts;
//определяем пол для ФИО с помощью функции getGenderFromName;
//случайным образом выбираем любого человека в массиве;
//проверяем с помощью getGenderFromName, что выбранное из Массива ФИО - противоположного пола, если нет, то возвращаемся к шагу 4, если да - возвращаем информацию.
//Как результат функции возвращается информация в следующем виде:
// Иван И. + Наталья С. = 
//  ♡ Идеально на 64.43% ♡
// Процент совместимости «Идеально на ...» — случайное число от 50% до 100% с точностью два знака после запятой.

function getPerfectPartner($surname, $name, $patronomyc, $arrayExample){
	$surnamePerson = mb_convert_case($surname, MB_CASE_TITLE_SIMPLE);
	$namePerson = mb_convert_case($name, MB_CASE_TITLE_SIMPLE);
	$patronomycPerson = mb_convert_case($patronomyc, MB_CASE_TITLE_SIMPLE); 
	$fullname = getFullnameFromParts($surnamePerson, $namePerson, $patronomycPerson);
	$genderPerson = getGenderFromName($fullname);
	$numberRand = rand(0, count($arrayExample)-1);
	$personTwo = $arrayExample[$numberRand]['fullname'];
	$genderPersonTwo = getGenderFromName($personTwo);
	if (($genderPerson == $genderPersonTwo) || ($genderPersonTwo == "неопределенный пол")) {
				$genderCompare = false;
				while ($genderCompare == false) {
					if (($genderPerson != $genderPersonTwo) && ($genderPersonTwo != "неопределенный пол")) {
						$genderCompare = true;
						$randomNumber = rand(5000, 10000)/100;
						$text = getShortName($fullname) . ' + ' . getShortName($personTwo) . ' = <br>' . "♡ Идеально на {$randomNumber}% ♡";
					   echo $text;
		   		};
					$numberRand = rand(0, count($arrayExample)-1);
					$personTwo = $arrayExample[$numberRand]['fullname'];
					$genderPersonTwo = getGenderFromName($personTwo);
		   	};
		}else {
			$randomNumber = rand(5000, 10000)/100;
			$text = getShortName($fullname) . ' + ' . getShortName($personTwo) . ' = <br>' . "♡ Идеально на {$randomNumber}% ♡";
		   echo $text;
		};
};

//Проверка выполнения функционирования функций

echo "Разработайте две функции: getPartsFromFullname и getFullnameFromParts <br>";
echo "<br>Функция getFullnameFromParts<br>";
print_r(getFullnameFromParts("Чапаев", "Василий", "Иванович") . "<br>");
echo "<br>Функция getPartsFromFullname<br>";
print_r(getPartsFromFullname("Чапаев Василий Иванович"));
echo "<br><br>Функция getShortName<br>";
print_r(getShortName("Чапаев Василий Иванович") . "<br>");
echo "<br>Функция getGenderFromName <br>";
print_r(getGenderFromName("Чапаев Василий Иванович") . "<br>");
echo "<br>Функция getGenderDescription<br>";
getGenderDescription($example_persons_array);
echo "<br>Функция getPerfectPartner<br>";
getPerfectPartner("ЧАПАев", "ВасИЛИЙ", "иваНОВвич", $example_persons_array);


?>
    </main>
    <footer class="footer">

    </footer>
</body>

<script src="./JS/init.js"></script>
</html>
