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
                                CATEGORIES TABLE
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    @if(Auth::user()->isAdmin)
                                <span class="pull-right">
                                        <button class="btn bg-cyan waves-effect"  data-toggle="modal" data-target="#largeModal">Add New Category</button>
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
                                            <th>No of Products</th>
                                            @if(Auth::user()->isAdmin)
                                            <th>Action</th>
                                            @endif

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sn</th>
                                            <th>Name</th>
                                            <th>No of Products</th>
                                            @if(Auth::user()->isAdmin)
                                            <th>Action</th>
                                            @endif

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($categories as $cat)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$cat->name}}</td>
                                            <td>{{$cat->products_count}}</td>
                                            @if(Auth::user()->isAdmin)
                                            <td>
                                                <span class="btn btn-success" data-toggle="modal" data-target="#editModal{{$cat->id}}">Edit</span>
                    @if(Auth::user()->isAdmin)

                                                <span class="btn btn-danger">Delete</span>
                                                @endif
                                            </td>
                                            @endif
                                        </tr>


                                        <!-- start modal -->
                                        <div class="modal fade" id="editModal{{$cat->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">Edit {{$cat->name}}</h4>
                        </div>
                        <div class="modal-body">
                        <form action="{{route('edit_category')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                                <label for="catuct_name">Category Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="category_name" name="name" class="form-control" value="{{$cat->name}}">
                                        <input type="hidden" name="category_id" value="{{$cat->id}}">
                                    </div>
                                </div>



                                <input type="submit" class="btn btn-primary m-t-15 waves-effect" value="Edit {{$cat->name}}">
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
                            <h4 class="modal-title" id="largeModalLabel">Add Category</h4>
                        </div>
                        <div class="modal-body">
                        <form action="{{route('add_category')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                                <label for="category_name">Category Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="category_name" name="name" class="form-control" placeholder="Enter category name">
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary m-t-15 waves-effect" value="Add new category">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>

    @endsection

