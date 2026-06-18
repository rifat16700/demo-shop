<!doctype html>
<html lang="en">

<head>
    <title><?= !empty($title) ? $title . '-' . get_option("site_title", "author") : get_option("site_title", "author") ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="author" content="<?= get_option('site_description', 'author') ?>">
    <meta name="description" content="<?= get_option('site_description', 'Site desc') ?>">
    <meta name="theme-color" content="#0f0f0f">
    <meta name="keywords" content="<?= get_option('site_keywords', "keywords") ?>">
    <link href="https://fonts.googleapis.com/css?family=Share+Tech+Mono&display=swap" rel="stylesheet">

    <style>
        html, body {
            margin:0;
            padding:0;
            height:100%;
            font-family: 'Share Tech Mono', monospace;
            overflow: hidden;
        }

        body {
            background: linear-gradient(135deg, #0a1f44, #07182e);
            position: relative;
            color: #00ffe0;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(0, 255, 224, 0.7);
            border-radius: 50%;
            animation: float 10s linear infinite;
        }

        @keyframes float {
            0% { transform: translateY(0) translateX(0); opacity: 0.2; }
            50% { opacity: 1; }
            100% { transform: translateY(-1000px) translateX(50px); opacity: 0.2; }
        }

        .container {
            position: relative;
            z-index: 1;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        h1 {
            font-size: 70px;
            color: #00ffe0;
            text-shadow: 0 0 15px #00ffe0, 0 0 30px #00ffe0;
            letter-spacing: 3px;
            overflow: hidden;
        }

        h2 { font-size: 28px; margin-bottom: 15px; }
        p { font-size: 18px; margin-bottom: 25px; max-width: 600px; line-height: 1.5; color: #cceee0; }
        a.button {
            display: inline-block;
            padding: 12px 25px;
            font-size: 18px;
            color: black;
            background-color: #00ffe0;
            border: 2px solid #00ffe0;
            border-radius: 5px;
            text-decoration: none;
            transition: 0.3s;
        }
        a.button:hover { background-color: transparent; color: #00ffe0; }

        @media(max-width:600px){
            h1{font-size:50px;}
            h2{font-size:22px;}
            p{font-size:16px;}
            a.button{font-size:16px; padding:10px 20px;}
        }
    </style>
</head>

<body>
    <?php
        // Generate particles
        for($i=0;$i<80;$i++){
            echo '<div class="particle" style="top:'.rand(0,100).'%; left:'.rand(0,100).'%; width:'.rand(2,6).'px; height:'.rand(2,6).'px;"></div>';
        }
    ?>
    <div class="container">
        <h1 id="runningText"></h1>
        <h2>ওয়েবসাইটটি সক্রিয় রয়েছে</h2>
        <p>আপনার টেনশনের কোন কারণ নেই। ওয়েবসাইট স্বাভাবিকভাবে চলমান। নিচের বাটন থেকে অফিসিয়াল ওয়েবসাইটে যেতে পারেন।</p>
        <a class="button" href="https://Ekhonidigital.com" target="_blank">Go To Official Website</a>
    </div>

    <script>
        // ===== Dynamic Running Text =====
        const text = "Running Normally";
        const runningElement = document.getElementById("runningText");
        let displayText = "";
        let index = 0;

        function animateText() {
            if(index < text.length){
                displayText += text[index];
                runningElement.innerHTML = displayText;
                index++;
            } else {
                // subtle flicker effect
                let flicker = text.split('').map(c => Math.random() > 0.9 ? '' : c).join('');
                runningElement.innerHTML = flicker;
            }
        }
        setInterval(animateText, 150);
    </script>
</body>
</html>
