
   @extends('layouts.app')

@section('content')
   <section class="content">
        <div class="container-fluid">
            <!-- Changelogs -->
            <div class="block-header">
                <h2>USER HISTORY</h2>
            </div>
            @foreach($history as $hist)
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                By {{$hist->User->name}}
                                <small>{{$hist->created_at->format('l,d F Y')}} @ {{$hist->created_at->format('H:i:s')}} </small>
                            </h2>
                        </div>
                        <div class="body">
                            @if($hist->status=='initial')
                            <p>- Bought {{$hist->products->name}}</p>
                            @elseif($hist->status=='buy')
                            <p>- Added stock for {{$hist->products->name}} amounting to {{$hist->stock}}</p>
                            @elseif($hist->status=='sale')
                            <p>- Sold {{$hist->products->name}} amounting to {{$hist->stock}}</p>
                        <form action="{{route('reverse_transaction')}}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$hist->id}}" name="hist_id">
                        <input type="submit" value="Reverse transaction" class="btn btn-info">
                        </form>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            @endforeach





        </div>
    </section>
    @endsection
