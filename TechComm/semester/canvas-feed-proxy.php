<?php
// canvas-feed-proxy.php

// Your Canvas Atom feed URL:
$feed_url = "https://canvas.vt.edu/feeds/announcements/enrollment_xgIfWBuSRoylRGQZHYwRwLV9MDvNqHzHXYthmaHM.atom";

// Fetch the feed server-side
$context = stream_context_create([
    'http' => [
        'timeout' => 5,
        'user_agent' => 'CanvasRSSWidget/1.0'
    ]
]);

$feed = @file_get_contents($feed_url, false, $context);

if ($feed === false) {
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode(["error" => "Could not fetch feed"]);
    exit;
}

// Just pass the raw XML back to the browser
header("Content-Type: application/xml; charset=UTF-8");
echo $feed;