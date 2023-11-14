@extends('clients.client')

@section('content')

    <body>
        <button id="startRecording">Bắt đầu ghi âm</button>
        <button id="stopRecording" disabled>Dừng ghi âm</button>
        <button id="playRecording" disabled>Phát lại</button>
        <audio id="audioPlayer" controls></audio>
        <div id="get-json"></div>

        <script>
            const startButton = document.getElementById("startRecording");
            const stopButton = document.getElementById("stopRecording");
            const playButton = document.getElementById("playRecording");
            const audioPlayer = document.getElementById("audioPlayer");
            let mediaRecorder;
            let audioChunks = [];

            // Bắt đầu ghi âm
            startButton.addEventListener("click", () => {
                navigator.mediaDevices.getUserMedia({
                        audio: true
                    })
                    .then(stream => {
                        mediaRecorder = new MediaRecorder(stream);
                        mediaRecorder.ondataavailable = event => {
                            audioChunks.push(event.data);
                        };
                        mediaRecorder.onstop = () => {
                            const audioBlob = new Blob(audioChunks, {
                                type: "audio/wav"
                            });
                            // Tạo FormData và gửi nó đến máy chủ
                            const formData_audio = new FormData();
                            const randomFileName = generateRandomFileName(); // Hàm tạo tên file ngẫu nhiên
                            formData_audio.append('audio', audioBlob, randomFileName);
                            fetch('/upload_audio', {
                                method: 'POST',
                                body: formData_audio
                            });


                            audioPlayer.src = URL.createObjectURL(audioBlob);
                        };
                        mediaRecorder.start();
                        startButton.disabled = true;
                        stopButton.disabled = false;
                    })
                    .catch(error => {
                        console.error("Lỗi khi truy cập microphone: " + error);
                    });
            });

            // Dừng ghi âm
            stopButton.addEventListener("click", () => {
                mediaRecorder.stop();
                startButton.disabled = false;
                stopButton.disabled = true;
                playButton.disabled = false;
            });

            // Phát lại âm thanh
            playButton.addEventListener("click", () => {
                audioPlayer.play();
            });

            // Hàm tạo tên file ngẫu nhiên sử dụng UUID
            function generateRandomFileName() {
                const randomUUID = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, (c) => {
                    const r = Math.random() * 16 | 0;
                    const v = c === 'x' ? r : (r & 0x3 | 0x8);
                    return v.toString(16);
                });
                return randomUUID + '.wav';
            }

        </script>
    </body>
@endsection
