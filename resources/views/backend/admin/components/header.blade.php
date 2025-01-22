<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />

    <title>Dashboard - Ecommerce</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/backendAssets/images/favicon.png') }}">
    <!-- Pignose Calender -->
    <link href="{{ asset('/backendAssets/plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ asset('/backendAssets/plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/backendAssets/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('/backendAssets/css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <style>
        a {
            text-decoration: none;
            color: black;
        }

        .alert-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .alert-popup {
            font-size: 14px;
            position: relative;
            max-width: 300px;
            animation: slideIn 0.5s forwards, stay 2s 0.5s forwards;
        }

        .alert-close {
            font-size: 14px;
            position: relative;
            max-width: 300px;
            animation: slideOut 0.5s forwards;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }

            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }
    </style>

    <div class="alert-container">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-popup" role="alert">
                    {{ $error }}
                    <button type="button" class="btn-close" aria-label="Close"
                        onclick="this.parentElement.style.display='none';"></button>
                </div>
            @endforeach
        @endif
        @if (session('success'))
            <div class="alert alert-success alert-popup" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" aria-label="Close"
                    onclick="this.parentElement.style.display='none';"></button>
            </div>
        @endif
    </div>

    <script>
        let alerts = document.querySelectorAll('.alert-popup');
        alerts.forEach((alert, index) => {
            setTimeout(() => {
                alert.classList.remove('alert-popup');
                alert.classList.add('alert-close');
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 500);
            }, 2000 + index * 500);
        });
    </script>

    <!-- Include Bootstrap 5 CSS (if not already included) -->
