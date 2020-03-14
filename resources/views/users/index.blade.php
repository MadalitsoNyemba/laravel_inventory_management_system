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
                                USERS TABLE
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    @if(Auth::user()->isAdmin)
                                <span class="pull-right">
                                        <button class="btn bg-cyan waves-effect"  data-toggle="modal" data-target="#largeModal">Add New User</button>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>isAdmin</th>
                                            @if(Auth::user()->isAdmin)
                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>isAdmin</th>
                                            @if(Auth::user()->isAdmin)
                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($users as $usr)
                                        <tr>
                                            <td>{{$usr->name}}</td>
                                            <td>{{$usr->email}}</td>
                                            <td>
                                                @if($usr->isAdmin)
                                                Yes
                                                @else
                                                No
                                                @endif
                                            </td>
                                            @if(Auth::user()->isAdmin)
                                            <td>
                                                <span >
                                                @if($usr->isAdmin)
                                                <form action="{{route('admin_actions')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{$usr->id}}">
                                                    <input type="hidden" name="to_do" value="remove_admin">
                                                    <input type="submit" class="btn btn-primary" value="Remove as admin">
                                                </form>
                                                    @else
                                                    <form action="{{route('admin_actions')}}" method="POST">
                                                        @csrf
                                                    <input type="hidden" name="user_id" value="{{$usr->id}}">
                                                    <input type="hidden" name="to_do" value="make_admin">
                                                    <input type="submit" class="btn btn-primary" value="Make admin">
                                                </form>
                                                    @endif
                                                </span>
                                                <br>
                                                <span>
                                                <form action="{{route('admin_actions')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{$usr->id}}">
                                                    <input type="hidden" name="to_do" value="delete">
                                                    <input type="submit" class="btn btn-danger" value="Delete">
                                                </form>
                                                </span>
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
            </div>
            </div>
</section>
            <!-- #END# Exportable Table -->

                <!-- Large Size -->
                <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">Add New User</h4>
                        </div>
                        <div class="modal-body">
                        <form action="{{route('admin_actions')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                                <label for="name">Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter name for new user" required>
                                        <input type="hidden"  name="to_do" value="add_user">
                                    </div>
                                </div>
                                <label for="email">Email</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="email" name="email" class="form-control" placeholder="Enter email for new user" required>
                                    </div>
                                </div>
                                <label for="password">Password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="password" name="password" class="form-control" placeholder="Enter password for new user" required>
                                    </div>
                                </div>
                                <input type="checkbox" id="isAdmin" name="isAdmin" class="filled-in">
                                <label for="isAdmin">Make Admin</label>

                                <br>
                                <input type="submit" class="btn btn-primary m-t-15 waves-effect" value="Add new user">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>

    @endsection

