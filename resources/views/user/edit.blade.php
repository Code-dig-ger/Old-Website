@extends('layouts.app') 
@section('title')
<title>Codedigger Edit User Details</title>
@endsection
@section('content')
<section class="cover" data-gradient-bg="#83a4d4,#b6fbff">
<section class="cover">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                    <div class="wrapper"><h1 style="font-family: 'Lobster', sans-serif; margin-bottom:0; font-size:4rem;" >Edit your Details</h1>
                </div>
                <hr>
                <form method="POST" action="{{ route('user.update') }}" class="row mt-0" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <label>Name</label>
                        <input type="text" name="name" placeholder="Name" class="validate-required @error('name') is-invalid @enderror" value="{{ old('name') ? old('name') : auth()->user()->name }}"
                            required />
                        @error('name')
                            <div class="alert-danger" style = "color:red">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label>Username</label>
                        <input readonly type="username" name="username" placeholder="Username" class="validate-required" value="{{ old('username') ? old('username') : auth()->user()->username }}"
                            required />
                    </div>

                    <div class="col-md-12">
                        <label>Codeforces Handle</label>
                        <input type="text" name="codeforces" placeholder="Enter your Codeforces Handle" class="validate-required @error('codeforces') is-invalid @enderror" value="{{ old('codeforces') ? old('codeforces') : auth()->user()->codeforces }}"
                            required />
                        @error('codeforces')
                            <div class="alert-danger" style = "color:red">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label>Codechef Handle</label>
                        <input type="text" name="codechef" placeholder="Enter your Codechef Handle" class="validate-required @error('codechef') is-invalid @enderror" value="{{ old('codechef') ? old('codechef') : auth()->user()->codechef }}" />
                        @error('codechef')
                            <div class="alert-danger" style = "color:red">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label>UVa Handle</label>
                        <input type="text" name="uva" placeholder="Enter your UVa Handle " class="validate-required @error('uva') is-invalid @enderror" value="{{ old('uva') ? old('uva') : auth()->user()->uva }}" />
                        @error('uva')
                            <div class="alert-danger" style = "color:red">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label>Spoj Handle</label>
                        <input type="text" name="spoj" placeholder="Enter your SPOJ Handle " class="validate-required @error('spoj') is-invalid @enderror" value="{{ old('spoj') ? old('spoj') : auth()->user()->spoj }}" />
                        @error('spoj')
                            <div class="alert-danger" style = "color:red">{{ $message }}</div>
                        @enderror
                    </div>

                    @if(auth()->user()->admin || auth()->user()->is_password)

                        <div class="col-md-12">
                            <label>Change Password (leave blank if you don't want to change)</label>
                            <input type="password" name="password" class="validate-required" value="" />
                        </div>

                        <div class="col-md-12">
                        <span class="type--fine-print block" >Not Need Password Anymore?
                                <br>
                                <a class = "btn btn--sm" href="{{route('user.edit')}}?disable_password=true">
                                <span class="btn__text">
                                            Disable Password
                                        </span></a>
                        </span>
                        </div>

                    @else
                        @if($enable_password)

                        <div class="col-md-12">
                            <label>Create new Password </label>
                            <input type="password" name="password" class="validate-required" value="" required />
                        </div>

                        @else
                        <div class="col-md-12">
                        <span class="type--fine-print block" >Secured Account?
                                <br>
                                <a class = "btn btn--sm" href="{{route('user.edit')}}?enable_password=true">
                                <span class="btn__text">
                                            Enable Password
                                        </span></a>
                        </span>
                        </div>

                            <input type="hidden" name="password" value=""
                                    required>
                        @endif
                    @endif

                    <div class="col-md-4">
                        <button type="submit" class="btn btn--sm type--upercase">
                            <span>Edit</span></button>
                    </div>
                </form>
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>
</section>
@endsection