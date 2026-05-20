@extends('admin.home')

@section('content')
<div class="container-fluid" style="padding: 20px;">
    <h2 class="mb-4">Bin Overflow Complaints</h2>
    
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Location</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Reported At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($complaints as $complaint)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $complaint->user->name ?? 'N/A' }}</td>
                        <td>{{ $complaint->location }}</td>
                        <td>{{ $complaint->description }}</td>
                        <td>
                            <span class="badge badge-{{ $complaint->status == 'pending' ? 'danger' : 'success' }}">
                                {{ ucfirst($complaint->status) }}
                            </span>
                        </td>
                        <td>{{ $complaint->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
