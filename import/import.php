<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
global  $USER;
	ini_set('max_execution_time', '6000');
	ini_set('max_input_time', '3000');
	ini_set("default_socket_timeout", '3000');
	ini_set('memory_limit', '-1');

use PhpOffice\PhpSpreadsheet\IOFactory;

CModule::IncludeModule("iblock");

if(!$_FILES['file']){
		die(json_encode([
			'success' => false,
			'error' => 'ОШИБКА: Файл не был выбран!',
		]));
	}

//собираем массив из файла
	$file = $_FILES['file']['tmp_name'];
	
	$spreadsheet = IOFactory::load($file);
	$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

	$i = 10;
	foreach ($sheetData as $k => $row) {
		if ($k == 6) {
			foreach ($sheetData[6] as $c => $cell) {
				if ($c == 'D') {
					$str = explode(PHP_EOL, $cell);
					$gruppaText = $str[0];
					$semestrText = $str[1];
					preg_match('/"([^"]+)"/', $gruppaText, $g);
					$gruppa = $g[1];
					preg_match('/"([^"]+)"/', $semestrText, $s);
					$semestr = $s[1];
					var_dump($gruppa, $semestr);
				}
			}
		}
		if ($k == 8) {
			foreach ($sheetData[8] as $c => $cell) {
				if ($c >= "E" && $cell != null && $cell != "#NULL!") {
					$predmets[$c] = $cell;
				}
			}
		}
		if ($k == 9) {
			foreach ($sheetData[9] as $c => $cell) {
				if ($c >= "E" && $cell != null && $cell != "#NULL!") {
					$type[$c] = $cell;
				}
			}
		}
		if ($k >= 10) {
			foreach ($sheetData[$i] as $c => $cell) {
				if ($c >= "E" && in_array($c, array_keys($predmets))) {
					$ocenki[$i][$c]['subject'] = $predmets[$c];
					$ocenki[$i][$c]['type'] = $type[$c];
					$ocenki[$i][$c]['estimation'] = $cell ?: '';
				}
			}
			$students[$i] = [
				'NAME' => $sheetData[$i]['B'],
				'OCENKI' => $ocenki[$i]
			];
			$i++;
		}
	}

	CModule::IncludeModule('iblock');
	$arFilter = ['IBLOCK_ID' => 11, 'NAME' => $gruppa]; 
	$rsSect = CIBlockSection::GetList(['ID' => 'asc'], $arFilter);
	if ($arSect = $rsSect->GetNext()) {
		$id_section_gruppy = $arSect['ID'];
	}
	else {
		$bs = new CIBlockSection;
		$arFields = [
			"ACTIVE" => 'Y',
			"IBLOCK_ID" => 11,
			"NAME" => $gruppa,
			"SORT" => 500,
		];
		$id_section_gruppy = $bs->Add($arFields);
		$res = ($id_section_gruppy > 0);
		if (!$res) {
			echo $bs->LAST_ERROR;
		} 
	}

	$studentsName = array_column($students, 'NAME');
	$sectionsStudents = [];
	$arFilter = ['IBLOCK_ID' => 11, 'NAME' => $studentsName];
	$rsSect = CIBlockSection::GetList(['ID' => 'asc'], $arFilter);
	while ($arSect = $rsSect->GetNext()) {
		$sectionsStudents[$arSect['ID']] = $arSect['NAME'];
	}
	foreach ($students as $student) {
		if (!in_array($student['NAME'], $sectionsStudents)) {
			$bs = new CIBlockSection;
			$arFields = [
				"ACTIVE" => 'Y',
				"IBLOCK_SECTION_ID" => $id_section_gruppy,
				"IBLOCK_ID" => 11,
				"NAME" => $student['NAME'],
				"SORT" => 500,
			];
			$ID = $bs->Add($arFields);
			$res = ($ID > 0);

			if (!$res) {
				echo $bs->LAST_ERROR;
			} else {
				$el = new CIBlockElement;
				$PROP = [];
				foreach ($student['OCENKI'] as $ocenka) {
					$PROP[57][] = [
						'VALUE' => [
							'subject' => $ocenka['subject'],
							'type' => $ocenka['type'],
							'estimation' => $ocenka['estimation']
						]
					];
				}

				$arLoadSemestrArray = [
					"MODIFIED_BY" => $USER->GetID(), // элемент изменен текущим пользователем
					"IBLOCK_SECTION_ID" => $ID,          // элемент лежит в корне раздела
					"IBLOCK_ID" => 11,
					"PROPERTY_VALUES" => $PROP,
					"NAME" => $semestr,
					"ACTIVE" => "Y",            // активен
				];
				if ($SEMESTR_ID = $el->Add($arLoadSemestrArray)) {
					echo "New ID: " . $SEMESTR_ID;
				} else {
					echo "Error: " . $el->LAST_ERROR;
				}

			}
		}
	}
	if (!empty($sectionsStudents)) {
		$arSelect = ["ID", "NAME", "IBLOCK_SECTION_ID"];
		$arFilter = [
			"IBLOCK_ID" => 11,
			"ACTIVE_DATE" => "Y",
			"ACTIVE" => "Y",
			"NAME" => $semestr,
			'IBLOCK_SECTION_ID' => array_keys($sectionsStudents)
		];
		$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
		while ($ar_res = $res->GetNext()) {
			$arSemestrStudent[$ar_res['IBLOCK_SECTION_ID']] = $ar_res['ID'];
		}
	}
	foreach ($sectionsStudents as $sKey => $student) {
		foreach ($students as $st) {
			if ($student == $st['NAME']) {
				$updatedStudents[$sKey] = $st;
			}
		}
	}
	foreach ($updatedStudents as $s => $student) {
		$PROP[57] = [];
		foreach ($student['OCENKI'] as $ocenka) {
			$PROP[57][] = [
				'VALUE' => [
					'subject' => $ocenka['subject'],
					'type' => $ocenka['type'],
					'estimation' => $ocenka['estimation']
				]
			];
		}
		if ($arSemestrStudent[$s]) {
			//CIBlockElement::SetPropertyValuesEx($arSemestrStudent[$s], false, array('COMPLEX' => ""));
			CIBlockElement::SetPropertyValuesEx($arSemestrStudent[$s], false, ['COMPLEX' => $PROP[57]]);
		} else {
			$el = new CIBlockElement;
			$PROP = [];
			$arLoadSemestrArray = [
				"MODIFIED_BY" => $USER->GetID(),
				"IBLOCK_SECTION_ID" => $s,
				"IBLOCK_ID" => 11,
				"PROPERTY_VALUES" => $PROP,
				"NAME" => $semestr,
				"ACTIVE" => "Y",
			];
			if ($SEMESTR_ID = $el->Add($arLoadSemestrArray)) {
				echo "New ID: " . $SEMESTR_ID;
			} else {
				echo "Error: " . $el->LAST_ERROR;
			}
		}

	}
die(json_encode([
		'success' => true,
		'message' => 'Импорт завершен',
	]));