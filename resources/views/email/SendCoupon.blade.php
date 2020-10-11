<!DOCTYPE html>
<html>
<head>
    <title>Market.yassir.io</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>
    <p>{{ $details['picture'] }}</p>

    <img src="{{ $message->embed($details['picture']) }}" alt="" />
    <img src="{{ $message->embed("data:image/png;base64,".DNS2D::getBarcodePNG($details['barcode'], 'QRCODE') ) }}" alt="" />
   
    <p>Thank you</p>
</body>
</html>