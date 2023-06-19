<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add Donor Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 500px;
            margin-top: 50px;
        }

        .btn-back {
            margin-top: 10px;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="mb-4">Add New Donor</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary btn-back" href="{{ route('user.index') }}"> Back</a>
        </div>
    </div>

    @if (session('success'))
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success mt-4 mb-4">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Donor's Name:</label>
                    <input type="text" name="name" class="form-control" placeholder="Name">
                    @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Donor's Email:</label>
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone_no">Donor's Telephone No.:</label>
                    <input type="text" name="phone_no" class="form-control" placeholder="Telephone No">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="trustee_name">Trustee's Name:</label>
                    <input type="text" name="trustee_name" class="form-control" placeholder="Trustee's Name">
                    @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="trustee_email">Trustee's Email:</label>
                    <input type="email" name="trustee_email" class="form-control" placeholder="Trustee's Email">
                    @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="trustee_phone_no">Trustee's Telephone No.:</label>
                    <input type="text" name="trustee_phone_no" class="form-control" placeholder="Telephone No">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="trustee_password">Trustee's Password:</label>
                    <input type="password" name="trustee_password" class="form-control" placeholder="Trustee's Password">
                    @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="trustee_password_confirmation">Confirm Trustee's Password:</label>
                    <input type="password" name="trustee_password_confirmation" class="form-control" placeholder="Confirm Trustee's Password">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="file">Select File:</label>
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="chooseFile" multiple>
                        <label class="custom-file-label" for="file">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </div>
    </form>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
    function sendPostRequest(){
        var data = {
            name: $("#name").val()
        };
        var headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

        $.ajax({
            url: "/save",
            type: "post",
            headers: headers,
            data: data,
            success:function(res){

            }
        });
    }
</script>
</body>

</html>
