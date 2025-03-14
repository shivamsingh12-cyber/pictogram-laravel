
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{url('/')}}/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/')}}/bootstrap/icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{url('/')}}/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('/')}}/css/style.css">
    <title>{{$page_title}}</title>
    <style>
        #notificationDot {
    min-width: 8px;
    min-height: 8px;
    font-size: 0.6rem;
    box-shadow: 0 0 0 1px rgba(255,255,255,.3);
}
.start-100 {
    left: 70% !important;
}
    </style>
</head>

<body>