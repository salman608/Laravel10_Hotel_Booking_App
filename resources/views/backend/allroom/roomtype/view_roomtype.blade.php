@extends('admin.admin_dashboard')
@section('admin-content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Room Type</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Room Type List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a type="button" href="{{ route('add.room.type') }}" class="btn btn-primary px-5 radius-30">Add
                    RoomType</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allData as $key=>$item)
                        <tr>
                            <td>{{$key+1 }}</td>
                            <td><img src="{{asset( $item->image) }}" alt="team" width="70" height="40"></td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="{{ route('edit.team',$item->id) }}"
                                    class="btn btn-warning px-3 redius-30">Edit</a>
                                <a href="{{ route('delete.team',$item->id) }}" class="btn btn-danger px-3 redius-30"
                                    id="delete">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

@endsection