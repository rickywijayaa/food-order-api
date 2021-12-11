
Your Orders {{ $details["username"] }}

@for ($i = 0; $i < count($details["menu_name"]); $i++)
    <div style="width: 100%;">
        <h4 style="margin: 0.5rem 0;">{{ $details["menu_count"][$i] }} x {{ $details["menu_name"][$i] }}</h4>
        <span>{{ $details["menu_price"][$i] }}</span>
    </div>
    <br />
@endfor

Price {{ $details["price"] }}
Tax Fee {{ $details["tax_fee"] }}
Total Payment {{ $details["total_payment"] }}