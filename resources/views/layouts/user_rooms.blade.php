<!DOCTYPE html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf=token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body>
<livewire:lobby/>
@include('create-room')

@livewireScripts
</body>
</html>
