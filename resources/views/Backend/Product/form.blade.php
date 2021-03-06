<div class="card">
    <div class="card-header">{{ __('Product') }}</div>

    <div class="card-body">
        <form method="POST" action="{{!empty($product) ? route('product.update',$product->id) : route('product.store')}}" enctype="multipart/form-data">
            @if (!empty($product))
                @method('PUT')
            @endif
            @csrf


            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                <div class="col-md-6">
                    <input id="title" value="{{!empty($product) ? $product->title : ''}}" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="name" autofocus>

                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                <div class="col-md-6">
                    <select class="form-control" name="category_id" id="">
                        @foreach ($categorys as $category)
                            @if (!empty($product->category) && $product->category->category_id == $category->id)
                            <option selected value="{{$category->id}}">{{$category->name}}</option>
                            @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif


                        @endforeach

                    </select>

                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Brand') }}</label>

                <div class="col-md-6">
                    <select class="form-control" name="brand_id" id="">
                        @foreach ($brands as $brand)
                         <option value="{{$brand->id}}">{{$brand->name}}</option>

                        @endforeach

                    </select>

                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Summary') }}</label>

                <div class="col-md-6">
                    <input id="summary" value="{{!empty($product) ? $product->summary : ''}}" type="text" class="form-control @error('summary') is-invalid @enderror" name="summary" value="{{ old('summary') }}" required autocomplete="email">

                    @error('summary')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('SKU') }}</label>

                <div class="col-md-6">
                    <input type="text" value="{{!empty($product) ? $product->sku : ''}}" class="form-control @error('sku') is-invalid @enderror" name="sku">

                    @error('sku')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                <div class="col-md-6 ">
                    <input id="file-input" onchange="priview()" accept="image/png, image/jpg, image/jpeg" type="file" multiple value="{{!empty($product) ? $product->image : ''}}" class="form-control" name="images[]">

                    <div id="image-preview">

                    </div>


                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                <div class="col-md-6">
                    {{-- <input type="text" class="form-control @error('text') is-invalid @enderror" name="text"> --}}
                    <input type="number" value="{{!empty($product) ? $product->price : ''}}" name="price" class="form-control @error('price') is-invalid @enderror" >

                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="discount" class="col-md-4 col-form-label text-md-right">{{ __('Discount') }}</label>

                <div class="col-md-6">
                    {{-- <input type="text" class="form-control @error('text') is-invalid @enderror" name="text"> --}}
                    <input type="number" value="{{!empty($product) ? $product->discount : ''}}" name="discount" class="form-control @error('discount') is-invalid @enderror" >

                    @error('discount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>

                <div class="col-md-6">
                    {{-- <input type="text" class="form-control @error('text') is-invalid @enderror" name="text"> --}}
                    <input type="number" value="{{!empty($product) ? $product->quantity : ''}}" name="quantity" class="form-control @error('quantity') is-invalid @enderror" >

                    @error('quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                <div class="col-md-6">
                    <textarea name="content" class="form-control" id="" cols="30" rows="2">{{!empty($product) ? $product->content : ''}}</textarea>

                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>



            <div class="form-group row">
                <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                <div class="col-md-6">
                    <select class="form-control" name="status" value="{{!empty($product) ? $product->status : ''}}" id="">
                        <option value="1">Active</option>
                        <option value="0">UnActive</option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <input type="submit" class="btn btn-primary" value="Register">

                </div>
            </div>
        </form>
    </div>
</div>
