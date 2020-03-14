@extends('layouts.app')

@section('content')


        <!-- Right Sidebar -->

    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL PRODUCTS</div>
                            <div class="number count-to" data-from="0" data-to="{{$total_products}}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">casino</i>
                        </div>
                        <div class="content">
                            <div class="text">REVENUE TODAY (MWK)</div>
                            <div class="number count-to" data-from="0" data-to="{{$revenue_made_today}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">layers</i>
                        </div>
                        <div class="content">
                            <div class="text">CATEGORIES</div>
                            <div class="number count-to" data-from="0" data-to="{{$total_categories}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- #END# Widgets -->



            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>TOP SELLING PRODUCTS TODAY </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                            <span class="pull-right">
                            <a href="{{route('send_mail')}}" class="btn bg-red waves-effect">Close the day</a>
                            </span>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Status</th>
                                            <th>Threshold</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $prod)

                                        <span style="display:none">
                                            {{
                                                $left=($prod->amount_bought-$prod->amount_sold)
                                            }}
                                            {{
                                                $percent =round(($left/($prod->threshold*10))*100)

                                            }}
                                        </span>
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$prod->name}}</td>
                                            @if($left > $prod->threshold)
                                            <td><span class="label bg-green">Adequate</span></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="{{$percent}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$percent}}%"></div>
                                                </div>
                                            </td>
                                            @else
                                            <td><span class="label bg-red">Re-order</span></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-red" role="progressbar" aria-valuenow="{{$percent}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$percent}}%"></div>
                                                </div>
                                            </td>
                                            @endif

                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->

            </div>
        </div>
    </section>
    @endsection

