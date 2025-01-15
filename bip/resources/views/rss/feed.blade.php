<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>{{ $institutionName }}</title>
        <link>{{ url('/') }}</link>
        <description>Aktualności i informacje z Biuletynu Informacji Publicznej</description>
        <language>pl</language>
        <lastBuildDate>{{ now()->toRssString() }}</lastBuildDate>
        <atom:link href="{{ url('rss') }}" rel="self" type="application/rss+xml"/>

        @foreach($categories as $category)
            <item>
                <title>{{ $category->name }}</title>
                <link>{{ route('categories.show', $category) }}</link>
                <guid>{{ route('categories.show', $category) }}</guid>
                <description><![CDATA[{!! $category->content !!}]]></description>
                <pubDate>{{ $category->updated_at->toRssString() }}</pubDate>
            </item>

            @foreach($category->children as $child)
                <item>
                    <title>{{ $category->name }} - {{ $child->name }}</title>
                    <link>{{ route('categories.show', $child) }}</link>
                    <guid>{{ route('categories.show', $child) }}</guid>
                    <description><![CDATA[{!! $child->content !!}]]></description>
                    <pubDate>{{ $child->updated_at->toRssString() }}</pubDate>
                </item>
            @endforeach
        @endforeach
    </channel>
</rss>