<?php

require "helpers/class.php";

$index = new Index();
[$history_data, $bandara_data] = $index->fetchData();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Project Pesawat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link rel="stylesheet" href="styles/index.css" />
</head>

<body>
    <!-- If success $_GET initiate it will show the alert -->
    <?php if (isset($_GET["success"])) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Success Created!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif ?>
    <div class="container mt-4">
        <h1 class="text-center">Pendaftaran Rute Penerbangan</h1>
        <form action="helpers/store.php" method="post">
            <div class="form-group row">
                <label for="maskapai">Maskapai</label>
                <input type="text" class="form-control" id="maskapai" placeholder="Masukan Nama Maskapai" name="maskapai" required />
            </div>
            <div class="form-group row">
                <label for="bandara_asal">Bandara Asal</label>
                <select name="bandara_asal" id="bandara_asal" class="form-control" required>
                    <?php foreach (array_keys($bandara_data["bandara_asal"]) as $data) : ?>
                        <option value="<?= $data ?>"><?= $data ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group row">
                <label for="bandara_tujuan">Bandara Tujuan</label>
                <select name="bandara_tujuan" id="bandara_tujuan" class="form-control" required>
                    <?php foreach (array_keys($bandara_data["bandara_tujuan"]) as $data) : ?>
                        <option value="<?= $data ?>"><?= $data ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group row">
                <label for="harga">Harga Tiket</label>
                <input type="number" class="form-control" id="harga" min="0" name="harga" required />
            </div>
            <div class="form-group row">
                <button type="submit" class="btn btn-success center" name="submit">
                    Submit
                </button>
            </div>
        </form>
    </div>
    <div class="container mt-4 mb-4">
        <h1 class="text-center mb-4">Daftar Rute</h1>
        <table class="table mb-4">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Maskapai</th>
                    <th scope="col">Asal Penerbangan</th>
                    <th scope="col">Tujuan Penerbangan</th>
                    <th scope="col">Harga Tiket</th>
                    <th scope="col">Pajak</th>
                    <th scope="col">Total Harga Tiket</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($history_data as $row) : ?>
                    <tr>
                        <?php foreach ($row as $data) : ?>
                            <td><?= $data ?></td>
                        <?php endforeach ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>