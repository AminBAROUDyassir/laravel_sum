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
    <img src="{{ $message->embed("data:image/png;base64,".DNS1D::getBarcodePNG($details['barcode'], 'C39' ,2,50) ) }}" alt="" />
   
    <p>Thank you</p>
</body>
</html>