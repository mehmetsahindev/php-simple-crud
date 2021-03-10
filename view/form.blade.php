<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 my-3 pb-3 border bg-light">
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
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>