<!DOCTYPE html>
<html>

<head>
    <title>So sánh phát âm</title>
    <style>
        #audioPlayer {
            display: none;
        }

        #recordingStatus {
            display: none;
            text-align: center;
            color: red;
            font-weight: bold;
        }

        #comparisonResult {
            display: none;
            text-align: center;
        }
    </style>
</head>

<body>
    <input type="text" id="wordInput">
    <button id="speakBtn">Phát âm</button>
    <button id="recordButton">Ghi âm</button>
    <button id="playButton" disabled>Nghe lại</button>
    <audio id="audioPlayer" controls></audio>
    <div id="recordingStatus">Đang ghi âm...</div>
    <div id="comparisonResult">
        <span>Điểm số tương tự:</span>
        <span id="similarityScore"></span>
    </div>

    <div id="result"></div>

    <script>
        const input = document.getElementById('wordInput');
        const speakButton = document.getElementById('speakBtn');
        const recordButton = document.getElementById('recordButton');
        const playButton = document.getElementById('playButton');
        const audioPlayer = document.getElementById('audioPlayer');
        const recordingStatus = document.getElementById('recordingStatus');
        const comparisonResult = document.getElementById('comparisonResult');
        const resultDiv = document.getElementById('result');
        let originalBlob;
        let recordedBlob;

        speakButton.addEventListener('click', () => {
            const word = input.value;
            speakText(word);
        });

        function speakText(text) {
            const speech = new SpeechSynthesisUtterance(text);
            speechSynthesis.speak(speech);
        }

        async function recordAudio() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                const recorder = new MediaRecorder(stream);
                const audioChunks = [];
                recorder.ondataavailable = e => audioChunks.push(e.data);

                recorder.start();
                updateRecordButton(true);

                return new Promise((resolve, reject) => {
                    recorder.onstop = () => {
                        const audioBlob = new Blob(audioChunks, { 'type': 'audio/wav' });
                        resolve(audioBlob);
                    };
                    recorder.onerror = reject;
                });
            } catch (error) {
                console.error('Lỗi khi ghi âm:', error);
            }
        }

        function playAudio(blob) {
            const audioURL = URL.createObjectURL(blob);
            audioPlayer.src = audioURL;
            audioPlayer.style.display = 'block';
            playButton.disabled = false;
        }

        async function compareAudio() {
            // Cài đặt logic so sánh âm thanh của bạn ở đây
            // Đảm bảo trả về một giá trị số thực, ví dụ: 0.85
            const similarity = 0.85; // Thay bằng điểm tương tự thực tế
            return similarity;
        }

        function updateRecordButton(isRecording) {
            if (isRecording) {
                recordButton.textContent = 'Dừng ghi âm';
                recordButton.style.background = 'red';
                recordingStatus.style.display = 'block';
                playButton.disabled = true;
            } else {
                recordButton.textContent = 'Ghi âm';
                recordButton.style.background = '';
                recordingStatus.style.display = 'none';
            }

            playButton.addEventListener('click', () => {
                if (recordedBlob) {
                    playAudio(recordedBlob);
                }
            });
        }

        recordButton.addEventListener('click', async () => {
            if (recordButton.textContent === 'Ghi âm') {
                try {
                    originalBlob = await recordAudio();
                    updateRecordButton(false);
                    playAudio(originalBlob);
                } catch (error) {
                    console.error('Lỗi khi ghi âm:', error);
                }
            } else {
                audioPlayer.style.display = 'none';
                updateRecordButton(false);

                if (originalBlob) {
                    recordedBlob = await recordAudio();
                    const similarity = await compareAudio();
                    showResult(similarity);
                }
            }
        });

        function showResult(similarity) {
            const scoreSpan = document.getElementById('similarityScore');
            scoreSpan.textContent = (similarity * 100).toFixed(2) + '%';
            comparisonResult.style.display = 'block';
        }
    </script>
</body>

</html>
