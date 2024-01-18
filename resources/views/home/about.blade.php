<!DOCTYPE html>
<html lang="ja">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
        }

        html {
            box-sizing: border-box;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .column {
            float: left;
            width: 33.3%;
            margin-bottom: 16px;
            padding: 0 8px;
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin: 8px;
        }

        .about-section {
            padding: 50px;
            text-align: center;
            background-color: #474e5d;
            color: white;
        }

        .container {
            padding: 0 16px;
        }

        .container::after,
        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        .title {
            color: grey;
        }

        .button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
        }

        .button:hover {
            background-color: #555;
        }

        @media screen and (max-width: 650px) {
            .column {
                width: 100%;
                display: block;
            }
        }
    </style>
</head>

<body>

    <div class="about-section">
        <h1> 3TPan について</h1>
        <p>「3TPan」は、日本語学習に苦労している方々をサポートするために開発されました。</p>
        <p>このアプリは、リスニング、スピーキング、リーディング、ライティング、語彙の学習、そしてテストのためのさまざまな機能を備えています。</p>
        「3TPan」は、日本語のスキル向上をサポートするために設計された総合的なプラットフォームです。リスニングモードでは、実際の会話や日本のメディア<br>
        からの音声を使って、聞き取り能力を向上させることができます。スピーキングモードでは、日本語の発音を練習し、自分の発音を録音してフィードバックを<br>
        得ることができます。また、リーディングやライティングモードでは、様々な文章や課題を通じて読解力や文章表現力を向上させます。語彙学習機能は、<br>
        日常会話やビジネスで使われる実用的な表現を学ぶのに役立ちます。定期的なテストとクイズもあり、学習の進捗を追跡し、強化することができます。<br>
        「3TPan」は使いやすいインターフェースを提供し、日本語学習のプロセスを楽しく、効果的にすることを目指しています。ぜひ、このアプリを通じて日本語のスキルを向上させ、自信を持ってコミュニケーション能力を高めてください。
    </div>

    <h2 style="text-align:center">Our Team</h2>
    <div class="row">
        <div class="column">
            <div class="card">
                <img src="{{ asset('images/thuc.png') }}" alt="John" style="width:100%;height:520px;">
                <div class="container">
                    <h2>TA VAN THUC</h2>
                    <p class="title">CEO & Art Director</p>
                    <p>ECCコンピュータ専門学校</p>
                    <p>IT開発研究コース</p>
                    <p>mike@example.com</p>
                    <p>
                        <a href="https://www.instagram.com/hotaru11022/" target="_blank">
                            <button class="button" type="button">Contact</button>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="card">
                <img src="{{ asset('images/thang.jpg') }}" alt="John" style="width:100%">
                <div class="container">
                    <h2>DO VAN THANG</h2>
                    <p class="title">Backend Developer & Database Administrator</p>
                    <p>ECCコンピュータ専門学校</p>
                    <p>IT開発研究コース</p>
                    <p>dvthang2906@gmail.com</p>
                    <p>
                        <a href="https://www.facebook.com/Thangchik2906" target="_blank">
                            <button class="button" type="button">Contact</button>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="card">
                <img src="{{ asset('images/tuan.jpg') }}" alt="John" style="width:100%">
                <div class="container">
                    <h2>TRAN ANH TUAN</h2>
                    <p class="title">Designer & Data Analyst</p>
                    <p>ECCコンピュータ専門学校</p>
                    <p>IT開発研究コース</p>
                    <p>liontuan1102@gmail.com</p>
                    <p>
                        <a href="https://www.instagram.com/hemosuu/" target="_blank">
                            <button class="button" type="button">Contact</button>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
