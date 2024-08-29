<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-md bg-white shadow-lg bsb-navbar bsb-navbar-hover bsb-navbar-caret">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard')}} ">
                <strong>Admin Dashboard</strong>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
            </button>
            <a href="{{route('products.index')}}" class="ms-3 text-black" style="text-decoration: none">Product</a>
            <a href="{{route('accounts.index')}}" class="ms-3 text-black" style="text-decoration: none">User</a>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#!" id="accountDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">Hello, {{ Auth::guard('admin')->user()->name }}</a>
                            <ul class="dropdown-menu border-0 shadow bsb-zoomIn" aria-labelledby="accountDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.logout')}}">Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10 d-flex justify-content-end mt-4">
                <a href="{{ route('accounts.index') }}" class="btn btn-dark">List User</a>
            </div>
            <div class="col-md-10">
                <div class="card borde-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Edit User</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('accounts.update', $account->id) }}" method="post" >
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label h5">Name</label>
                                <input type="text" value="{{ old('name', $account->name) }}"  class="@error('name') is-invalid @enderror form-control  form-control-lg" name="name"
                                    placeholder="Enter Name" id="">
                                    @error('name')
                                        <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Email</label>
                                <input type="text" value="{{ old('sku', $account->email) }}" class="@error('email') is-invalid @enderror form-control form-control-lg" name="email"
                                    placeholder="Enter Email" id="">
                                    @error('email')
                                        <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Role</label>
                                <select name="role" class="@error('role') is-invalid @enderror form-control form-control-lg" id="">
                                    <option value="admin" {{ old('role', $account->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ old('role', $account->role) == 'customer' ? 'selected' : '' }}>Customer</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label h5">Create at</label>
                                <input type="text" value="{{ old('sku', $account->created_at)->format('d M, Y') }}" class="@error('email') is-invalid @enderror form-control form-control-lg" name="created_at"
                                     id="" readonly>
                                    @error('email')
                                        <p class="invalid-feedback">{{$message}}</p>
                                    @enderror
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Update</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
