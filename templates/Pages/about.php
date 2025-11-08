<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #ffffff;
            color: #333;
        }
        .section {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
            max-width: 1200px;
            margin: 0 auto;
            gap: 40px;
        }
        .text-block {
            flex: 1 1 400px;
            max-width: 600px;
        }
        .text-block h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #1a1a1a;
        }
        .text-block p {
            font-size: 1.125rem;
            line-height: 1.8;
            color: #555;
        }
        .image-block {
            flex: 1 1 300px;
            max-width: 500px;
        }
        .image-block img {
            width: 100%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>
<div class="section">
    <div class="text-block">
        <h2>Our Mission</h2>
        <p>
            <?= $this->ContentBlock->html('about-message'); ?>
        </p>
    </div>
    <div class="image-block">
        <?= $this->ContentBlock->image('business-image', ['alt' => 'Our team', 'class' => 'img-fluid']) ?>
    </div>
</div>
</body>

</html>
