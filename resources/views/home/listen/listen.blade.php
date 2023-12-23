    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Listen</title>
        <link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />
        <script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

        <style>
            body {
                font-family: Arial, sans-serif;
                /* Clean, modern font */
                background-color: #f4f4f4;
                /* Light background for contrast */
                color: #333;
                /* Dark text for readability */
                margin: 0;
                padding: 20px;
            }

            /* Styling the header */
            h1 {
                text-align: center;
                /* Center the header */
                color: #007bff;
                /* A vibrant color for the header */
                margin-bottom: 30px;
                /* Spacing below the header */
            }

            h1 a {
                color: #007bff;
                text-decoration: none;
            }

            h1 a:hover {
                text-decoration: underline;
            }

            /* Container for centering the video with a balanced layout */
            #video-container {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
                margin-bottom: 20px;
                /* Spacing below the video container */
            }

            /* Styling the video player for a sleek, modern appearance */
            #my_video_1 {
                max-width: 640px;
                /* Adjustable width */
                max-height: 360px;
                /* Maintain aspect ratio */
                border: none;
                /* Removing the border for a cleaner look */
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
                /* Subtle shadow for depth */
                border-radius: 5px;
                /* Slightly rounded corners */
            }

            /* Big play button with a minimalistic, modern style */
            .vjs-big-play-button {
                font-size: 3em;
                color: #fff;
                background-color: rgba(255, 255, 255, 0.3);
                /* Lighter, less intrusive */
                border-radius: 50%;
                transition: all 0.3s ease;
            }

            .vjs-big-play-button:hover {
                background-color: rgba(255, 255, 255, 0.5);
                /* More visible on hover */
                transform: scale(1.05);
                /* Subtle increase in size */
            }

            /* Control bar with a modern, transparent look */
            .video-js .vjs-control-bar {
                background-color: rgba(255, 255, 255, 0.2);
                /* Light, transparent */
                transition: background-color 0.3s ease;
            }

            .video-js:hover .vjs-control-bar {
                background-color: rgba(255, 255, 255, 0.4);
                /* More visible on hover */
            }

            /* Progress bar with a stylish color */
            .video-js .vjs-progress-holder .vjs-play-progress,
            .video-js .vjs-progress-holder .vjs-load-progress {
                background: #4CAF50;
                /* Green for a fresh look */
            }

            /* Styling for control buttons */
            .video-js .vjs-control {
                color: #fff;
                transition: color 0.2s ease;
            }

            .video-js .vjs-control:hover {
                color: #4CAF50;
                /* Matching the progress bar color */
            }

            /* Other buttons and icons */
            .vjs-button {
                background: transparent;
                border: none;
                padding: 5px 10px;
                margin-left: 10px;
                cursor: pointer;
                color: #fff;
            }

            .vjs-button i {
                font-size: 16px;
            }

            .vjs-icon-next {
                color: #fff;
                font-size: 16px;
            }

            /* Link to go back - Styled as a button with better visibility */
            div a {
                display: block;
                /* Full-width block for better clickability */
                background-color: #007bff;
                color: #fff;
                padding: 10px 15px;
                text-decoration: none;
                border-radius: 5px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                margin: 20px auto;
                /* Centering the link */
                width: max-content;
                /* Only as wide as it needs to be */
                text-align: center;
            }

            div a:hover {
                background-color: #0056b3;
                /* Slightly darker on hover */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
                /* Enhanced shadow on hover */
            }
        </style>



    </head>

    <body>
        <h1><a href="{{ route('home') }}">HOME</a>&nbsp;VIDEO</h1>
        <div id="video-container">
            <video id="my_video_1" class="video-js vjs-default-skin" controls preload="auto" width="600"
                height="380" autoplay muted>
                <source src="http://127.0.0.1:8001/video/{{ $idVideo }}" type="video/mp4">
                <!-- Bạn có thể thêm phụ đề tại đây -->
                <!-- <track kind="captions" src="path_to_your_subtitle.vtt" srclang="en" label="English"> -->
            </video>
        </div>

        <div><a href="{{ route('listen') }}">BACK</a></div>


        <script>
            var player = videojs('my_video_1');
            var isDragging = false;


            player.ready(function() {
                //NEXT VIDEO - Đăng ký component mới
                var Button = videojs.getComponent('Button');
                var nextVideoButton = videojs.extend(Button, {
                    constructor: function() {
                        Button.apply(this, arguments);
                        this.addClass('vjs-icon-next');
                        this.controlText("Next Video");

                        // Tạo và thêm biểu tượng Font Awesome
                        var icon = document.createElement('i');
                        icon.className = 'fas fa-forward';
                        this.el().appendChild(icon);
                    },
                    handleClick: function() {
                        console.log('Next Video Clicked');
                        // Hành động khi nút được nhấp
                    }
                });

                videojs.registerComponent('NextVideoButton', nextVideoButton);

                var controlBar = player.getChild('controlBar');
                var playButton = controlBar.playToggle.el();
                controlBar.el().insertBefore(controlBar.addChild('NextVideoButton').el(), playButton.nextSibling);


                var progressBar = player.controlBar.progressControl.getChild('SeekBar').el();
                var lastTime; // Biến lưu trữ thời gian cuối cùng khi di chuyển chuột

                var calculateNewTime = function(event) {
                    var rect = progressBar.getBoundingClientRect();
                    var offsetX = event.clientX - rect.left;
                    var duration = player.duration();
                    var newTime = (offsetX / rect.width) * duration;
                    return newTime >= 0 && newTime <= duration ? newTime : null;
                };

                progressBar.addEventListener('mousedown', function(event) {
                    if (event.button === 0) {
                        isDragging = true;
                        lastTime = calculateNewTime(event);
                    }
                });

                progressBar.addEventListener('mousemove', function(event) {
                    if (isDragging) {
                        var newTime = calculateNewTime(event);
                        if (newTime !== null) {
                            lastTime = newTime;
                        }
                    }
                });

                window.addEventListener('mouseup', function(event) {
                    if (isDragging && event.button === 0) {
                        if (lastTime !== null) {
                            player.currentTime(lastTime);
                        }
                        isDragging = false;
                    }
                });

                progressBar.addEventListener('mouseleave', function(event) {
                    isDragging = false;
                });

                progressBar.addEventListener('click', function(event) {
                    var newTime = calculateNewTime(event);
                    if (newTime !== null) {
                        player.currentTime(newTime);
                    }
                });


                // Di chuyển biểu tượng loa và thanh điều chỉnh âm lượng
                var volumePanel = controlBar.volumePanel.el();
                var progressControl = controlBar.progressControl.el();
                controlBar.el().insertBefore(volumePanel, progressControl.nextSibling);
            });


            nextVideoButton.prototype.constructor = function() {
                Button.apply(this, arguments);
                this.addClass('vjs-icon-next');
                this.controlText("Next Video");
                var icon = document.createElement('i');
                icon.className = 'fas fa-forward'; // Đảm bảo class này khớp với biểu tượng Font Awesome bạn muốn sử dụng
                this.el().appendChild(icon); // Thêm biểu tượng vào nút
            };
        </script>


    </body>

    </html>
