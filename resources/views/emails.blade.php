
Your Orders {{ $details["username"] }}

@for ($i = 0; $i < count($details["menu_name"]); $i++)
    <div style="width: 100%;">
        <h4 style="margin: 0.5rem 0;">{{ $details["menu_count"][$i] }} x {{ $details["menu_name"][$i] }}</h4>
        <span>Rp.{{ $details["menu_price"][$i] }}</span>
    </div>
    <br />
@endfor

Price Rp.{{ $details["price"] }}
<br>
Tax Fee Rp.{{ $details["tax_fee"] }}
<br>
Total Payment Rp.{{ $details["total_payment"] }}