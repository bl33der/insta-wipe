<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $this->Url->build('/css/custom.css') ?>" rel="stylesheet">
    <style>
       
        h2{
            color: #4B3F39;
        }
        .error-container {
            max-width: 600px;
            margin: 80px auto;
            padding: 40px;
            background: #FAF8F4;
            border-radius: 16px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        }
        .error-code {
            font-size: 6rem;
            font-weight: bold;
            color: #4B3F39;
        }
        .btn-home {
            border-radius: 50px;
            padding: 12px 30px;
            font-size: 1.1rem;
        }
        
    </style>
</head>
<body>

<div class="container">
    <div class="error-container text-center">
        <div class="error-code">500</div>
        <h2 class="mb-3">Server Error</h2>
        <p class="text-muted mb-4">Sorry, something went wrong. Please try again later.</p>
        <a href="<?= $this->Url->build('/') ?>" class="btn btn-primary btn-home">Return to Homepage</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
