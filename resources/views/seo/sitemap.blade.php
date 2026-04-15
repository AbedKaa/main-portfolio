<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ $baseUrl }}/</loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>

    <url>
        <loc>{{ $baseUrl }}/projects</loc>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>

    <url>
        <loc>{{ $baseUrl }}/about</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>

    <url>
        <loc>{{ $baseUrl }}/blog</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ $baseUrl }}/contact</loc>
        <changefreq>yearly</changefreq>
        <priority>0.5</priority>
    </url>

    @foreach ($projects as $p)
        <url>
            <loc>{{ $baseUrl }}/projects/{{ $p->slug }}</loc>
            @if ($p->updated_at)
                <lastmod>{{ $p->updated_at->toAtomString() }}</lastmod>
            @endif
            <changefreq>monthly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    @foreach ($posts as $post)
        <url>
            <loc>{{ $baseUrl }}/blog/{{ $post->slug }}</loc>
            @if ($post->updated_at)
                <lastmod>{{ $post->updated_at->toAtomString() }}</lastmod>
            @endif
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach
</urlset>
