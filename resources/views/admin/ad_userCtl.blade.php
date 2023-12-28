<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ 'css/admin.css' }}">
    <link rel="stylesheet" href="{{'css/menu.css'}}">
    <title>User CTL</title>
</head>

<body>
    <div>
        <h1 class="ad">Admin: <span></span></h1>
        <h1 class="ad">Login at:<span></span></h1>
    </div>
    <table class="my_table">
        <tr>
            <th>User ID</th>
            <th>LogIn ID</th>
            <th>User Name</th>
            <th>Address</th>
            <th>Tel</th>
            <th>Email</th>
            <th>Rank</th>
            <th>Option</th>
        </tr>
        <tr>
            <td>00001</td>
            <td>Hemosu97</td>
            <td>TRAN ANH TUAN</td>
            <td>大阪府大阪市北区中崎西2丁目6-17</td>
            <td>070 0000 0000</td>
            <td>hemosu-97@gmail.com</td>
            <td>Bronze</td>
            <td>
                <button class="bt_user1">Update</button>
                <button class="bt_user2">Delete</button>
            </td>
        </tr>
    </table>
    <div class="nomal">
        <a href="#" class="bt_nav" title="ユーザー追加"><span>ADDITION</span></a>
    </div>
</body>


</html>
