<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listen</title>
    <!-- Thêm CSS của Video.js -->
    <link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />

    <!-- Thêm JavaScript của Video.js -->
    <script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script>

    <style>
        .vjs-text-track-display div {
            position: absolute;
            top: 10%;
            /* Điều chỉnh giá trị này để thay đổi vị trí */
        }

        /* Tùy chỉnh nút play */
        .vjs-big-play-button {
            /* Thêm các thuộc tính CSS tại đây */
        }

        /* Tùy chỉnh thanh tiến trình */
        .vjs-progress-control {
            /* Thêm các thuộc tính CSS tại đây */
        }
    </style>
</head>

<body>

    <video id="my_video_1" class="video-js vjs-default-skin" controls preload="auto" width="640" height="264"
        data-setup='{}'>
        <source src="path_to_your_video.mp4" type="video/mp4">
        <!-- Thêm phụ đề tại đây -->
        <track kind="captions" src="path_to_your_subtitle.vtt" srclang="en" label="English">
    </video>

    <script>
        var player = videojs('my_video_1');
        player.ready(function() {
            // Tùy chỉnh và thêm các chức năng ở đây
        });


        player.ready(function() {
            // Ví dụ: Thêm một nút tùy chỉnh
            var Button = videojs.getComponent('Button');
            var customButton = videojs.extend(Button, {
                // Tùy chỉnh nút tại đây
            });

            player.addChild(new customButton());
        });
    </script>
</body>

</html>
