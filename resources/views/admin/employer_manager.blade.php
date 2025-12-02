@extends('admin.layout.index')

@section('title', 'Quản lý Công ty')

@section('content')

<h2 class="fw-bold mb-4"><i class="fas fa-building"></i> Quản lý Công ty</h2>

<div class="card shadow border-0 rounded-4">
    <div class="card-body">

        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên công ty</th>
                    <th>Email</th>
                    <th>Điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Website</th>
                    <th>Ngày tạo</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>

            <tbody>
                @foreach($employers as $employer)
                <tr>
                    <td>{{ $employer->id }}</td>
                    <td>{{ $employer->name }}</td>
                    <td>{{ $employer->email }}</td>
                    <td>{{ $employer->phone }}</td>
                    <td>{{ $employer->address }}</td>
                    <td>{{ $employer->website }}</td>
                    <td>{{ $employer->created_at ? $employer->created_at->format('d/m/Y') : '' }}</td>
                    <td class="text-center">
                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
