@extends('welcome')

@section('title', 'Blogotopia | Add a blogpost')

@section('pageContent')
<main class="container">
    <div class="row g-5">
        <div class="col-md-8">
            <div class="p-4 mb-3 bg-light rounded">
                <h4 class="mb-3">Add a blogpost</h4>
                <form class="needs-validation" novalidate="" enctype="multipart/form-data" method="post"
                    action="{{ url('/blogposts/create') }}">
                    @csrf
                    <div class="row g-3">
                        <!--div class="col-sm-6">
                            <label for="firstName" class="form-label">First name</label>
                            <input type="text" class="form-control is-invalid" id="firstName" placeholder="" value="" required="">
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Last name</label>
                            <input type="text" class="form-control is-valid" id="lastName" placeholder="" value="" required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div-->

                        <div class="col-12">
                            <label for="title" class="form-label">Title</label>
                            <input type="text"
                                class="form-control @if(old('_token') && !$errors->has('title')) is-valid @endif @error('title') is-invalid @enderror"
                                id="title" placeholder="" name="title" value="{{ old('title', '') }}">
                            @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            @if(old('_token') && !$errors->has('title'))
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            @endif
                        </div>

                        <div class="col-12">
                            <label for="content" class="form-label">Content</label>
                            <textarea
                                class="form-control @if(old('_token') && !$errors->has('content')) is-valid @endif @error('content') is-invalid @enderror"
                                id="content" rows="4" name="content">{{ old('content', '') }}</textarea>
                            @error('content')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            @if(old('_token') && !$errors->has('content'))
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            @endif
                        </div>

                        <div class="col-12">
                            <label for="image" class="form-label">Image</label>
                            <input
                                class="form-control @if(old('_token') && !$errors->has('image')) is-valid @endif @error('image') is-invalid @enderror"
                                type="file" id="image" name="image">
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4">


                    <div class="form-check">
                        <input @checked(old('featured')=="on" ) type="checkbox" class="form-check-input" id="featured"
                            name="featured">
                        <label class="form-check-label" for="featured">Include this blogpost on the home page</label>
                    </div>

                    <hr class="my-4">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="category" class="form-label">Category</label>
                            <select
                                class="form-select @if(old('_token') && !$errors->has('category_id')) is-valid @endif @error('category_id') is-invalid @enderror"
                                id="category" required="" name="category_id">
                                <option value="-1">Choose...</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}" @selected(old('category_id')==$category->id)>{{
                                    $category->title }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            @if(old('_token') && !$errors->has('category_id'))
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            @endif
                        </div>

                        <div class="col-12">
                            <label for="tags" class="form-label">Tags</label>
                            <input type="text" class="form-control" id="tags" placeholder="" name="tags" value="{{
                                old('tags', '' ) }}">
                        </div>
                    </div>

                    <hr class="my-4">

                    <button class="btn btn-primary btn-lg" type="submit">Add blogpost</button>
                </form>

            </div>

        </div>

        @include('partials/sidebar')

    </div>
</main>
@endsection