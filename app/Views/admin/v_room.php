<?php echo $this->extend("layout/l_admin"); ?>
<?php echo $this->section("content"); ?>

<h1 class="font-heading">Room</h1>

<?php foreach($rooms as $room): ?>
<div class="bg-success">
    <h1> <?= $room['name'] ?></h1>
    <p> <?= $room['description'] ?></p>
    <p> <?= $room['base_price'] ?></p>
    <p> <?= $room['capacity'] ?></p>
    <p> <?= $room['available_rooms'] ?></p>
</div>


<?php endforeach ?>

<?php echo $this->endSection() ?>