<!DOCTYPE html>
<html lang="en" style="box-sizing: border-box; font-family: 'Poppins', sans-serif;">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
    <title>Food Order</title>
  </head>
  <body style="
    margin: 0;
    padding: 0;
    background-color: #222423;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    font-family: 'Poppin';">
      <div>
        <h1 style="color: white; font-weight: bolder; text-align: center">
          Your Orders
        </h1>
        <div style="
          width: auto;
          background-color: #fff5eb;
          border: solid 1px gray;
          border-radius: 1rem;
          padding: 2rem;
          margin: 0 1rem;"
        >
          <div style="display: flex;">
            <div style="margin-right: 3rem;">
              <div style="background: #fff;
              border: solid 1px gray;
              border-radius: 1rem;
              width: 100%;
              padding: 0.5rem;
              margin-bottom: 1rem;
              display: flex;">
                <img
                  src="https://cdn0-production-images-kly.akamaized.net/tt5Xav7-Kp0oO2pB6G8Kgup01v4=/640x853/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/3594659/original/040089700_1633527349-ikhsan-baihaqi-pbc2wXbQYpI-unsplash.jpg"
                  alt="food"
                  style="border-radius: 0.5rem;
                  height: 64px;
                  margin-right: 0.5rem;"
                />

                @foreach($details as $detail)
                    <div style='width: 100%;''>
                    <h4 style='margin: 0.5rem 0;''>
                        {{ $detail['menu_name'] }}
                    </h4>
                    <span>Rp. 50.000</span>
                    </div>
                @endforeach
       
              </div>
            </div>

            <div class="payment-summary">
              <h1 style="margin-top: 0;
              margin-bottom: 2.5rem;">Payment Summary</h1>
              <div style="width: 100%;
                display: flex;
                justify-content: space-between;
                font-size: larger;
                margin-bottom: 0.6rem;">
                <span>Price</span>
                <span>Rp. 200.000</span>
              </div>
              <div style="width: 100%;
                display: flex;
                justify-content: space-between;
                font-size: larger;
                margin-bottom: 0.6rem;">
                <span>Tax Fee (5%)</span>
                <span className="text-danger">
                  Rp. 10.000
                </span>
              </div>
              <hr />
              <div style="
                width: 100%;
                display: flex;
                justify-content: space-between;
                font-size: larger;
                margin-bottom: 0.6rem;
                font-weight: bold;">
                <span>Total Payment</span>
                <span>Rp. 210.000</span>
              </div>
              <hr  />
              <p style="color: gray;">
                *Before proceed to payment make sure your oders are corect.
              </p>
            </div>
      </div>
    </div>
  </body>
</html>