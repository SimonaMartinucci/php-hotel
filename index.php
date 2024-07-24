<?php

    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];

    // FILTRO PARKING
    // se checkbox selezionata
    if (isset($_GET['with_parking'])) {
        // creo nuovo array
        $filteredHotels = [];
        // ciclo
        foreach ($hotels as $hotel) {
            // se 'parkin' è true
            if ($hotel['parking']) {
                // inserisco l'hotel nel nuovo array
                $filteredHotels[] = $hotel;
            }
        }
    // altrimenti nuovo array uguale ad array originale
    } else {
        $filteredHotels = $hotels;
    };


    // FILTRO RATINGS
    $arrayRatings = [1, 2, 3, 4, 5];
    // se nessun radio 'rating' è selezionato, parto dal filtro 'parking'
    $ratedHotels = $filteredHotels;

    // se un radio 'rating' è selezionato
    if(isset($_GET['rating'])) {
        // array vuoto
        $ratedHotels = [];
        // creo variabile per il valore del radio selezionato
        $selectedRating = $_GET['rating'];
        // ciclo gli hotel filtrati dal filtro 'parking'
        foreach ($filteredHotels as $hotel) {
            // se il valore 'vote' è maggiore o uguale a valore radio selezionato
            if ($hotel['vote'] >= $selectedRating) {
                // aggiungi hotel ad array
                $ratedHotels[] = $hotel;
            }
        }
    };

    // array su cui ciclo uguale ad array filtrato da entrambi i filtri
    $finalHotels = $ratedHotels;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>php-hotel</title>
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4 fw-bold">PHP HOTEL</h1>
        <form class="mb-4" action="index.php" method="get">
            <!-- filtro parking -->
            <input type="checkbox" name="with_parking">
            <label class="ms-1" for="checkbox">Con parcheggio</label>

            <!-- filtro votazioni -->
            <label class="ms-5 me-3" for="rating">Scegli un voto</label>
            <?php foreach($arrayRatings as $number): ?>
                <input type="radio" id="rating_<?php echo $number ?>" name="rating" value="<?php echo $number; ?>" <?php if (isset($_GET['rating']) && $_GET['rating'] === $number) echo 'checked'; ?>>
                <label class="ms-1 me-3" for="rating_<?php echo $number ?>"><?php echo $number ?></label>
            <?php endforeach; ?>

            <button class="btn btn-primary ms-4" type="submit">Cerca</button>
        </form>
        <table class="table">
            <!-- titoli tabella -->
            <thead>
                <tr>
                <th scope="col">Nome Hotel</th>
                <th scope="col">Descrizione</th>
                <th scope="col">Parcheggio</th>
                <th scope="col">Votazione</th>
                <th scope="col">Distanza dal centro</th>
                </tr>
            </thead>
            <!-- contenuto righe tabella -->
            <?php foreach($finalHotels as $hotel): ?>
            <tbody>
                <tr>
                <td><?php echo $hotel['name'] ?></td>
                <td><?php echo $hotel['description'] ?></td>
                <td><?php echo $hotel['parking'] ? "Sì" : "No"; ?></td>
                <td><?php echo $hotel['vote'] ?></td>
                <td><?php echo $hotel['distance_to_center'] ?> km</td>
                </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
    </div>   
</body>
</html>