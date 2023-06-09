<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Donor Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
@if (session('success'))
    {{session('success')}}
@endif
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>Edit Donor </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('user.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Donor Name:</strong>
                    <input type="text" name="name" placeholder="Name" value="{{$user->name}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Donor Email:</strong>
                    <input type="email" name="email" placeholder="Email" value="{{$user->email}}">
                    @error('email')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Donor Telephone No.:</strong>
                    <input type="text" name="phone_no" placeholder="Name" value="{{$user->phone_no}}">
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
            <button type="submit">Update</button>
            <button type="reset">Cancel</button>
        </div>
    </form>
</div>
</body>
</html>

