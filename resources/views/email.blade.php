<!DOCTYPE html>
<html>

<head>
    <title>Landing Page</title>
    <style type="text/css">
        body {
            background: #F8F8F8;
            font-family: 'Open Sans', sans-serif;
        }

        h1 {
            font-size: 28px;
            font-weight: bold;
            color: #3F3F3F;
            text-align: center;
            padding-top: 40px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 22px;
            font-weight: normal;
            color: #3F3F3F;
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            width: 800px;
            margin: 0 auto;
            padding: 0 20px;
            text-align: center;
        }

        .content img {
            margin-bottom: 20px;
        }

        .content p {
            font-size: 16px;
            color: #3F3F3F;
            text-align: center;
            line-height: 24px;
        }

        .button {
            display: block;
            background: #FFCF00;
            border: none;
            color: #3F3F3F;
            font-size: 18px;
            font-weight: bold;
            padding: 10px 0;
            width: 250px;
            margin: 0 auto;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <h1>Dear {{ $post['name'] }} </h1>
    <div class="content">
        <h2>Terima kasih telah berkunjung</h2>
        <p>Berikut adalah link photo anda yang kami kirimkan melalui email <br />
            Silahkan klik tombol di bawah ini</p>
        @foreach ($post['img'] as $index=>$img)
        <a href="{{ (asset('storage/app/public/images/list-contacts/'. $img['code']. '/' .$img['img_data'])) }}" class="button">FOTO {{ ++$index }} Klik Disini</a><br>
        <!--<a href="{{ (asset($post['img_data'])) }}" class="button">Klik Disini</a>-->
        @endforeach
    </div>
</body>
</html>