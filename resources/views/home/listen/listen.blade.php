<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listen</title>


</head>

<body>
    <video controls width="720">
        <source src="{{ asset('video/Hàng xóm của tôi là Totoro.mp4') }}" type="video/mp4">
        <track label="VIETNAMESE" kind="subtitles" srclang="vn"
            src="{{ asset('video/1988.My.Neighbor.Totoro.BluRay.720p.DTS.3Audio.x264-CHD [co hieu ung, bai hat tieng Anh].vtt') }}"
            default>
        Your browser does not support the video tag or the file format of this video.
    </video>

</body>

</html>
