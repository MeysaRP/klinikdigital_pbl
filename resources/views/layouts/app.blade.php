<!DOCTYPE html>
<html>
<head>
    <title>Klinik Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #f5f7fa; }
        .sidebar {
            height: 100vh;
            background: #0d6efd;
            color: white;
            padding: 20px;
        }
        .sidebar a {
            color: white;
            display: block;
            margin: 10px 0;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: rgba(255,255,255,0.2);
            padding-left: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <h4>Klinik</h4>
            <a href="/dashboard_admin">Admin</a>
            <a href="/dashboard_dokter">Dokter</a>
        </div>

        <!-- Content -->
        <div class="col-md-10 p-4">
            @yield('content')
        </div>

    </div>
</div>

</body>
</html>