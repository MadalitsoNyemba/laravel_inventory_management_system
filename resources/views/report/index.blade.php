@extends('layouts.app')

@section('content')
<section class="content">
        <div class="container-fluid">
          
        <div class="card">
                        <div class="header">
                            <h2>EXPENDITURE VS INCOME (MWK)</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                        {!! $chart->container() !!}
                        </div>
                    </div>
                </div>
</section>
{!! $chart->script() !!}

@endsection
