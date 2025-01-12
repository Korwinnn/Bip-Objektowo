<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            line-height: 1.6;
        }
        .header {
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .institution {
            text-align: right;
            color: rgb(206, 0, 0);
        }
        .category-title {
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
            color: rgb(206, 0, 0);
        }
        .metadata {
            margin-top: 30px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="institution">Biuletyn Informacji Publicznej</div>
    </div>

    <div class="category-title">
        {{ $category->name }}
    </div>

    <div class="content">
        {!! $category->content !!}
    </div>

    <div class="metadata">
        <p><strong>Metryka dokumentu:</strong></p>
        <ul>
            <li>Data utworzenia: {{ $category->created_at->format('d.m.Y H:i') }}</li>
            <li>Utworzył: {{ $category->creator->name }}</li>
            <li>Data ostatniej modyfikacji: {{ $category->updated_at->format('d.m.Y H:i') }}</li>
            <li>Ostatnio modyfikował: {{ $category->updater->name }}</li>
            <li>Liczba zmian: {{ $category->changes_count }}</li>
            <li>Liczba odwiedzin: {{ $category->visits_count }}</li>
        </ul>
    </div>
</body>
</html>