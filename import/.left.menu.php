<?
$aMenuLinks = Array(
	Array(
		"Личный кабинет", 
		"/auth/auth.php", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Портал электронного обучения", 
		"/servisy/portal-elektronnogo-obucheniya.php", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Электронная приемная", 
		"/servisy/elektronnaya-priemnaya.php", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Зачетная книжка", 
		"/auth/zachetnaya-knijka.php", 
		Array(), 
		Array(), 
		"!CSite::InGroup(array(1))" 
	),
	Array(
		"Загрузка ведомости", 
		"/import/", 
		Array(), 
		Array(), 
		"CSite::InGroup(array(1))" 
	)
);
?>