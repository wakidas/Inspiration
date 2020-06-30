<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <style>
        .p-buyEmail {
            padding: 16px;
        }

        .p-buyEmail__title {
            margin-top: 32px;
        }

        .p-buyEmail__contents {
            margin-top: 40px;
        }

        .p-buyEmail__footer {
            margin-top: 40px;
        }

        .p-buyEmail__link {
            font-size: 14px;
        }
    </style>
    <div class="p-buyEmail">
        <p>本メールは送信専用です。</p>
        <div class="p-buyEmail__title">
        <p>{{ $review->users->name }} 様</p>
        </div>
        <p>Inspiration をご利用いただきありがとうございます。</p>
        <p>購入されたアイデアにレビューが投稿されました。</p>
        <div class="p-buyEmail__contents">
            <p>◻️ 投稿されたレビュー情報</p>
            投稿名 : {{ $review->users->name }}<br>
            評価 : {{ $review->rate }}<br>
            コメント : {{ $review->comment }}<br>
            <span class="p-buyEmail__link">(投稿されたレビューは <a href="{{ route('ideas.show',$review->ideas->id) }}">こちら</a>)</span><br>
            投稿日時 : {{ $review->created_at }}<br>
        </div>
        <div class="p-buyEmail__footer">
            ==============================<br>
            Inspiration カスタマーセンター<br>
            HP: <a href="">https://</a><br>
            MAIL: <a href=""></a><br>
            ==============================<br>
        </div>
    </div>
</body>

</html>