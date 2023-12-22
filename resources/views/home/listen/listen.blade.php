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
                cursor: pointer;
            }

            .vjs-button {
                background: transparent;
                border: none;
                padding: 5px 10px;
                margin-left: 10px;
                cursor: pointer;
                color: #fff;
                /* Màu của biểu tượng */
            }

            .vjs-button i {
                font-size: 16px;
                /* Điều chỉnh kích thước biểu tượng */
            }

            .vjs-icon-next {
                color: white; // Màu sắc của biểu tượng
                font-size: 16px; // Kích thước của biểu tượng
                /* Thêm các tùy chỉnh CSS khác nếu cần */
            }
        </style>
    </head>

    <body>
        <h1>VIDEO</h1>
        <video id="my_video_1" class="video-js vjs-default-skin" controls preload="auto" width="640" height="264"
            autoplay muted>
            <source src="http://127.0.0.1:8001/video/{{ $idVideo }}" type="video/mp4">
            <!-- Bạn có thể thêm phụ đề tại đây -->
            <!-- <track kind="captions" src="path_to_your_subtitle.vtt" srclang="en" label="English"> -->
        </video>


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
