<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding-top: 15px;
        }
        .content {
            padding: 15px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block sidebar">
            <div class="text-center">
                <h2>Dashboard</h2>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Analytics
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Settings
                    </a>
                </li>
            </ul>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="content">
                <h2>Welcome to the Dashboard</h2>
                <p>This is a simple dashboard layout using HTML, CSS, and Bootstrap.</p>
                <form action="/logout" method="post">
                    <button type="submit">logout</button>
                </form>
            </div>
        </main>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
