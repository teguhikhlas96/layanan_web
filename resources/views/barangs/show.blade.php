<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .details {
            list-style: none;
            padding: 0;
        }

        .details li {
            margin-bottom: 10px;
            font-size: 18px;
        }

        .details li span {
            font-weight: bold;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail Barang</h1>
        <ul class="details">
            <li><span>Nama:</span> {{ $barang['name'] }}</li>
            <li><span>Harga:</span> {{ $barang['price'] }}</li>
            <li><span>Deskripsi:</span> {{ $barang['description'] }}</li>
        </ul>
        <a href="{{ route('barangs.index') }}" class="back-link">Kembali ke Daftar Barang</a>
    </div>
</body>
</html>
