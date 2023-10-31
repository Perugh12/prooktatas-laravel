<!DOCTYPE html>
<html>

<head>
    <title>Laravel Ecommerce</title>
</head>

<body>

    Kedves {{ $details['name'] }},

    <h3>{{ $details['title'] }}</h3>
    <p>{{ $details['body'] }}</p>

    <div class="mail-wrapper">
        <h5>Összegzés</h5>
        <table>
            <thead>
                <tr>
                    <th>Termék</th>
                    <th>Mennyiség</th>
                    <th>Ár</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details['products'] as $product)
                <tr>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>{{ $product['unit_price'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table>
            <tr>
                <td>Végösszeg</td>
                <td>{{ $details['total_price'] }}</td>
            </tr>
        </table>
    </div>

    <p>Köszönjük</p>

</body>

</html>