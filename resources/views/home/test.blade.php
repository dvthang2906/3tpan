<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/test.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <title>Test Page</title>
    <style>
        .scrollable {
            max-height: 350px;
            /* Hoặc giá trị phù hợp với nhu cầu của bạn */
            overflow-y: auto;
            /* Cho phép thanh cuộn dọc nếu nội dung vượt quá max-height */
        }
    </style>
</head>

<body>
    @include('layouts.head')
    <div class="nav_head">
        <div class="nomal">
            <a href="#" class="bt_nav" title="辞書"><span>辞書</span></a>
            <a href="{{ route('flashcards') }}" class="bt_nav" title="フラッシュカード"><span>フラッシュカード</span></a>
            <a href="{{ route('test') }}" class="bt_nav" title="テストしてみよう！"><span>テスト</span></a>
        </div>
        <nav>
            <ul class="nav">
                <li class="nav-item"><a href="#"><span>話す</span></a></li>
                <li class="nav-item"><a href="#"><span>読む</span></a></li>
                <li class="nav-item"><a href="#"><span>聴く</span></a></li>
                <li class="nav-item"><a href="#"><span>書く</span></a></li>
            </ul>
        </nav>
    </div>
    <div class="contents">
        <ul class="nav_t">
            <li><a href="#">N1</a>
                <ul>
                    <li><a href="#" style="margin-left: 5px">Vocabulary</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">コード番号01</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号02</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号03</a></li>
                        </ul>
                    </li>
                    <li><a href="#" style="margin-left: 5px">Grammar</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">コード番号01</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号02</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号03</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#">N2</a>
                <ul>
                    <li><a href="#" style="margin-left: 5px">Vocabulary</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">コード番号01</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号02</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号03</a></li>
                        </ul>
                    </li>
                    <li><a href="#" style="margin-left: 5px">Grammar</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">コード番号01</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号02</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号03</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#">N3</a>
                <ul>
                    <li><a href="#" style="margin-left: 5px">Vocabulary</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">01</a></li>
                            <li><a href="#" style="margin-left: 5px">02</a></li>
                            <li><a href="#" style="margin-left: 5px">03</a></li>
                        </ul>
                    </li>
                    <li><a href="#" style="margin-left: 5px">Grammar</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">01</a></li>
                            <li><a href="#" style="margin-left: 5px">02</a></li>
                            <li><a href="#" style="margin-left: 5px">03</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a>N4</a>
                <ul>
                    <li><a style="margin-left: 5px">Kanji</a>
                        <ul>
                            <li><a style="margin-left: 5px">コード番号01</a></li>
                            <li><a style="margin-left: 5px">コード番号02</a></li>
                        </ul>
                    </li>
                    <li><a style="margin-left: 5px">Vocabulary</a>
                        <ul>
                            <li><a style="margin-left: 5px">コード番号01</a></li>
                            <li><a style="margin-left: 5px">コード番号02</a></li>
                        </ul>
                    </li>
                    <li><a style="margin-left: 5px">Grammar</a>
                        <ul>
                            <li><a style="margin-left: 5px">コード番号01</a></li>
                            <li><a style="margin-left: 5px">コード番号02</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#">N5</a>
                <ul>
                    <li><a href="#" style="margin-left: 5px">Vocabulary</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">コード番号01</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号02</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号03</a></li>
                        </ul>
                    </li>
                    <li><a href="#" style="margin-left: 5px">Grammar</a>
                        <ul>
                            <li><a href="#" style="margin-left: 5px">コード番号01</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号02</a></li>
                            <li><a href="#" style="margin-left: 5px">コード番号03</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="mogi">
        <header>
            <h1>日本語<span>AAA</span>模擬テスト</h1>
        </header>
        <h2>問題：___ は どう よみますか。４つから １つを えらびなさい。</h2>
        {{-- Nội dung câu hỏi và câu trả lời --}}
        <section class="kj_test scrollable" style="margin: 5px">
            @foreach ($test_mondai as $key => $mondai)
                <div class="question">
                    <p>問{{ $key + 1 }}：{{ $mondai->QUIZ }}</p>
                    <div class="kanji-box"><span class="kanji">今日</span>
                        <div class="ans">
                            <div class="answer">
                                <input type="radio" name="q1k1"><span></span>
                            </div>
                            <div class="answer">
                                <input type="radio" name="q1k1"><span></span>
                            </div>
                            <div class="answer">
                                <input type="radio" name="q1k1"><span></span>
                            </div>
                            <div class="answer">
                                <input type="radio" name="q1k1"><span></span>
                            </div>
                            <input type="text" class="answer_tf"><span></span>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>

        <!-- Thêm các phần khác như Vocabulary, Đọc Hiểu, Viết ở đây -->
    </div>
    <div class="check-result">
        <a href="#" class="bt_nav"><span>CHECK</span></a>
        <div class="result">得点：<span class="user_ans">10</span><span>/</span><span class="total">30</span></div>
    </div>

    <input type="checkbox" id="actionMenuButton" class="muti-ck" />
    <div class="actions-menu">
        <button class="btn btn--share">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="#ffffff" d="M21,11L14,4V8C7,9 4,14 3,19C5.5,15.5 9,13.9 14,13.9V18L21,11Z" />
            </svg>
        </button>
        <button class="btn btn--star">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="#ffffff"
                    d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" />
            </svg>
        </button>
        <button class="btn btn--comment">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="#ffffff"
                    d="M19,3A2,2 0 0,1 21,5V19C21,20.11 20.1,21 19,21H5A2,2 0 0,1 3,19V5A2,2 0 0,1 5,3H19M16.7,9.35C16.92,9.14 16.92,8.79 16.7,8.58L15.42,7.3C15.21,7.08 14.86,7.08 14.65,7.3L13.65,8.3L15.7,10.35L16.7,9.35M7,14.94V17H9.06L15.12,10.94L13.06,8.88L7,14.94Z" />
            </svg>
        </button>
        <label for="actionMenuButton" class="btn btn--large btn--menu" />
    </div>
</body>


<script>
    let hoverHistory = [];

    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('mouseover', function(event) {
            const levelText = this.innerText;
            if (['N1', 'N2', 'N3', 'N4', 'N5'].includes(levelText)) {
                hoverHistory = []; // Xóa mảng cũ
            }

            // Xác định nhóm các giá trị có thể thay thế lẫn nhau
            const replaceableGroups = [
                ['Kanji', 'Vocabulary', 'Grammar'],
                ['Vocabulary', 'Grammar'],
                ['コード番号01', 'コード番号02', 'コード番号03'] // Điều chỉnh tùy theo số lượng "Đề" bạn có
            ];

            // Tìm nhóm có chứa giá trị hiện tại
            let groupIndex = replaceableGroups.findIndex(group => group.includes(levelText));

            // Thay thế hoặc thêm giá trị mới
            if (groupIndex !== -1) {
                const replaceableGroup = replaceableGroups[groupIndex];
                let foundIndex = hoverHistory.findIndex(item => replaceableGroup.includes(item));

                // Xóa tất cả các "Đề" trước khi thêm mới nếu là "コード番号"
                if (replaceableGroup.some(item => item.startsWith('コード番号'))) {
                    hoverHistory = hoverHistory.filter(item => !replaceableGroup.includes(item));
                }


                // Thay thế hoặc thêm mới
                if (foundIndex !== -1) {
                    hoverHistory[foundIndex] = levelText; // Thay thế giá trị cũ
                } else {
                    hoverHistory.push(levelText); // Thêm mới nếu không tìm thấy
                }
            } else {
                hoverHistory.push(levelText); // Thêm các giá trị khác nếu không thuộc nhóm thay thế
            }
        });
    });


    // Xử lý sự kiện click
    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            if (this.innerText.includes('コード番号')) {
                console.log(hoverHistory);
                // Kiểm tra để đảm bảo hoverHistory có đủ phần tử
                if (hoverHistory.length === 3) {
                    let level = 'level=' + encodeURIComponent(hoverHistory[0]);
                    let category = 'category=' + encodeURIComponent(hoverHistory[1]);
                    let code = 'code=' + encodeURIComponent(hoverHistory[2]);

                    // Tạo chuỗi truy vấn
                    let queryString = level + '&' + category + '&' + code;

                    // Cập nhật URL
                    window.history.pushState({}, '', '?' + queryString);
                }
            }
        });
    });
</script>

</html>
