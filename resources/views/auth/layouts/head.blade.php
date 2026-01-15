<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>MarineOps</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="icon" href="{{ asset('assets/img/marineops/favicon-primary.svg') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ["{{ asset('assets/css/fonts.min.css') }}"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            overflow: hidden;
            background: linear-gradient(180deg,
                    #e6f4f8 0%,
                    /* sky + shallow sea */
                    #cfeaf2 30%,
                    /* light sea */
                    #9fd3e3 60%,
                    /* mid sea */
                    #5fa8c5 100%
                    /* deep sea */
                );
        }


        .login-page {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.08);
            background: #ffffff;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
        }

        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-logo img {
            margin-top: 1.0rem;
            max-width: 68%;
        }

        .login-subtitle {
            text-align: center;
            font-size: 13px;
            color: #6c757d;
            margin-bottom: 15px;
        }

        .form-control {
            height: 45px;
            border-radius: 6px;
        }

        .btn-login {
            height: 45px;
            border-radius: 6px;
            font-weight: 600;
            width: 100%;
        }

        .form-check-label {
            margin-left: 5px;
        }

        .btn-reset {
            height: 45px;
            border-radius: 6px;
            font-weight: 600;
            width: 100%;
        }
        
        @media (max-width: 576px) {
            .login-card {
                padding: 1.5rem;
                border-radius: 8px;
            }

            .login-logo img {
                margin-top: 1.0rem;
                height: 2.0rem;
            }
        }
    </style>
</head>