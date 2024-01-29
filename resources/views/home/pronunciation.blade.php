<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Luyện Phát Âm Tiếng Nhật</title>
    <!-- Thêm CSS và JavaScript nếu cần -->
</head>

<body>
    <div class="container">
        <h1>Luyện Phát Âm Tiếng Nhật</h1>

        <div id="vocabulary">
            <h2>Từ Vựng: <input type="text" id="word" value=""></h2>
            <button onclick="playAudio()">Nghe</button>
        </div>

        <div id="recording">
            <button onclick="startRecording()">Bắt đầu ghi âm</button>
            <button onclick="stopRecording()" disabled>Dừng ghi âm</button>
        </div>

        <div id="feedback">
            <h3>Phản hồi</h3>
            <p id="pronunciationFeedback"></p>
        </div>
    </div>

    <script>
        let mediaRecorder, audioChunks = [];

        function playAudio() {
            const word = document.getElementById('word').value;
            if (!word.trim()) {
                alert('Vui lòng nhập từ vựng!');
                return;
            }

            console.log(word);
            fetch('/home/synthesize-speech', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        word: word
                    })
                })
                .then(response => response.json())
                .then(data => new Audio(data.audio_url).play())
                .catch(error => console.error('Error:', error));
        }

        function startRecording() {
            navigator.mediaDevices.getUserMedia({
                    audio: true
                })
                .then(stream => {
                    mediaRecorder = new MediaRecorder(stream);
                    mediaRecorder.ondataavailable = e => audioChunks.push(e.data);
                    mediaRecorder.onstop = () => sendAudioToServer(new Blob(audioChunks, {
                        type: 'audio/mp3'
                    }));
                    mediaRecorder.start();
                    document.querySelector('#recording button[onclick="stopRecording()"]').disabled = false;
                })
                .catch(e => console.error(e));
        }

        function stopRecording() {
            if (mediaRecorder && mediaRecorder.state !== 'inactive') {
                mediaRecorder.stop();
                mediaRecorder.stream.getTracks().forEach(track => track.stop());
                document.querySelector('#recording button[onclick="stopRecording()"]').disabled = true;
            }
        }

        function sendAudioToServer(audioBlob) {
            let formData = new FormData();
            formData.append('audio', audioBlob, '.mp3');

            fetch('/home/upload-audio', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => updateFeedback(data))
                .catch(error => console.error('Error uploading audio:', error));
        }

        function updateFeedback(data) {
            console.log(data);
            const feedbackElement = document.getElementById('pronunciationFeedback');
            let feedbackMessage = 'Phản hồi: ';

            if (data.analysis) {
                feedbackMessage += data.analysis.is_correct ? 'Phát âm chính xác.' : 'Phát âm chưa chính xác.';
                feedbackMessage += `<br>Phát âm nhận dạng được: ${data.analysis.transcription}`;
            } else {
                feedbackMessage += 'Không thể phân tích phát âm. Vui lòng thử lại.';
            }

            feedbackElement.innerHTML = feedbackMessage;
        }
    </script>
</body>

</html>
