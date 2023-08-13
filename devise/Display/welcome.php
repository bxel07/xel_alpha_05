<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Xel</title>
    <link rel="stylesheet" href="<?= asset('/css/main.css');?>" />
    <link rel="icon" href="<?=asset('/tempSTR/favicon.png');?>" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
</head>
<body class="main">
    <section id="hero" class="d-flex align-items-center">
        <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-9 text-center">
                    <img src="<?=asset('/tempSTR/logo.png');?>" alt="xel_framework" id="hero-logo" />
                    <h2>Satu untuk semua!</h2>
                </div>
            </div>

            <div class="row icon-boxes">
                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in"
                    data-aos-delay="200">
                    <div class="icon-box">
                        <div class="icon"><i class="ri-stack-line"></i></div>
                        <h4 class="title"><a href="">Stone Gem</a></h4>
                        <p class="description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam, odio.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in"
                    data-aos-delay="300">
                    <div class="icon-box">
                        <div class="icon"><i class="ri-palette-line"></i></div>
                        <h4 class="title"><a href="">Xgen Query</a></h4>
                        <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem,
                            dignissimos.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in"
                    data-aos-delay="400">
                    <div class="icon-box">
                        <div class="icon"><i class="ri-command-line"></i></div>
                        <h4 class="title"><a href="">3 Layers Security Data</a></h4>
                        <p class="description">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis,
                            odit?</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in"
                    data-aos-delay="500">
                    <div class="icon-box">
                        <div class="icon"><i class="ri-fingerprint-line"></i></div>
                        <h4 class="title"><a href="">SHA256 Encryption</a></h4>
                        <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique,
                            inventore.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="footer text-end">
            <p>Xel vAlpha0.4 (PHP v8.1.4)</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>