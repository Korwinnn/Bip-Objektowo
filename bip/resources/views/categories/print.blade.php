<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>{{ $category->name }} - Wydruk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            line-height: 1.6;
        }
        .header {
            display: flex;
            justify-content: right;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .date {
            color: rgb(212, 4, 4);
        }
        .institution {
            font-weight: bold;
        }
        .category-title {
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
            color: rgb(212, 4, 4);
        }
        .content {
            margin: 20px 0;
        }
        .metadata {
            margin-top: 30px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }
        .source {
            margin-top: 30px;
            color: #666;
            font-size: 12px;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="date">Biuletyn Informacji Publicznej</div>
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

    <div class="no-print">
        <button onclick="window.print()" style="margin-top: 20px;">Drukuj</button>
    </div>
</body>
</html>