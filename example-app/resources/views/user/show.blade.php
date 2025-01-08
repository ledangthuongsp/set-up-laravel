@extends('layouts.adminlte')

@section('title', 'Chi tiết người dùng')

@section('content_header')
    <h1>Chi tiết người dùng</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Thông tin người dùng</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <strong>Tên:</strong>
                    <p>{{ $user->name }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Email:</strong>
                    <p>{{ $user->email }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <strong>Ngày tạo:</strong>
                    <p>{{ $user->created_at }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Ngày cập nhật:</strong>
                    <p>{{ $user->updated_at }}</p>
                </div>
            </div>
            
            <div class="form-group">
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Chỉnh sửa</a>
                <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
            </div>
        </div>
    </div>
@stop
