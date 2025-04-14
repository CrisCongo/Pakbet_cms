<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pakbet CMS Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #FDF9EE;
            color: #333;
        }

        .navbar {
            background-color: #FF0000;
        }

        .card {
            background-color: #FCF8EC;
            border: 1px solid #2d3e50;
            transition: transform 0.3s ease-in-out, box-shadow 0.5s ease-in-out;
        }

        .card-body {
            color: #333;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            color: #2d3e50;
        }

        .btn-primary {
            background-color: #FF0000;
            border: none;
        }

        .navbar-brand, .btn {
            color: #FFFFFF; /* White text for navbar and buttons */
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #FFFFFF; /* White text for navbar links */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand mb-0 h1" href="#">Pakbet CMS</a>
        <div class="d-flex">
            <a class="btn btn-dark me-2" href="#">Profile</a>
            <a class="btn btn-dark" href="#">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">

        <div class="col-sm-12 col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-edit fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Edit Blog Post</h5>
                    <p class="card-text">Manage and edit your blog posts with ease.</p>
                    <a href="{{ route('blogs.index') }}"  class="btn btn-primary">Go to Blog</a>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-question-circle fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">FAQ</h5>
                    <p class="card-text">Update and manage your FAQs.</p>
                    <a href="#" class="btn btn-primary">Go to FAQ</a>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-book fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Prosper Guide</h5>
                    <p class="card-text">View and edit the Prosper Guide content.</p>
                    <a href="#" class="btn btn-primary">Go to Guide</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
