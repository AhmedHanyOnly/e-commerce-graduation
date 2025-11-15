<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Main Css File -->
    <link rel="stylesheet" href="main.css">
    <!-- Normalize Css File Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
    <!-- Bootstrap Css File Cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css">
    <!-- Google Fonts Cdn File -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <title>404</title>
    <style>
        :root {
            --blue: #67686e;
            --white: #fff;
            --grey: #7d7e85;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Cairo", sans-serif !important;
            color: var(--blue) !important;
            font-size: 1em;
            height: 100vh;
        }

        ul {
            list-style-type: none;
            -webkit-padding-start: 35px;
            padding-inline-start: 35px;
        }

        a {
            text-decoration: none;
        }

        svg {
            width: 100%;
            visibility: hidden;
        }

        h1 {
            font-size: 60px !important;
            margin: 0px !important;
            font-weight: bold !important;
        }


        .btn-back {
            position: relative;
            background: transparent;
            display: block;
            width: fit-content;
            z-index: 1;
            overflow: hidden;
            padding: 8px 40px;
            border-radius: 30px;
            cursor: pointer;
            font-size: 15px;
            transition: 0.3s ease;
            font-weight: bold;
            margin: 5px 0px;
            border: 3px solid var(--grey);
            color: var(--blue);
        }

        .btn-back:before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 0%;
            height: 100%;
            background: var(--grey);
            z-index: -1;
            transition: 0.2s ease;
        }

        .btn-back:hover {
            color: var(--white);
            background: var(--grey);
            transition: 0.2s ease;
        }

        .btn-back:hover:before {
            width: 100%;
        }
    </style>
</head>

<body>
    <main>
        <div class="container">
            <div class="row g-4">
                <div class="col-md-12">
                    <h1>404</h1>
                    <h2>هذه الصفحة غير متوفرة</h2>
                    <p>
                        الصفحة التي تبحث عنها غير موجودة
                        ولكن يمكنك النقر فوق الزر أدناه
                        للعودة إلى الصفحة الرئيسية
                    </p>
                    <a href="{{ url('/') }}" class="btn-back">الصفحة الرئيسية</a>
                </div>
                <!-- <div class="col-md-6">
                    <img src="{{ asset('img/heart.gif') }}" class="w-50 h-auto mx-auto d-block" alt="">
                </div> -->
            </div>
        </div>
    </main>
</body>

</html>
