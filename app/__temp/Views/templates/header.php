<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Hotel Booking' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hotel-card { transition: transform 0.3s; }
        .hotel-card:hover { transform: translateY(-5px); }
        .rating i { color: #ffc107; }
    </style>
</head>
<body>
    <?= $this->include('templates/navbar') ?>
    <div class="container mt-4">