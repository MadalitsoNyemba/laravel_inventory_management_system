<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
        <th>Sn</th>
            <th>Name</th>
            <th>Quantity Left</th>
            <th>Threshold</th>
            <th>Selling Price</th>
            <th>Sold today</th>

        </tr>
    </thead>
    <tbody>
        @foreach($products as $prod)
        @if($prod->sold_today>0)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$prod->name}}</td>
            <td>{{$prod->amount_bought-$prod->amount_sold}}</td>
            <td>{{$prod->threshold}}</td>
            <td>{{$prod->selling_price}}</td>
            <td>{{$prod->sold_today}}</td>
        </tr>
        @endif
        @endforeach

    </tbody>
</table>
