<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <style>
        .p-saleEmail {
            padding: 16px;
        }

        .p-saleEmail__title {
            margin-top: 32px;
        }

        .p-saleEmail__contents {
            margin-top: 40px;
        }

        .p-saleEmail__footer {
            margin-top: 40px;
        }

        .p-saleEmail__link {
            font-size: 14px;
        }
    </style>
    <div class="p-saleEmail">
        <p>本メールは送信専用です。</p>
        <div class="p-saleEmail__title">
        <p>{{ $order->ideas->user->name }} 様</p>
        </div>
        <p>Inspiration をご利用いただきありがとうございます。</p>
        <p>出品中の商品が購入されましたのでご連絡差し上げます。</p>
        <div class="p-saleEmail__contents">
            <p>◻️ 購入された商品の情報</p>
            商品名 : {{ $order->ideas->title }}<br>
            商品説明 : {{ $order->ideas->description }}<br>
            購入者 : {{ $order->users->name }}<br>
            <span class="p-saleEmail__link">(購入された商品は <a href="{{ route('ideas.show',$order->ideas->id) }}">こちら</a>)</span><br>
            購入金額 : {{ number_format($order->ideas->price)}}<br>
            購入日時 : {{ $order->created_at }}<br>
        </div>
        <div class="p-saleEmail__footer">
            ==============================<br>
            Inspiration カスタマーセンター<br>
            HP: <a href="">https://</a><br>
            MAIL: <a href=""></a><br>
            ==============================<br>
        </div>
    </div>
</body>

</html>