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
                                PRODUCTS TABLE
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">

                                    @if(Auth::user()->isAdmin)
                                    <span class="pull-right">
                                        <button class="btn bg-cyan waves-effect"  data-toggle="modal" data-target="#largeModal">Add New Product</button>
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
                                            <!-- <th>Image</th> -->
                                            <th>Name</th>
                                            <th>Buying Price</th>
                                            <th>Selling Price</th>
                                            <th>Category</th>
                                            <th>Threshold</th>

                                            @if(Auth::user()->isAdmin)
                                            <th>Action</th>
                                            @endif

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sn</th>
                                            <th>Name</th>
                                            <th>Buying Price</th>
                                            <th>Selling Price</th>
                                            <th>Category</th>
                                            <th>Threshold</th>
                                            @if(Auth::user()->isAdmin)
                                            <th>Action</th>
                                            @endif

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($products as $prod)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$prod->name}}</td>
                                            <td>{{$prod->buying_price}}</td>
                                            <td>{{$prod->selling_price}}</td>
                                            <td>{{$prod->categories->name}}</td>
                                            <td>{{$prod->threshold}}</td>
                                            @if(Auth::user()->isAdmin)
                                            <td>
                                                <span class="btn btn-success" data-toggle="modal" data-target="#editModal{{$prod->id}}">Edit</span>
                    @if(Auth::user()->isAdmin)
                    <form action="{{route('delete_product')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{$prod->id}}">
                                                    <input type="submit" class="btn btn-danger" value="Delete">
                                                </form>
                                                @endif
                                            </td>
                                            @endif
                                        </tr>


                                        <!-- start modal -->
                                        <div class="modal fade" id="editModal{{$prod->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">Edit {{$prod->name}}</h4>
                        </div>
                        <div class="modal-body">
                        <form action="{{route('edit_product')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                                <label for="product_name">Product Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="product_name" name="name" class="form-control" value="{{$prod->name}}">
                                        <input type="hidden" name="product_id" value="{{$prod->id}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <label for="buying_price">Buying price</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="buying_price" name="buying_price" class="form-control" value="{{$prod->buying_price}}">
                                    </div>
                                </div>
                                    </div>
                                    <div class="col-md-6">

                                    <label for="selling_price">Selling price</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="selling_price"  name="selling_price" class="form-control" value="{{$prod->selling_price}}">
                                    </div>
                                </div>
                                    </div>
                                </div>
                                <label for="threshold">Threshold</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="threshold" name="threshold" class="form-control" value="{{$prod->threshold}}">
                                    </div>
                                </div>
                                <!-- <label for="category">Category</label>
                                <select name="category_id" class="form-control show-tick">
                                        <option value="{{$prod->category_id}}">{{$prod->categories->name}}</option>
                                        <option>Ketchup</option>
                                        <option>Relish</option>
                                </select> -->

                                <input type="submit" class="btn btn-primary m-t-15 waves-effect" value="Edit {{$prod->name}}">
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
                            <h4 class="modal-title" id="largeModalLabel">Add Product</h4>
                        </div>
                        <div class="modal-body">
                        <form action="{{route('add_product')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                                <label for="product_name">Product Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="product_name" name="name" class="form-control" placeholder="Enter product name">
                                    </div>
                                </div>



                                <!-- <label for="image">Image</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" id="image" name="image" class="form-control">
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-6">
                                    <label for="buying_price">Buying price</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="buying_price" name="buying_price" class="form-control" placeholder="Enter buying price">
                                    </div>
                                </div>
                                    </div>
                                    <div class="col-md-6">

                                    <label for="selling_price">Selling price</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="selling_price"  name="selling_price" class="form-control" placeholder="Enter selling price">
                                    </div>
                                </div>
                                    </div>
                                </div>
                                <label for="threshold">Threshold</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="threshold" name="threshold" class="form-control" placeholder="Enter product threshold">
                                    </div>
                                </div>



                                <label for="category">Category</label>
                                <select class="form-control show-tick"  name="category_id">
                                    @foreach($categories as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach

                                    </select>

                                <input type="submit" class="btn btn-primary m-t-15 waves-effect" value="Add new product">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>

    @endsection

