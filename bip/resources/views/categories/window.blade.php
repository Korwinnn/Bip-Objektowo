<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>{{ $category->name }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            line-height: 1.6;
        }
        .header {
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .metadata {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
            font-size: 0.9em;
            color: rgb(102, 102, 102);
        }
        h1{
            color: rgb(218, 0, 0);
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $category->name }}</h1>
    </div>

    <div class="content">
        {!! $category->content !!}
    </div>

    <div class="metadata">
        <h4>Metryka dokumentu:</h4>
        <table>
            <tr>
                <td>Data utworzenia:</td>
                <td>{{ $category->created_at->format('d.m.Y H:i') }}</td>
            </tr>
            <tr>
                <td>Utworzył:</td>
                <td>{{ $category->creator->name }}</td>
            </tr>
            <tr>
                <td>Ostatnia modyfikacja:</td>
                <td>{{ $category->updated_at->format('d.m.Y H:i') }}</td>
            </tr>
            <tr>
                <td>Modyfikował:</td>
                <td>{{ $category->updater->name }}</td>
            </tr>
            <tr>
                <td>Liczba zmian:</td>
                <td>{{ $category->changes_count }}</td>
            </tr>
            <tr>
                <td>Liczba odwiedzin:</td>
                <td>{{ $category->visits_count }}</td>
            </tr>
        </table>
    </div>
</body>
</html>