<!DOCTYPE html>
<html>
    <head>
        <title>get Pusher</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <script src="https://js.pusher.com/4.0/pusher.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <style>
            html, body {
                height: 100%;
            }
            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }
            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h1>Laravel Event Broadcasting Demo</h1>
                    <h3 id="message"></h3>
                    <h3 id="userData"></h3>
                </div>
            </div>
        </div>
    </body>
    <script>
        setInterval(() => {
            $.ajax({
                url: '/get/user/info',
                type: 'get',
                success: (data) => {
                    document.getElementById('userData').innerHTML = data.name;
                }
            });
        }, 1000);
    </script>
    <script>
        Pusher.logToConsole = true;
        const pusher = new Pusher('{{env('PUSHER_KEY', 'your-key')}}', {
            cluster: 'ap1',
            encrypted: true
        });
        const channel = pusher.subscribe('laravel-tutorial-event-channel-{{$memberId}}');
        channel.bind('App\\Events\\SendMessage', function(data) {
            $('#message').append('<p>'+data.username + ': '+ data.message + '</p>');
        });
    </script>
</html>
