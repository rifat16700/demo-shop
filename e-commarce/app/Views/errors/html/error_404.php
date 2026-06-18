<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= lang('Errors.pageNotFound') ?></title>

    <style>
        :root{
            --c1: #0cbafc;
            --c2: #fe0034;
            --text-light: rgba(255,255,255,0.85);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            background: linear-gradient(135deg, var(--c1), var(--c2));
            color: var(--text-light);
        }

        .wrap {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(10px);
            padding: 3rem 2.5rem;
            width: 90%;
            max-width: 700px;
            border-radius: 1rem;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.15);
            box-shadow: 0 15px 45px rgba(0,0,0,0.25);
        }

        h1 {
            font-size: 6rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(90deg, #ffffff, #e0e0e0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -2px;
        }

        p {
            font-size: 1.2rem;
            margin-top: 1rem;
            color: var(--text-light);
            line-height: 1.6;
        }

        a {
            display: inline-block;
            margin-top: 2rem;
            padding: 0.8rem 1.6rem;
            background: #fff;
            color: #333;
            font-weight: 600;
            border-radius: 0.5rem;
            text-decoration: none;
            transition: 0.2s;
        }

        a:hover {
            background: #f0f0f0;
        }

    </style>
</head>

<body>
    <div class="wrap">
        <h1>404</h1>

        <p>
            <?php if (ENVIRONMENT !== 'production') : ?>
                <?= nl2br(esc($message)) ?>
            <?php else : ?>
                <?= lang('Errors.sorryCannotFind') ?>
            <?php endif; ?>
        </p>

        <a href="<?= base_url() ?>">Go to Homepage</a>
    </div>
</body>
</html>
