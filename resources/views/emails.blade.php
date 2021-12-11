<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./styles.css" />
    <title>Food Order</title>
</head>
<style>
    * {
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    body {
        margin: 0;
        padding: 0;
        background-color: #222423;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        font-family: "Poppin";
    }

    .card {
        width: auto;
        background-color: #fff5eb;
        border: solid 1px gray;
        border-radius: 1rem;
        padding: 2rem;
        margin: 0 1rem;
    }

    .container {
        display: flex;
    }

    .orders {
        margin-right: 1.5rem;
    }

    .menu {
        background: #fff;
        border: solid 1px gray;
        border-radius: 1rem;
        width: 100%;
        padding: 0.5rem;
        margin-bottom: 1rem;
        display: flex;
    }

    .menu img {
        border-radius: 0.5rem;
        height: 64px;
        margin-right: 0.5rem;
    }

    .menu div {
        width: 100%;
    }

    .menu h4 {
        margin: 0.5rem 0;
    }

    .payment-summary h1 {
        margin-top: 0;
        margin-bottom: 2.5rem;
    }

    .payment-summary div {
        width: 100%;
        display: flex;
        justify-content: space-between;
        font-size: larger;
        margin-bottom: 0.6rem;
    }

    .payment-summary p {
        color: gray;
    }

    @media only screen and (max-width: 768px) {
        .container {
            flex-direction: column;
        }

        .orders {
            width: 100%;
            border-bottom: 1px solid gray;
            padding-bottom: 1.5rem;
        }

        .payment-summary {
            margin-top: 1.5rem;
        }
    }

</style>

<body>
    <div>
        <h1 style="color: white; font-weight: bolder; text-align: center">
            Your Orders
        </h1>
        <div class="card">
            <div class="container">
                <div class="orders">
                    <div class="menu">
                        <img src="https://cdn0-production-images-kly.akamaized.net/tt5Xav7-Kp0oO2pB6G8Kgup01v4=/640x853/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/3594659/original/040089700_1633527349-ikhsan-baihaqi-pbc2wXbQYpI-unsplash.jpg"
                            alt="food" />

                        <div>
                            <h4>4 x Indomie Special</h4>
                            <span>Rp. 50.000</span>
                        </div>
                    </div>
                </div>

                <div class="payment-summary">
                    <h1>Payment Summary</h1>
                    <div>
                        <span>Price</span>
                        <span>Rp. 200.000</span>
                        {{-- Kirim price --}}
                    </div>
                    <div>
                        <span>Tax Fee (5%)</span>
                        <span className="text-danger">
                            Rp. 10.000
                            {{-- Kirim Tax --}}
                        </span>
                    </div>
                    <hr />
                    <div style="font-weight: bold;">
                        <span>Total Payment</span>
                        <span>Rp. 210.000</span>
                        {{-- kirim total payment --}}
                    </div>
                    <hr />
                    <p>
                        *Before proceed to payment make sure your oders are corect.
                    </p>
                </div>
            </div>
        </div>
</body>

</html>
