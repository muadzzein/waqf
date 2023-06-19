<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Faraid Calculator</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 500px;
            margin-top: 50px;
        }

        .btn-calculate {
            margin-top: 10px;
        }

        body{
            background: #FFDB58	;
        }
    </style>
</head>

<body class="bg-black font-sans leading-normal tracking-normal mt-12">
<div class="container">
    <h2 class="mb-4">Faraid Calculator</h2>
    <form action="{{ route('faraid.calculate') }}" method="POST">
        @csrf
        <div class="row">
            <div class="form-group">
                <label for="assets">Total assets value:</label>
                <input type="number" name="assets" placeholder="0">
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="mother">Mother</label>
                    <select name="mother" class="form-control">
                        <option value="0">0</option>
                        <option value="1">1</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="father">Father:</label>
                    <select name="father" class="form-control">
                        <option value="0">0</option>
                        <option value="1">1</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Spouse">Spouse:</label>
                    <select name="spouse" class="form-control">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="son">Sons:</label>
                    <select name="son" class="form-control">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="daughter">Daughters:</label>
                    <select name="daughter" class="form-control">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                </select>
                </div>
                <div class="form-group">
                    <label for="brother">Brothers:</label>
                    <select name="brother" class="form-control">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sister">Sisters:</label>
                    <select name="sister" class="form-control">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                </div>
                <div class="form-group">
                    <label for="gfather">Grandfather (Father's father ):</label>
                    <select name="gfather" class="form-control">
                        <option value="0">0</option>
                        <option value="1">1</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="gmother">GrandMother (Father's mother ):</label>
                    <select name="gmother" class="form-control">
                        <option value="0">0</option>
                        <option value="1">1</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="gmother_mot">Grandmother (Mother's mother ):</label>
                    <select name="gmother_mot" class="form-control">
                        <option value="0">0</option>
                        <option value="1">1</option>
                    </select>
                </div>

            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-calculate">Calculate</button>
        </div>
    </form>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>

</html>
<?php
