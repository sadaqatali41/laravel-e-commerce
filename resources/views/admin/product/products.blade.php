@extends('admin.layouts.app')
@section('title', $title)

@section('content')

    @switch($exp)
        @case('create')
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">{{ $title }}</h2>
                        <a href="{{ route('admin.product.index') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-eye"></i>View</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <form action="{{ route('admin.product.store') }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="sub_category_id" class=" form-control-label">Sub Category</label>
                                            <select name="sub_category_id" id="sub_category_id" class="form-control form-control-sm"></select>
                                            @error('sub_category_id')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="prod_name" class=" form-control-label">Product Name</label>
                                            <input type="text" id="prod_name" name="prod_name" placeholder="Product Name.."
                                                class="form-control form-control-sm" value="{{ old('name') }}">
                                            @error('prod_name')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="slug" class=" form-control-label">Slug</label>
                                            <input type="text" id="slug" name="slug" placeholder="Product Slug.."
                                                class="form-control form-control-sm" value="{{ old('slug') }}">
                                            @error('slug')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="brand_id" class=" form-control-label">Brand Name</label>
                                            <select name="brand_id" id="brand_id" class="form-control form-control-sm"></select>
                                            @error('brand_id')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="model_id" class=" form-control-label">Model Name</label>
                                            <input type="text" id="model_id" name="model_id" placeholder="Model Name.."
                                                class="form-control form-control-sm" value="{{ old('model_id') }}">
                                            @error('model_id')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> 
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="keywords" class=" form-control-label">Keywords</label>
                                            <input type="text" id="keywords" name="keywords" placeholder="Keywords.."
                                                class="form-control form-control-sm" value="{{ old('keywords') }}">
                                            @error('keywords')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="description" class=" form-control-label">Description</label>
                                            <textarea name="description" id="description" class="form-control" placeholder="Description" rows="4">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>                                     
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="short_desc" class=" form-control-label">Short Description</label>
                                            <textarea name="short_desc" id="short_desc" class="form-control" placeholder="Short Description" rows="4">{{ old('short_desc') }}</textarea>
                                            @error('short_desc')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="tech_spec" class=" form-control-label">Technical Specification</label>
                                            <textarea name="tech_spec" id="tech_spec" class="form-control" placeholder="Technical Specification" rows="4">{{ old('tech_spec') }}</textarea>
                                            @error('tech_spec')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="used_for" class=" form-control-label">Uses</label>
                                            <textarea name="used_for" id="used_for" class="form-control" placeholder="Uses" rows="4">{{ old('used_for') }}</textarea>
                                            @error('used_for')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="warranty" class=" form-control-label">Warranty</label>
                                            <textarea name="warranty" id="warranty" class="form-control" placeholder="Warranty" rows="4">{{ old('warranty') }}</textarea>
                                            @error('warranty')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="lead_time" class=" form-control-label">Lead Time</label>
                                            <input name="lead_time" id="lead_time" class="form-control form-control-sm" placeholder="Lead Time" value="{{ old('lead_time') }}">
                                            @error('lead_time')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="tax_id" class=" form-control-label">Tax</label>
                                            <select name="tax_id" id="tax_id" class="form-control form-control-sm"></select>
                                            @error('tax_id')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>  
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="is_promo" class=" form-control-label">Is Promo</label>
                                            <select name="is_promo" id="is_promo" class="form-control form-control-sm">
                                                <option value="1" @if (old('is_promo') === '1') selected @endif>Yes</option>
                                                <option value="0" @if (old('is_promo') === '0') selected @endif>No</option>
                                            </select>
                                            @error('is_promo')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>                                  
                                </div>
                                <div class="row">                                    
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="is_featured" class=" form-control-label">Is Featured</label>
                                            <select name="is_featured" id="is_featured" class="form-control form-control-sm">
                                                <option value="1" @if (old('is_featured') === '1') selected @endif>Yes</option>
                                                <option value="0" @if (old('is_featured') === '0') selected @endif>No</option>
                                            </select>
                                            @error('is_featured')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="is_discounted" class=" form-control-label">Is Discounted</label>
                                            <select name="is_discounted" id="is_discounted" class="form-control form-control-sm">
                                                <option value="1" @if (old('is_discounted') === '1') selected @endif>Yes</option>
                                                <option value="0" @if (old('is_discounted') === '0') selected @endif>No</option>
                                            </select>
                                            @error('is_discounted')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="is_trending" class=" form-control-label">Is Trending</label>
                                            <select name="is_trending" id="is_trending" class="form-control form-control-sm">
                                                <option value="1" @if (old('is_trending') === '1') selected @endif>Yes</option>
                                                <option value="0" @if (old('is_trending') === '0') selected @endif>No</option>
                                            </select>
                                            @error('is_trending')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="status" class=" form-control-label">Status</label>
                                            <select name="status" id="status" class="form-control form-control-sm">
                                                <option value="A" @if (old('status') === 'A') selected @endif>Active
                                                </option>
                                                <option value="I" @if (old('status') === 'I') selected @endif>Inactive
                                                </option>
                                            </select>
                                            @error('status')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="image" class=" form-control-label">Main Image</label>
                                            <input type="file" id="image" name="image" class="form-control-file">
                                            @error('image')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="images" class=" form-control-label">Images</label>
                                            <input type="file" id="images" name="images[]" class="form-control-file" multiple>                                            
                                        </div>
                                    </div>
                                </div>                                
                                <div class="row">
                                    <div class="col-lg-12 m-t-10">
                                        <h4 class="mb-2">Product Attributes</h4>
                                        <div class="table-responsive table--no-card m-b-30">
                                            <table class="table table-bordered table-sm table-striped" id="productAttributeTbl">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>
                                                            <button type="button" class="btn btn-primary btn-sm" id="moreAttr"><i class="fa fa-plus"></i></button>
                                                        </th>
                                                        <th>SKU No</th>
                                                        <th>MRP</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Size</th>
                                                        <th>Color</th>
                                                        <th>Image</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (old('sku_no', ['']) as $index => $sku)
                                                    <tr>
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm removeAttribute" data-id="0"><i class="fa fa-minus"></i></button>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="sku_no[]" placeholder="SKU.." 
                                                            class="form-control form-control-sm sku_no" value="{{ old('sku_no.' . $index) }}">
                                                            @error('sku_no.' . $index)
                                                                <span class="help-block status--denied">{{ $message }}</span>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <input type="text" name="mrp[]" placeholder="MRP.." 
                                                            class="form-control form-control-sm mrp" value="{{ old('mrp.' . $index) }}">
                                                            @error('mrp.' . $index)
                                                                <span class="help-block status--denied">{{ $message }}</span>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <input type="text" name="price[]" placeholder="MRP.." 
                                                            class="form-control form-control-sm price" value="{{ old('price.' . $index) }}">
                                                            @error('price.' . $index)
                                                                <span class="help-block status--denied">{{ $message }}</span>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <input type="text" name="qty[]" placeholder="Quantity.." 
                                                            class="form-control form-control-sm qty" value="{{ old('qty.' . $index) }}">
                                                            @error('qty.' . $index)
                                                                <span class="help-block status--denied">{{ $message }}</span>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <select name="size_id[]" class="form-control form-control-sm size_id">
                                                                <option value="">--Select Size--</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="color_id[]" class="form-control form-control-sm color_id">
                                                                <option value="">--Select Color--</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="file" name="image_attr[]"
                                                            class="form-control form-control-sm image_attr">                                                            
                                                            @error('image_attr.' . $index)
                                                                <span class="help-block status--denied">{{ $message }}</span>
                                                            @enderror
                                                            @error('image_attr')
                                                                <span class="help-block status--denied">{{ $message }}</span>
                                                            @enderror
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @break
        @case('edit')
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">{{ $title }}</h2>
                        <a href="{{ route('admin.product.index') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-eye"></i>View</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <form action="{{ route('admin.product.update', $product->id) }}" enctype="multipart/form-data" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="sub_category_id" class=" form-control-label">Sub Category</label>
                                            <select name="sub_category_id" id="sub_category_id" class="form-control form-control-sm">
                                                <option selected value="{{ $product->sub_category_id }}">{{ $product->category->name . ' - ' . $product->subcategory->name }}</option>
                                            </select>
                                            @error('sub_category_id')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="prod_name" class=" form-control-label">Product Name</label>
                                            <input type="text" id="prod_name" name="prod_name" placeholder="Product Name.."
                                                class="form-control form-control-sm" value="{{ old('name', $product->prod_name) }}">
                                            @error('prod_name')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="slug" class=" form-control-label">Slug</label>
                                            <input type="text" id="slug" name="slug" placeholder="Product Slug.."
                                                class="form-control form-control-sm" value="{{ old('slug', $product->slug) }}">
                                            @error('slug')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">                                        
                                        <div class="form-group">
                                            <label for="brand_id" class=" form-control-label">Brand Name</label>
                                            <select name="brand_id" id="brand_id" class="form-control form-control-sm">
                                                <option selected value="{{ $product->brand_id }}">{{ $product->brand->name }}</option>
                                            </select>
                                            @error('brand_id')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> 
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="model_id" class=" form-control-label">Model Name</label>
                                            <input type="text" id="model_id" name="model_id" placeholder="Model Name.."
                                                class="form-control form-control-sm" value="{{ old('model_id', $product->model_id) }}">
                                            @error('model_id')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> 
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="keywords" class=" form-control-label">Keywords</label>
                                            <input type="text" id="keywords" name="keywords" placeholder="Keywords.."
                                                class="form-control form-control-sm" value="{{ old('keywords', $product->keywords) }}">
                                            @error('keywords')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="description" class=" form-control-label">Description</label>
                                            <textarea name="description" id="description" class="form-control" placeholder="Description" rows="4">{{ old('description', $product->description) }}</textarea>
                                            @error('description')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>                                     
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="short_desc" class=" form-control-label">Short Description</label>
                                            <textarea name="short_desc" id="short_desc" class="form-control" placeholder="Short Description" rows="4">{{ old('short_desc', $product->short_desc) }}</textarea>
                                            @error('short_desc')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="tech_spec" class=" form-control-label">Technical Specification</label>
                                            <textarea name="tech_spec" id="tech_spec" class="form-control" placeholder="Technical Specification" rows="4">{{ old('tech_spec', $product->tech_spec) }}</textarea>
                                            @error('tech_spec')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="used_for" class=" form-control-label">Uses</label>
                                            <textarea name="used_for" id="used_for" class="form-control" placeholder="Uses" rows="4">{{ old('used_for', $product->used_for) }}</textarea>
                                            @error('used_for')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="warranty" class=" form-control-label">Warranty</label>
                                            <textarea name="warranty" id="warranty" class="form-control" placeholder="Warranty" rows="4">{{ old('warranty', $product->warranty) }}</textarea>
                                            @error('warranty')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="lead_time" class=" form-control-label">Lead Time</label>
                                            <input name="lead_time" id="lead_time" class="form-control form-control-sm" placeholder="Lead Time" value="{{ old('lead_time', $product->lead_time) }}">
                                            @error('lead_time')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="tax_id" class=" form-control-label">Tax</label>
                                            <select name="tax_id" id="tax_id" class="form-control form-control-sm">
                                                @if ($product->tax_id)
                                                <option value="{{ $product->tax_id }}">{{ $product->tax->tax_desc }}</option>  
                                                @endif
                                            </select>
                                            @error('tax_id')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="is_promo" class=" form-control-label">Is Promo</label>
                                            <select name="is_promo" id="is_promo" class="form-control form-control-sm">
                                                <option value="1" @if (old('is_promo', $product->is_promo) === 1) selected @endif>Yes</option>
                                                <option value="0" @if (old('is_promo', $product->is_promo) === 0) selected @endif>No</option>
                                            </select>
                                            @error('is_promo')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">                                    
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="is_featured" class=" form-control-label">Is Featured</label>
                                            <select name="is_featured" id="is_featured" class="form-control form-control-sm">
                                                <option value="1" @if (old('is_featured', $product->is_featured) === 1) selected @endif>Yes</option>
                                                <option value="0" @if (old('is_featured', $product->is_featured) === 0) selected @endif>No</option>
                                            </select>
                                            @error('is_featured')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="is_discounted" class=" form-control-label">Is Discounted</label>
                                            <select name="is_discounted" id="is_discounted" class="form-control form-control-sm">
                                                <option value="1" @if (old('is_discounted', $product->is_discounted) === 1) selected @endif>Yes</option>
                                                <option value="0" @if (old('is_discounted', $product->is_discounted) === 0) selected @endif>No</option>
                                            </select>
                                            @error('is_discounted')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="is_trending" class=" form-control-label">Is Trending</label>
                                            <select name="is_trending" id="is_trending" class="form-control form-control-sm">
                                                <option value="1" @if (old('is_trending', $product->is_trending) === 1) selected @endif>Yes</option>
                                                <option value="0" @if (old('is_trending', $product->is_trending) === 0) selected @endif>No</option>
                                            </select>
                                            @error('is_trending')<span class="help-block status--denied">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="status" class=" form-control-label">Status</label>
                                            <select name="status" id="status" class="form-control form-control-sm">
                                                <option value="A" @if (old('status', $product->status) === 'A') selected @endif>Active
                                                </option>
                                                <option value="I" @if (old('status', $product->status) === 'I') selected @endif>Inactive
                                                </option>
                                            </select>
                                            @error('status')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="image" class=" form-control-label">Main Image</label>
                                            <input type="file" id="image" name="image" class="form-control-file">
                                            @error('image')
                                                <span class="help-block status--denied">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        @if (isset($product->image))
                                            <img src="{{ asset('storage/product/'. $product->image) }}" alt="Product Image" style="width: 150px;" class="img-fluid mb-1">
                                        @endif
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="images" class="form-control-label">Images</label>
                                            <input type="file" id="images" name="images[]" class="form-control-file" multiple>                                            
                                        </div>
                                        <div class="row">
                                            @foreach ($product->images as $p_image)
                                                <div class="col-sm-2">
                                                    <img src="{{ asset('storage/product/'. $p_image->image) }}" alt="Product Image" style="width: 150px;" class="img-fluid mb-1">   
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 m-t-10">
                                        <h4 class="mb-2">Product Attributes</h4>
                                        <div class="table-responsive table--no-card m-b-30">
                                            <table class="table table-bordered table-sm table-striped" id="productAttributeTbl">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>
                                                            <button type="button" class="btn btn-primary btn-sm" id="moreAttr"><i class="fa fa-plus"></i></button>
                                                        </th>
                                                        <th>SKU No</th>
                                                        <th>MRP</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Size</th>
                                                        <th>Color</th>
                                                        <th>Image</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($product->attributes) > 0)
                                                        @foreach ($product->attributes as $index => $value)
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-danger btn-sm removeAttribute" data-id="{{ $value->id }}"><i class="fa fa-minus"></i></button>
                                                                <input type="hidden" name="attr_id[]" class="attr_id" value="{{ $value->id }}">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="sku_no[]" placeholder="SKU.." 
                                                                class="form-control form-control-sm sku_no" value="{{ $value->sku_no }}">                                                            
                                                            </td>
                                                            <td>
                                                                <input type="text" name="mrp[]" placeholder="MRP.." 
                                                                class="form-control form-control-sm mrp" value="{{ $value->mrp }}">                                                            
                                                            </td>
                                                            <td>
                                                                <input type="text" name="price[]" placeholder="MRP.." 
                                                                class="form-control form-control-sm price" value="{{ $value->price }}">                                                            
                                                            </td>
                                                            <td>
                                                                <input type="text" name="qty[]" placeholder="Quantity.." 
                                                                class="form-control form-control-sm qty" value="{{ $value->qty }}">                                                            
                                                            </td>
                                                            <td>
                                                                <select name="size_id[]" class="form-control form-control-sm size_id">
                                                                    @if ($value->size_id)
                                                                        <option value="{{ $value->size_id }}">{{ $value->size->size }}</option>   
                                                                    @else
                                                                        <option value="">--Select Size--</option>                                                                 
                                                                    @endif
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select name="color_id[]" class="form-control form-control-sm color_id">
                                                                    @if ($value->color_id)
                                                                        <option value="{{ $value->color_id }}">{{ $value->color->color }}</option>   
                                                                    @else
                                                                        <option value="">--Select Color--</option>                                                                 
                                                                    @endif
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="file" name="image_attr[]"
                                                                class="form-control form-control-sm image_attr">                                                            
                                                                @if (isset($value->image))
                                                                    <img src="{{ asset('storage/product/product_attr/'. $value->image) }}" alt="Product Image" style="width: 50px;" class="img-fluid mb-1">
                                                                @endif
                                                            </td>
                                                        </tr>                                                        
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @break
        @default
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">{{ $title }}</h2>
                        <a href="{{ route('admin.product.create') }}" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-plus"></i>add</a>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-lg-12">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <table class="table table-striped table-earning table-sm" id="example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Product Slug</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>            
    @endswitch
@endsection

@push('script')
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>

    <script>
        $(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $("#example").DataTable({
                processing: true,
                serverSide: true,
                language: {
                    infoFiltered: ''
                },
                ajax: {
                    url: "{{ route('admin.product.index') }}",
                    type: 'GET'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'prod_name', name: 'prod_name'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'sub_category_id', name: 'sub_category_id'},
                    {data: 'slug', name: 'slug'},
                    {data: 'image', name: 'image'},
                    {data: 'status', name: 'status'},
                    {data: 'manage', name: 'manage', orderable: false, searchable: false},
                ],
                order: [0, 'desc']
            });

            $('#sub_category_id').select2({
                placeholder: 'Search Sub Category...',
                allowClear: true,
                ajax: {
                    url: "{{ route('admin.subcategory-list') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1
                        }
                    },
                    processResults: function (data) {
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination.more
                            }
                        };
                    },
                    cache: true
                }
            });

            $('#brand_id').select2({
                placeholder: 'Search Brand...',
                allowClear: true,
                ajax: {
                    url: "{{ route('admin.brand-list') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1
                        }
                    },
                    cache: true
                }
            });

            $('#tax_id').select2({
                placeholder: 'Search Tax...',
                allowClear: true,
                ajax: {
                    url: "{{ route('admin.tax-list') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1
                        }
                    },
                    cache: true
                }
            });

            bind_select2();

            function bind_select2() {

                $('.size_id').select2({
                    placeholder: 'Search Size...',
                    allowClear: true,
                    ajax: {
                        url: "{{ route('admin.size-list') }}",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                term: params.term || '',
                                page: params.page || 1
                            }
                        },
                        cache: true
                    }
                });

                $('.color_id').select2({
                    placeholder: 'Search Color...',
                    allowClear: true,
                    ajax: {
                        url: "{{ route('admin.color-list') }}",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                term: params.term || '',
                                page: params.page || 1
                            }
                        },
                        cache: true
                    }
                });
            }

            $(document).on('click', '#moreAttr', function(){
                var clonedDiv = $("#productAttributeTbl tr:last");
                clonedDiv.find(".size_id").select2("destroy").removeAttr('data-live-search').removeAttr('data-select2-id').removeAttr('aria-hidden').removeAttr('tabindex');
                clonedDiv.find(".color_id").select2("destroy").removeAttr('data-live-search').removeAttr('data-select2-id').removeAttr('aria-hidden').removeAttr('tabindex');
                var NewDiv = clonedDiv.clone();
                NewDiv.find(".size_id").val("").trigger("change.select2");
                NewDiv.find(".color_id").val("").trigger("change.select2");                
                NewDiv.find(".sku_no").val("");
                NewDiv.find(".mrp").val("");
                NewDiv.find(".price").val("");
                NewDiv.find(".qty").val('');
                NewDiv.find(".image_attr").val('');
                NewDiv.find(".attr_id").val("");
                NewDiv.find(".removeAttribute").attr("data-id", "0");
                NewDiv.find('.img-fluid').remove();
                NewDiv.find('.help-block').remove();
                NewDiv.insertAfter(clonedDiv);
                bind_select2();
            });

            $(document).on('click', '.removeAttribute', function(){
                let removeAttributeLength = $('.removeAttribute').length;
                let id = parseInt($(this).data('id'));
                if(removeAttributeLength === 1) {
                    alert('Sorry! you can not remove all rows');
                } else if(id > 0) {
                    alert('Sorry! you can not remove this row.')
                } else {
                    $(this).closest('tr').remove();
                }
            });

            CKEDITOR.replace('description');
            CKEDITOR.replace('short_desc');
            CKEDITOR.replace('tech_spec');
        });
    </script>
@endpush
