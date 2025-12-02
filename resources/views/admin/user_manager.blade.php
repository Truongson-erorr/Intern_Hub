@extends('admin.layout.index')

@section('title', 'Quản lý User')

@section('content')

<h2 class="fw-bold mb-4"><i class="fas fa-users"></i> Quản lý User</h2>

<div class="card shadow border-0 rounded-4">
    <div class="card-body">

        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Ngày tạo</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->created_at->format('d/m/Y') }}</td>
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
