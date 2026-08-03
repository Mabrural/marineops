<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#0b3b60">
    <title>Sign in · MarineOps</title>
    <link rel="icon" href="{{ asset('assets/img/marineops/marineops-icon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fonts.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/marineops.css') }}">
    <style>
        .login-page { min-height:100vh; display:grid; place-items:center; padding:24px; background:radial-gradient(circle at top right,#d8effa 0,transparent 35%),#f6f8fa; }
        .login-card { width:min(100%,430px); padding:32px; border:1px solid #e4ebf0; border-radius:20px; background:#fff; box-shadow:0 24px 60px rgba(11,59,96,.12); }
        .login-logo { text-align:center; margin-bottom:22px; }.login-logo img { width:180px; max-width:80%; }.login-subtitle { color:#6d7f8d; text-align:center; margin-bottom:28px; }
        .input-icon { position:relative; }.input-icon-addon { position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#6d7f8d; z-index:2; }.input-icon .form-control { padding-left:40px; }
        .btn-login { width:100%; min-height:44px; }
        @media (max-width:575.98px) { .login-page { padding:16px; }.login-card { padding:24px 20px; border-radius:16px; } }
    </style>
</head>
