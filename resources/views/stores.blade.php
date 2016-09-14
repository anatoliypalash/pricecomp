@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-1 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Stores management
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <!-- New Task Form -->
                    <form action="{{ url('store')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                                <!-- Task Name -->
                        <div class="form-group">
                            <label for="store-name" class="col-sm-3 control-label">Store name</label>
                            <div class="col-sm-6">
                                <input type="text" name="name" id="store-name" class="form-control" value="{{ old('store') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="store-url" class="col-sm-3 control-label">Store url</label>
                            <div class="col-sm-6">
                                <input type="text" name="url" id="store-url" class="form-control" value="{{ old('store') }}">
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($stores) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Stores list
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <tbody>
                            @foreach ($stores as $store)
                                <tr>
                                    <td class="table-text"><div>{{ $store->name }}</div></td>
                                    <td class="table-text"><div>{{ $store->url }}</div></td>

                                    <!-- Task Delete Button -->
                                    <td>
                                        <form action="{{ url('store/'.$store->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
