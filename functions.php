<?php
function numberFormatter($digit)
{
	if ($digit >= 1000000000) {
		return round($digit / 1000000000, 1) . 'B';
	}
	if ($digit >= 1000000) {
		return round($digit / 1000000, 1) . 'M';
	}
	if ($digit >= 1000) {
		return round($digit / 1000, 1) . 'K';
	}
	return $digit;
}

function getWhereQuery()
{
	$channelName = empty($_POST['channelName']) ? "" : $_POST['channelName'];
	$categoryQuery = "True";
	$categorySize = sizeof($_POST['category']) - 1;
	if ($categorySize > 0) {
		$categoryQuery = "(";
		// 1st element in '$_POST['category']' is empty so we dont need it
		while ($categorySize > 0) {
			$category = $_POST['category'][$categorySize--];
			$category = str_replace("and", " & ", $category);
			$categoryQuery .= "category='$category'";
			if ($categorySize > 0)
				$categoryQuery .= " or ";
		}
		$categoryQuery .= ")";
	}

	$languageQuery = "True";
	$languageSize = sizeof($_POST['language']) - 1;
	if ($languageSize > 0) {
		$languageQuery = "(";
		// 1st element in '$_POST['language']' is empty so we dont need it
		while ($languageSize > 0) {
			$language = $_POST['language'][$languageSize--];
			$languageQuery .= "language='$language'";
			if ($languageSize > 0)
				$languageQuery .= " or ";
		}
		$languageQuery .= ")";
	}

	$subMinQuery = empty($_POST['subMin']) ? "True" : "subscriber > " . $_POST['subMin'];
	$subMaxQuery = empty($_POST['subMax']) ? "True" : "subscriber < " . $_POST['subMax'];

	$videoCountMinQuery = empty($_POST['videoCountMin']) ? "True" : "videoCount > " . $_POST['videoCountMin'];
	$videoCountMaxQuery = empty($_POST['videoCountMax']) ? "True" : "videoCount < " . $_POST['videoCountMax'];

	// return "SELECT * FROM channel WHERE $categoryQuery and $languageQuery and $subMinQuery and $subMaxQuery ORDER BY subscriber DESC LIMIT 20";
	return " $categoryQuery and $languageQuery and $subMinQuery and $subMaxQuery and $videoCountMinQuery and $videoCountMaxQuery and name LIKE '$channelName%'";
}

function getChannelCountQuery($whereQuery)
{
	return "SELECT count(id) FROM channel WHERE $whereQuery";
}

function getCurrentPage($totalPage)
{
	// store current page
	$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

	// control for changes from search bar
	if (!is_numeric($currentPage) || $currentPage > $totalPage)
		$currentPage = 1;

	return $currentPage;
}

function channelCategoryTR($categoryENG)
{
	switch ($categoryENG) {
		case "Gaming":
			return "Oyun";
		case "Autos & Vehicles":
			return "Araçlar";
		case "Entertainment":
			return "Eğlence";
		case "Comedy":
			return "Komedi";
		case "Science & Technology":
			return "Bilim ve Teknoloji";
		case "Howto & Style":
			return "Nasıl yapılır ve Stil";
		case "Sports":
			return "Spor";
		case "News & Politics":
			return "Haber & Gündem";
		case "Education":
			return "Eğitim";
		case "People & Blogs":
			return "İnsanlar";
		case "Music":
			return "Muzik";
		case "Film & Animation":
			return "Film ve Animasyon";
		case "Travel & Events":
			return "Seyahat";
		case "Pets & Animals":
			return "Hayvanlar";
		case "Nonprofits & Activism":
			return "Kar amacı olmayan kuruluş";
		default:
			return "Belirsiz";
	}
}

function channelLanguageTR($categoryENG)
{
	switch ($categoryENG) {
		case "Turkish":
			return "Türkçe";
		case "English":
			return "İngilizce";
		case "Spanish":
			return "İspanyolca";
		case "German":
			return "Almanca";
		case "Italian":
			return "İtalyanca";
		case "Russian":
			return "Rusça";
		default:
			return "Belirsiz";
	}
}

// function getImgAPI($channelId)
// {
// 	$API_URL = "https://www.googleapis.com/youtube/v3/channels?part=snippet&id=$channelId&key=$key";
// 	$json = json_decode(file_get_contents($API_URL), true);
// 	return $json['items'][0]['snippet']['thumbnails']['default']['url'];
// }
