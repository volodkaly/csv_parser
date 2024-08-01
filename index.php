<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přehled oscarů za nejlepší mužskou a ženskou hlavní roli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Přehled oscarů za nejlepší mužskou a ženskou hlavní roli</h1>
    <form action="/upload.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="femaleFile" class="form-label">Nahrát CSV soubor s přehledem ženských rolí</label>
            <input class="form-control" type="file" id="femaleFile" name="femaleFile" accept='.csv' required>
        </div>
        <div class="mb-3">
            <label for="maleFile" class="form-label">Nahrát CSV soubor s přehledem mužských rolí</label>
            <input class="form-control" type="file" id="maleFile" name="maleFile" accept='.csv' required>
        </div>
        <button type="submit" class="btn btn-primary">Odeslat</button>
    </form>
    <div id="results" class="mt-5">

    </div>
</div>
</body>
</html>
