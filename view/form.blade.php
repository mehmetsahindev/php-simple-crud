@include('header')

<div class="row my-3">
    <div class="col">
        @isset($title) <h2>{{ $title }}</h2> @endisset
    </div>
    <div class="col-auto"><a href="/" class="btn btn-secondary rounded mx-auto"><i class="fas fa-chevron-left"></i> Go Back</a></div>
</div>

<div class="row">
    <form class="col-md-6" method="post">
        @isset($error)
        <div class="alert alert-danger">
            <i class="fas fa-info-circle"></i> {{ $error }}
        </div>
        @endisset
        <div class="form-group my-2">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" @isset($formData['name']) value="{{ $formData['name'] }}" @endisset placeholder="User name">
        </div>
        <div class="form-group my-2">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" @isset($formData['email']) value="{{ $formData['email'] }}" @endisset placeholder="User email">
        </div>
        <div class="form-group my-2">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" @isset($formData['phone']) value="{{ $formData['phone'] }}" @endisset placeholder="User phone">
        </div>
        <button type="submit" class="btn btn-primary my-2">Submit</button>
    </form>
</div>

@include('footer')