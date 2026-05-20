@extends('admin.home')

@section('content')

<div class="container">
<h3 align="center" class="mt-5">Households</h3>
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">

    <table class="table mt-5">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User ID</th>
                <th scope="col">Household Name</th>
                <th scope="col">Location</th>
                <th scope="col">Assigned Truck</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($household as $item)
                <tr>
                    <td scope="col">{{ $loop->iteration }}</td>
                    <td scope="col">{{ $item->user_id }}</td>
                    <td scope="col">{{ $item->household_name }}</td>
                    <td scope="col">{{ $item->location }}</td>
                    <td scope="col">
                        <form action="{{ route('admin.household.assign_truck', $item->id) }}" method="POST" class="d-flex align-items-center">
                            @csrf
                            <select name="truck_id" class="form-control" style="width: auto; display: inline-block; margin-right: 10px;">
                                <option value="">No Truck Assigned</option>
                                @foreach($trucks as $truck)
                                    <option value="{{ $truck->id }}" {{ $item->truck_id == $truck->id ? 'selected' : '' }}>
                                        {{ $truck->name }} ({{ $truck->registration_number }})
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">Assign</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>

@endsection
