<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oscar Winners</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    h2{
        margin: auto;
        text-align: center;
        font-weight: bold;
    }

    h6{
        margin: auto;
        text-align: center;
        font-weight: bold;
    }

    tr:hover{
        background-color: lightgrey;
        outline: 2px solid black;
    }
</style>
<body>

<?php

class OscarData
{
    private $femaleData;
    private $maleData;

    public function __construct($femaleFile, $maleFile)
    {
        $this->femaleData = $this->readCSV($femaleFile);
        $this->maleData = $this->readCSV($maleFile);
    }

    private function readCSV($file)
    {
        $data = [];
        if (($handle = fopen($file, "r")) !== false) {
            $header = fgetcsv($handle, 1000, ",");
            while (($row = fgetcsv($handle, 1000, ",")) !== false) {
                $data[] = $row;
            }
            fclose($handle);
        }
        return $data;
    }

    public function getOverviewByYear()
    {
        $overview = [];
        foreach ($this->femaleData as $female) {
            if (isset($female[1], $female[2], $female[3], $female[4])) {
                $year = $female[1];
                $age = trim($female[2]);
                $name = trim($female[3]);
                $title = trim($female[4]);
                $overview[$year]['female'] = "{$name} ({$age})";
                $overview[$year]['female_movie'] = "{$title}";
            }
        }

        foreach ($this->maleData as $male) {
            if (isset($male[1], $male[2], $male[3], $male[4])) {
                $year = $male[1];
                $age = trim($male[2]);
                $name = trim($male[3]);
                $title = trim($male[4]);
                $overview[$year]['male'] = "{$name} ({$age})";
                $overview[$year]['male_movie'] = "{$title}";
            }
        }

        ksort($overview);
        return $overview;
    }

    public function getMoviesWithBothAwards()
    {
        $movies = [];
        $femaleMovies = [];
        foreach ($this->femaleData as $female) {
            if (isset($female[4])) {
                $femaleMovies[$female[4]] = ['year' => $female[1], 'actress' => $female[3]];
            }
        }

        foreach ($this->maleData as $male) {
            if (isset($male[4]) && isset($femaleMovies[$male[4]])) {
                $movies[] = [
                    'movie' => $male[4],
                    'year' => $male[1],
                    'actress' => $femaleMovies[$male[4]]['actress'],
                    'actor' => $male[3],
                ];
            }
        }

        usort($movies, function ($a, $b) {
            return strcmp($a['movie'], $b['movie']);
        });

        return $movies;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $femaleFile = $_FILES['femaleFile']['tmp_name'];
    $maleFile = $_FILES['maleFile']['tmp_name'];

    $femaleFileExtension = pathinfo($_FILES['femaleFile']['name'], PATHINFO_EXTENSION);
    $maleFileExtension = pathinfo($_FILES['maleFile']['name'], PATHINFO_EXTENSION);

    if ($femaleFileExtension !== 'csv' || $maleFileExtension !== 'csv') {
        exit('<div class="alert alert-danger" role="alert"><h1>Please upload valid CSV files.</h1></div>');
    }

    $oscarData = new OscarData($femaleFile, $maleFile);

    $overviewByYear = $oscarData->getOverviewByYear();
    $moviesWithBothAwards = $oscarData->getMoviesWithBothAwards();

    echo '<div class="container mt-5">';
    echo '<h2>Roční přehled</h2>';
    echo '<table class="table table-striped table-hover"><thead><tr><th>Rok</th><th>Herečka</th><th>Herec</th></tr></thead><tbody>';
    foreach ($overviewByYear as $year => $data) {
        $female = isset($data['female']) ? htmlspecialchars($data['female']) : 'N/A';
        $female_movie = isset($data['female_movie']) ? htmlspecialchars($data['female_movie']) : '';
        $male = isset($data['male']) ? htmlspecialchars($data['male']) : 'N/A';
        $male_movie = isset($data['male_movie']) ? htmlspecialchars($data['male_movie']) : '';
        echo '<tr>';
        echo "<td>{$year}</td>";
        echo "<td>{$female}<br><small><em>{$female_movie}</em></small></td>";
        echo "<td>{$male}<br><small><em>{$male_movie}</em></small></td>";
        echo '</tr>';
    }
    echo '</tbody></table>';

    echo '<h2>Filmy s oběma cenami</h2>';
    echo '<h6>(Oscar jak za ženskou, tak za mužskou roli)</h6>';
    echo '<table class="table table-striped table-hover"><thead><tr><th>Film</th><th>Rok</th><th>Herečka</th><th>Herec</th></tr></thead><tbody>';
    foreach ($moviesWithBothAwards as $movie) {
        echo '<tr>';
        echo "<td>" . htmlspecialchars($movie['movie']) . "</td>";
        echo "<td>" . htmlspecialchars($movie['year']) . "</td>";
        echo "<td>" . htmlspecialchars($movie['actress']) . "</td>";
        echo "<td>" . htmlspecialchars($movie['actor']) . "</td>";
        echo '</tr>';
    }
    echo '</tbody></table>';
    echo '</div>';
}

?>

</body>