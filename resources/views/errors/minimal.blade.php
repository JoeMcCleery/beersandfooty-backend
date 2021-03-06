<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .column {
                flex-direction: column;
            }

            .row {
                flex-direction: row;
            }

            .position-ref {
                position: relative;
            }

            .code {
                border-right: 2px solid;
                font-size: 26px;
                padding: 0 15px 0 15px;
                text-align: center;
            }

            .message {
                font-size: 18px;
                text-align: center;
            }

            .padding {
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center column position-ref full-height">
            <div class="flex-center column padding">
                <h1>Beers and Footy API</h1>
                <img src="/images/beersandfooty_logo_01.png" height="250px">
            </div>
            <div class="flex-center row">
                <div class="code">
                    @yield('code')
                </div>

                <div class="message padding">
                    @yield('message')
                </div>
            </div>
        </div>
    </body>
</html>
