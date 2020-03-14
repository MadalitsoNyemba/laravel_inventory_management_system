@extends('layouts.app')

@section('content')
<section class="content">
        <div class="container-fluid">
 <!-- Exportable Table -->
 <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               POINT OF SALE
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">

                                    @if(Auth::user()->isAdmin)
                                    <span class="pull-right">
                                        <button class="btn bg-cyan waves-effect"  data-toggle="modal" data-target="#largeModal">Add Stock</button>
                                    </span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                        <th>Sn</th>
                                            <th>Name</th>
                                            <th>Quantity Left</th>
                                            <th>Threshold</th>
                                            <th>Selling Price</th>
                                            <th>Sold today</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sn</th>
                                            <th>Name</th>
                                            <th>Quantity Left</th>
                                            <th>Threshold</th>
                                            <th>Selling Price</th>
                                            <th>Sold today</th>
                                            <th>Action</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($products as $prod)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$prod->name}}</td>
                                            <td>{{$prod->amount_bought-$prod->amount_sold}}</td>
                                            <td>{{$prod->threshold}}</td>
                                            <td>{{$prod->selling_price}}</td>
                                            <td>{{$prod->sold_today}}</td>
                                            <td>
                                                <span class="btn btn-warning" data-toggle="modal" data-target="#sellModal{{$prod->id}}">Sell</span>
                                            </td>
                                        </tr>


                                        <!-- start modal -->
                                        <div class="modal fade" id="sellModal{{$prod->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">Sell {{$prod->name}}</h4>
                        </div>
                        <div class="modal-body">
                        <form action="{{route('stock_calculations')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                                <label for="product_name">Quantity</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="product_name" name="stock" class="form-control">
                                        <input type="hidden" name="product_id" value="{{$prod->id}}">
                                        <input type="hidden" name="status" value="sale">
                                        <input type="hidden" name="sold_price" value="{{$prod->selling_price}}">
                                    </div>
                                </div>


                                <input type="submit" class="btn btn-primary m-t-15 waves-effect" value="Sell {{$prod->name}}">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>



                                        <!-- end modal -->
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
</section>
            <!-- #END# Exportable Table -->


             <!-- Large Size -->
             <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">Add Stock</h4>
                        </div>
                        <div class="modal-body">
                        <form action="{{route('stock_calculations')}}" method="POST" enctype="multipart/form-data">
                        @csrf



                                <label for="product">Choose Product</label>
                                <select class="form-control show-tick"  name="product_id">
                                    @foreach($products as $prod)
                                        <option value="{{$prod->id}}">{{$prod->name}}</option>
                                    @endforeach

                                    </select>
                                    <br>
                                    <br>
                                    <br>
                                    <label for="stock">Stock Amount</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="stock"  name="stock" class="form-control" placeholder="Enter the additional stock">
                                        <input type="hidden" name="status" value="buy">
                                        <input type="hidden" name="sold_price" value="0">
                                    </div>
                                </div>
<br>
                                <input type="submit" class="btn btn-primary m-t-15 waves-effect" value="Add new stock">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>

    @endsection

