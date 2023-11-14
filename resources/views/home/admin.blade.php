<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ 'css/admin.css' }}">
    <title>A D M I N</title>
</head>

<body>
    <div>
        <h1 class="ad">Admin: <span></span></h1>
        <h1 class="ad">Login at:<span></span></h1>
    </div>
    <div class="cta_btn09">
        <a href="{{route('ad_userCtl')}}" class="cta_btn09-contact">
            ユーザー管理<br>
            <span class="copy_txt">登録・アクセス権へ</span>
        </a>
        <a href="{{route('ad_dataCtl')}}" class="cta_btn09-tel">
            データ管理<br>
            <span class="copy_txt">各データの登録・更新へ</span>
        </a>
    </div>
</body>

</html>
