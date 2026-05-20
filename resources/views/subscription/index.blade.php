@extends('admin.home')

@section('content')

<div class="container">
<h3 align="center" class="mt-5">Subscriptions</h3>
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">

    <table class="table mt-5">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User Name</th>
                <th scope="col">Email</th>
                <th scope="col">Plan</th>
                <th scope="col">Status</th>
                <th scope="col">Validity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subscriptions as $item)
                <tr>
                    <td scope="col">{{ $loop->iteration }}</td>
                    <td scope="col">{{ $item->user->name ?? 'N/A' }}</td>
                    <td scope="col">{{ $item->user->email ?? 'N/A' }}</td>
                    <td scope="col">{{ ucfirst($item->plan) }}</td>
                    <td scope="col">
                        <span class="badge badge-{{ $item->status == 'active' ? 'success' : 'warning' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td scope="col">{{ $item->start_date }} to {{ $item->end_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>

@endsection
