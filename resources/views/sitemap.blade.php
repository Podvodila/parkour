<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc>{{route('site.index')}}</loc>
		<priority>1.0</priority>
	</url>
	<url>
		<loc>{{route('site.mapFind')}}</loc>
		<priority>0.9</priority>
	</url>
    @foreach ($spots as $spot)
        <url>
            <loc>{{route('site.spot', ['id' => $spot->id])}}</loc>
            <priority>0.8</priority>
        </url>
    @endforeach
    @foreach ($users as $user)
        <url>
            <loc>{{route('site.profile', ['id' => $user->id])}}</loc>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>