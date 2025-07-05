<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comming Soon</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset(config('settings.favicon_first') ?? '') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset(config('settings.favicon_second') ?? '') }}">
    <style>
        body {
            background: #00091B;
            color: #fff;
        }


        @keyframes fadeIn {
            from {
                top: 20%;
                opacity: 0;
            }

            to {
                top: 100;
                opacity: 1;
            }

        }

        @-webkit-keyframes fadeIn {
            from {
                top: 20%;
                opacity: 0;
            }

            to {
                top: 100;
                opacity: 1;
            }

        }

        .wrapper {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            animation: fadeIn 1000ms ease;
            -webkit-animation: fadeIn 1000ms ease;

        }

        h1 {
            font-size: 50px;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 0;
            line-height: 1;
            font-weight: 700;
        }

        .login-to-dashboard {
            color: white;
            font-size: 20px;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            background: #0a3ea6;
            padding: 10px 15px;
            border-radius: 4px;
        }
        .dot {
            color: #4FEBFE;
        }

        p {
            text-align: center;
            margin: 18px;
            font-family: 'Muli', sans-serif;
            font-weight: normal;

        }

        .icons {
            text-align: center;
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .icons i {
            color: #fff;
            background: black;
            height: 15px;
            width: 15px;
            padding: 14px;
            margin: 0 10px;
            border-radius: 50px;
            border: 2px solid #fff;
            transition: all 200ms ease;
            text-decoration: none;
            position: relative;
            font-size: 25px;
            display: ;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h1>Coming Soon<span class="dot">.</span></h1>
        <div class="icons">
            <a title="Facebook" href="{{ config('settings.facebookurl') }}"><i class="fa-brands fa-facebook"></i></a>
            <a title="Instagram" href="{{ config('settings.instagramurl') }}"><i
                    class="fa-brands fa-square-instagram"></i></a>
            <a title="Youtube" href="{{ config('settings.youtubeurl') }}"><i class="fa-brands fa-youtube"></i></a>
        </div>
        <div class="icons">
            <a class="login-to-dashboard" title="Login" href="{{ route('login') }}">Login To Dashboard</a>
        </div>
    </div>

</body>

</html>
