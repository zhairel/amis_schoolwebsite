<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    @foreach($staticPages as $page)
    <url>
        <loc>https://amis.edu.ph{{ $page['url'] }}</loc>
        <changefreq>{{ $page['changefreq'] }}</changefreq>
        <priority>{{ $page['priority'] }}</priority>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
    </url>
    @endforeach

    @foreach($announcements as $announcement)
    <url>
        <loc>https://amis.edu.ph/announcement/{{ $announcement->uuid ?? $announcement->id }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
        <lastmod>{{ $announcement->updated_at->toAtomString() }}</lastmod>
    </url>
    @endforeach

</urlset>
