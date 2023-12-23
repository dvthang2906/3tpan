<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Write-Kanji</title>
    <style>
        iframe path {
            stroke-dasharray: 1000;
            /* A large enough value */
            stroke-dashoffset: 1000;
            /* Same as stroke-dasharray initially */
            animation: drawStroke 2s forwards;
            /* Adjust time as needed */
        }

        @keyframes drawStroke {
            to {
                stroke-dashoffset: 0;
                /* Reduces to 0 during the animation */
            }
        }

        /* Set different animation delays for each path */
        iframe #kvg\:0f9a8-s1 {
            animation-delay: 0s;
        }

        iframe #kvg\:0f9a8-s2 {
            animation-delay: 2s;
        }

        iframe #kvg\:0f9a8-s3 {
            animation-delay: 4s;
        }

        iframe #kvg\:0f9a8-s4 {
            animation-delay: 6s;
        }

        iframe #kvg\:0f9a8-s5 {
            animation-delay: 8s;
        }

        iframe svg {
            width: 218px;
            /* Ví dụ, gấp đôi kích thước ban đầu */
            height: 218px;
        }
    </style>
</head>

<body>
    <h1>Write-Kanji</h1>
    <!-- Khung chứa SVG -->
    {{-- <div id="svg-container"></div> --}}
    <iframe src="http://127.0.0.1:8002/svg-file"></iframe>


    <script>
        function updateSVG(svgElement) {
            // Kiểm tra xem svgElement có tồn tại không
            if (!svgElement) {
                console.error('SVG element is not found.');
                return;
            }

            const paths = svgElement.querySelectorAll('path');
            paths.forEach(function(path) {
                const length = path.getTotalLength();
                path.style.strokeDasharray = length;
                path.style.strokeDashoffset = length;

                // Xác định animation delay dựa vào ID của path
                const pathId = path.id;
                const order = parseInt(pathId.match(/\d+$/)[0], 10); // Lấy số cuối cùng trong ID
                const delay = (order - 1) * 2; // Giả sử mỗi nét cần 2 giây để hoàn tất
                path.style.animation = `drawStroke 2s ${delay}s forwards`;
            });
        }

        updateSVG(document.querySelector('svg'));


        // // Hàm để tải và chèn SVG
        // function loadAndInsertSVG() {
        //     fetch('http://127.0.0.1:8002/svg-file') // Đường dẫn đến API
        //         .then(response => response.text())
        //         .then(svgContent => {
        //             const container = document.getElementById('svg-container');
        //             container.innerHTML = svgContent; // Chèn SVG vào DOM

        //             const svgElement = container.querySelector('svg');
        //             if (svgElement) {
        //                 updateSVG(svgElement); // Cập nhật SVG
        //             } else {
        //                 console.error('SVG element was not found after insertion.');
        //             }
        //         })
        //         .catch(error => console.error('Error fetching SVG:', error));
        // }

        // loadAndInsertSVG();
    </script>


</body>

</html>
