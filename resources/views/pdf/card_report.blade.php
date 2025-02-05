<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório - {{ $card->title }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Relatório da Locação - {{ $card->title }}</h1>
    <p><strong>Locação:</strong> {{ $card->description }}</p>
    <p><strong>Data de Criação:</strong> {{ $card->created_at->format('d/m/Y - H:i') }}</p>

    <h2>Pagamentos</h2>
    <table>
        <thead>
            <tr>
                <th>Locatário</th>
                <th>Data do Pagamento</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($infos as $info)
                <tr>
                    <td>{{ $info->renter->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($info->payment_date)->format('d/m/Y') }}</td>
                    <td>R$ {{ number_format($info->payment_value, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h3><strong>Valor Total: </strong>R$ {{ number_format($totalPayment, 2, ',', '.') }}</h3>
</body>
</html>
