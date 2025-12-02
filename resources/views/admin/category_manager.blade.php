@extends('admin.layout.index')

@section('title', 'Quản lý Danh mục')

@section('content')

<h2 class="fw-bold mb-4"><i class="fas fa-list"></i> Quản lý Danh mục việc làm</h2>

<div class="card shadow border-0 rounded-4">
    <div class="card-body">

        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Ngày tạo</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>

            <tbody>
                @foreach($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->description }}</td>
                    <td>{{ $cat->created_at ? \Carbon\Carbon::parse($cat->created_at)->format('d/m/Y') : '' }}</td>
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
