<!doctype html>
<html lang="bn">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title><?= !empty($title) ? $title . ' - ' . site_config("site_title", "author") : site_config("site_title", "author") ?></title>
    <meta name="description" content="<?= site_config('site_description', 'Site desc') ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700&display=swap" rel="stylesheet">
    <style>
        :root{
            --c1: #0cbafc; /* cyan */
            --c2: #fe0034; /* red */
            --bg-dark: #0b0b0b;
            --card-bg: rgba(255,255,255,0.04);
        }
        *{box-sizing:border-box}
        html,body{height:100%}
        body{
            margin:0;
            font-family: 'Montserrat', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            color:#ffffff;
            background: radial-gradient( circle at 10% 10%, rgba(12,186,252,0.12), transparent 8%),
                        radial-gradient( circle at 90% 80%, rgba(254,0,52,0.08), transparent 10%),
                        linear-gradient(135deg, rgba(12,186,252,0.15) 0%, rgba(254,0,52,0.12) 50%, rgba(12,186,252,0.06) 100%),
                        var(--bg-dark);
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:32px;
        }

        .card{
            width:100%;
            max-width:980px;
            background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.02));
            border: 1px solid rgba(255,255,255,0.04);
            padding:40px;
            border-radius:18px;
            box-shadow: 0 10px 40px rgba(2,6,23,0.6);
            display:grid;
            grid-template-columns: 1fr 380px;
            gap:36px;
            align-items:center;
        }

        @media (max-width:900px){
            .card{grid-template-columns:1fr; padding:28px;}
        }

        .left{
            padding-right:8px;
        }

        .eyebrow{
            display:inline-block;
            font-weight:700;
            font-size:13px;
            letter-spacing:0.06em;
            text-transform:uppercase;
            background: linear-gradient(90deg, var(--c1), var(--c2));
            -webkit-background-clip:text;
            background-clip:text;
            color:transparent;
        }

        h1{
            margin:6px 0 12px 0;
            font-size:58px;
            line-height:1;
            letter-spacing:-1px;
            background: linear-gradient(90deg, var(--c2), var(--c1));
            -webkit-background-clip:text;
            color:transparent;
            text-shadow: 0 6px 30px rgba(12,186,252,0.06);
        }

        p.lead{
            margin:0 0 18px 0;
            color:rgba(255,255,255,0.85);
            font-size:16px;
            max-width:62ch;
        }

        .actions{
            display:flex;
            gap:12px;
            flex-wrap:wrap;
            margin-top:8px;
        }

        .btn{
            text-decoration:none;
            padding:12px 18px;
            border-radius:10px;
            font-weight:600;
            display:inline-flex;
            align-items:center;
            gap:10px;
            box-shadow: 0 6px 18px rgba(2,6,23,0.5);
        }

        .btn-primary{
            background: linear-gradient(90deg, var(--c1), var(--c2));
            color:#0b0b0b;
            border: none;
        }

        .btn-ghost{
            background: transparent;
            color: rgba(255,255,255,0.9);
            border: 1px solid rgba(255,255,255,0.06);
            backdrop-filter: blur(6px);
        }

        /* Right panel: graphic */
        .right{
            display:flex;
            align-items:center;
            justify-content:center;
            position:relative;
            min-height:180px;
        }

        .orb{
            width:220px;
            height:220px;
            border-radius:50%;
            background: conic-gradient(from 180deg at 50% 50%, var(--c1), var(--c2), var(--c1));
            filter: blur(18px) saturate(1.1);
            transform: rotate(8deg) translateZ(0);
            box-shadow: 0 24px 60px rgba(12,186,252,0.12), inset 0 -6px 30px rgba(0,0,0,0.25);
        }

        .orb-stroke{
            position:absolute;
            width:260px;
            height:260px;
            border-radius:50%;
            border: 1px solid rgba(255,255,255,0.04);
            display:inline-block;
            transform: rotate(-10deg);
        }

        .code{
            margin-top:18px;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, "Roboto Mono", monospace;
            font-size:13px;
            color: rgba(255,255,255,0.65);
            background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(0,0,0,0.02));
            padding:10px 12px;
            border-radius:8px;
            display:inline-block;
        }

        footer{
            margin-top:18px;
            display:flex;
            gap:12px;
            align-items:center;
            justify-content:space-between;
            color:rgba(255,255,255,0.55);
            font-size:13px;
            width:100%;
        }

        .small{
            color:rgba(255,255,255,0.45);
            font-size:13px;
        }

        /* subtle float animation for orb */
        @keyframes floaty {
            0% { transform: translateY(0) rotate(-8deg); }
            50% { transform: translateY(-10px) rotate(-6deg); }
            100% { transform: translateY(0) rotate(-8deg); }
        }
        .orb, .orb-stroke { animation: floaty 6s ease-in-out infinite; }

        a.visit{
            color:inherit;
            text-decoration:underline;
        }
    </style>
</head>

<body>
    <main class="card" role="main" aria-labelledby="title">
        <section class="left" aria-hidden="false">
            <div class="eyebrow">দুর্ভাগ্যবশত</div>
            <h1 id="title">পৃষ্ঠা পাওয়া যায়নি</h1>
            <p class="lead">আপনি যে লিংকে যেতে চেয়েছিলেন তা আর পাওয়া যায় না — হয় হয়ত মুছে ফেলা হয়েছে, নাম বদল করা হয়েছে, অথবা সাময়িকভাবে অনুপলব্ধ। নিচের অপশনগুলো সাহায্য করতে পারে।</p>

            <div class="actions" role="group" aria-label="Actions">
                <a class="btn btn-primary" href="<?= base_url() ?>" title="হোমপেজে ফিরুন">হোমপেজে ফিরুন</a>
                <a class="btn btn-ghost" href="<?= base_url('contact') ?>" title="আমাদেরকে জানান">সমস্যা জানাও</a>
            </div>

            <div class="code" aria-hidden="true">Error code: <strong>404</strong> · <?= date('Y') ?></div>

            <footer>
                <div class="small">© <?= "" ?> <?= site_config("site_name", "My Site") ?></div>
                <div class="small">Need help? <a class="visit" href="<?= base_url('help') ?>">Support</a></div>
            </footer>
        </section>

        <aside class="right" aria-hidden="true">
            <div class="orb-stroke" aria-hidden="true"></div>
            <div class="orb" aria-hidden="true"></div>
        </aside>
    </main>
</body>

</html>
