@include('header')

<div class="row my-3">
    <div class="col">
        <h2 class="inline">Employee <strong>Details</strong></h2>
    </div>
    <div class="col-auto"><a href="/add-user" class="btn btn-primary rounded mx-auto"><i class="fas fa-plus"></i> Add New</a></div>
</div>
@isset($error)
<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ $error }}</div>
@endisset
@isset($success)
<div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ $success }}</div>
@endisset
<div class="row" style="overflow-x: auto;">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($data)
            @foreach ($data as $user)
            <tr>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['phone'] }}</td>
                <td class="text-center">
                    <a href="/user/{{ $user['id'] }}" class="mx-1"><i class="fas fa-pen text-warning"></i></a>
                    <a href="/user/{{ $user['id'] }}/delete" class="mx-1"><i class="fas fa-trash-alt text-danger"></i></a>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="4">There is no record.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

@include('footer')