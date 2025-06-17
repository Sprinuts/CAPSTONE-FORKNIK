<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We'll Be Back Soon</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        body {
            margin: 0;
            background: #f4f6f8;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #2c3e50;
            text-align: center;
        }
        .container {
            padding: 2rem;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            max-width: 480px;
            width: 100%;
        }
        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        p {
            color: #555;
            margin-bottom: 2rem;
        }
        .gear {
            font-size: 3rem;
            color: #3498db;
            animation: spin 4s linear infinite;
        }
        @keyframes spin {
            0%   { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .footer {
            font-size: 0.9rem;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="gear">⚙️</div>
        <h1>We'll Be Back Soon</h1>
        <p>Sorry for the inconvenience. We're performing some maintenance at the moment.<br>
        We’ll be back online shortly!</p>
        <div class="footer">— Your Team</div>
    </div>
</body>
</html>