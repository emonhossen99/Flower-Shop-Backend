@extends('layouts.app')
@section('title', $title)
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/image-style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/image-gallary.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/multiple.css') }}">
    <style>
        #product-image-size-guide {
            font-size: 12px;
            color: #f7560e;
        }
    </style>
@endpush
@section('content')
    <section>
        <div class="card">
            <div class="card-heading">
                <h3 class="p-2">{{ __f('Products Edit Title') }}</h3>
            </div>
            <div class="card-body">
                <form id="productEditForm" action="{{ route('admin.product.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="update_id" value="{{ $product->id }}">
                    <div class="row g-4">
                        <div class="col-md-9">
                            <div class="row">
                                <x-form.textbox labelName="{{ __f('Product Name Label Title') }}"
                                    parantClass="col-12 col-md-12" name="name" required="required"
                                    placeholder="{{ __f('Product Name Placeholder') }}" errorName="name" class="py-2"
                                    value="{!! $product->name ?? old('name') !!}"></x-form.textbox>
                            </div>
                            <div class="row mt-2">
                                <x-form.textarea labelName="{{ __f('Product Short Description Label Title') }}"
                                    class="summernote" parantClass="col-md-12" id="summernote" name="short_description"
                                    required="required" errorName="short_description"
                                    value="{{ $product->short_description ?? old('short_description') }}"></x-form.textarea>
                            </div>
                            <div class="row mt-2">
                                <x-form.textarea labelName="{{ __f('Product Description Label Title') }}"
                                    class="summernote" parantClass="col-md-12" id="summernote" name="description"
                                    required="required" errorName="description"
                                    value="{{ $product->description ?? old('description') }}"></x-form.textarea>
                            </div>

                            <div class="row mt-2">
                                <x-form.textbox labelName="{{ __f('Product Price Label Title') }}"
                                    parantClass="col-12 col-md-6" name="price" type="text" required="required"
                                    placeholder="{{ __f('Product Price Placeholder') }}" errorName="price" class="py-2"
                                    value="{{ $product->price ?? old('price') }}">
                                </x-form.textbox>

                                <x-form.textbox labelName="{{ __f('Product Discount Price Label Title') }}"
                                    parantClass="col-12 col-md-6" type="number" name="discount_price"
                                    placeholder="{{ __f('Product Discount Price Placeholder') }}"
                                    errorName="discount_price" class="py-2"
                                    value="{{ $product->discount_price ?? old('discount_price') }}">
                                </x-form.textbox>
                            </div>
                            <div class="row mt-2">
                                <x-form.textbox labelName="{{ __f('Product Stock Qty Label Title') }}"
                                    parantClass="col-12 col-md-6" name="product_stock_qty"
                                    placeholder="{{ __f('Product Stock Qty Placeholder') }}" errorName="product_stock_qty"
                                    class="py-2"
                                    value="{{ convertToLocaleNumber($product->product_stock_qty ?? old('product_stock_qty')) }}"
                                    type="number" step="1" min="0"> </x-form.textbox>

                                <x-form.textbox labelName="{{ __f('Product Sku Label Title') }}"
                                    parantClass="col-12 col-md-6" name="product_sku"
                                    placeholder="{{ __f('Product Sku Placeholder') }}" errorName="product_sku"
                                    class="py-2" value="{{ $product->product_sku ?? old('product_sku') }}"
                                    type="text"> </x-form.textbox>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="upload__box">
                                        <div class="upload__btn-box mb-3">
                                            <label class="upload__btn">
                                                <p class="mb-0">{{ __f('Upload images Title') }}</p>
                                                <input type="file" multiple name="product_gallery[]"
                                                    data-max_length="20" class="upload__inputfile" accept="image/*">
                                            </label>
                                        </div>
                                        <div class="upload__img-wrap d-flex flex-wrap gap-3">
                                            @isset($imageGallery)
                                                @forelse ($imageGallery as $image)
                                                    <div class="position-relative shadow-lg"
                                                        style="width: 100px; height: 100px; margin-right: 10px;">
                                                        <img src="{{ asset($image->image_path) }}" width="100px"
                                                            height="100px" style="border-radius: 5px;" alt="image">
                                                        <span class="removeImage" onclick="deleteImage({{ $image->id }})"
                                                            width="100px" height="100px"
                                                            style="border-radius: 5px; position: absolute; top: -30px; right: -8px;cursor: pointer; font-size: 30px; color: #3b7ddd;">×
                                                        </span>
                                                    </div>
                                                @empty
                                                @endforelse
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row mt-2">
                                <x-form.selectbox parantClass="col-12 col-md-12" class="form-control py-2" name="status"
                                    required="required" labelName="{{ __f('Status Label Title') }}" errorName="status">
                                    <option {{ $product->status == '1' ? 'selected' : '' }}
                                        value="{{ $product->status }}">
                                        {{ __f('Status Publish Title') }}
                                    </option>
                                    <option {{ $product->status == '0' ? 'selected' : '' }}
                                        value="{{ $product->status }}">
                                        {{ __f('Status Pending Title') }}
                                    </option>
                                </x-form.selectbox>
                            </div>
                            <div class="row mt-2">
                                <x-form.textbox labelName="{{ __f('Product Tag Label Title') }}" parantClass="col-12 col-md-12" name="tag"
                                    placeholder="{{ __f('Product Tag Label Placeholder') }}" errorName="tag" class="py-2"
                                    value="{{  $product->tag ?? old('tag') }}" type="text" ></x-form.textbox>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label class="text-dark font-weight-medium">{{ __f('Image Label Title') }} <span
                                            id="product-image-size-guide">({{ __f('Product Image Dimensions') }})</span></label>
                                    <div>
                                        <label class="first__picture" for="first__image" tabIndex="0">
                                            <span class="picture__first"></span>
                                        </label>
                                        <input type="file" name="product_image" id="first__image" accept="image/*">
                                        <span class="text-danger error-text product_image-error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="form-group">
                                    <label class="required">{{ __f('Product Categories Title') }}</label>
                                    <ul class="list-unstyled show-category-list">
                                        @php
                                            $getCategoris = $product->categories->pluck('id');
                                        @endphp
                                        @foreach ($categories as $category)
                                            <li>
                                                <input type="checkbox" class="parent-category"
                                                    id="category_{{ $category->id }}" name="productcategory_id[]"
                                                    value="{{ $category->id }}"
                                                    {{ in_array($category->id, $getCategoris->toArray()) ? 'checked' : '' }}>
                                                <label for="category_{{ $category->id }}">{{ $category->name }}</label>
                                                @if ($category->subcategories->count() > 0)
                                                    <ul class="ml-4 list-unstyled-second">
                                                        @foreach ($category->subcategories as $subcategory)
                                                            <li>
                                                                <input type="checkbox" class="subcategory"
                                                                    id="subcategory_{{ $subcategory->id }}"
                                                                    name="productcategory_id[]"
                                                                    value="{{ $subcategory->id }}"
                                                                    data-parent="{{ $category->id }}"
                                                                    {{ in_array($subcategory->id, $getCategoris->toArray()) ? 'checked' : '' }}>
                                                                <label
                                                                    for="subcategory_{{ $subcategory->id }}">{{ $subcategory->name }}</label>
                                                                @php
                                                                    $megacategories = DB::table('categories')
                                                                        ->where('parent_id', $category->id)
                                                                        ->where('submenu_id', $subcategory->id)
                                                                        ->get();
                                                                @endphp
                                                                @if ($megacategories->count() > 0)
                                                                    <ul class="ml-4 list-unstyled-second">
                                                                        @foreach ($megacategories as $megacategorie)
                                                                            <li>
                                                                                <input type="checkbox"
                                                                                    class="megacategorie"
                                                                                    id="megacategorie_{{ $megacategorie->id }}"
                                                                                    name="productcategory_id[]"
                                                                                    value="{{ $megacategorie->id }}"
                                                                                    data-parent="{{ $subcategory->id }}"
                                                                                    {{ in_array($megacategorie->id, $getCategoris->toArray()) ? 'checked' : '' }}>
                                                                                <label
                                                                                    for="megacategorie_{{ $megacategorie->id }}">{{ $megacategorie->name }}</label>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                    <span class="text-danger error-text productcategory_id-error"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end align-items-center mt-2">
                        <button type="submit" class="btn btn-primary">
                            <div class="spinner-border text-light d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>{{ __f('Submit Title') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(function() {
            ImagePriviewInsert('first__image', 'picture__first', '{{ __f('Product Image Placeholder') }}');
        });

        var productimage = "{{ $product->product_image ?? '' }}";

        if (productimage != '') {
            var myFData = "{{ asset($product->product_image ?? '') }}";
            $(function() {
                ImagePriviewUpdate('first__image', 'picture__first', '{{ __f('Product Image Placeholder') }}',
                    myFData);
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            var projectRedirectUrl = "{{ route('admin.product.index') }}";

            $('#productEditForm').on('submit', function(e) {
                e.preventDefault();
                $('.spinner-border').removeClass('d-none');
                $('.error-text').text('');
                let formData = new FormData(this);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 'success') {
                            flashMessage(res.status, res.message);
                            setTimeout(() => {
                                window.location.href = projectRedirectUrl;
                            }, 100);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('.spinner-border').addClass('d-none');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '-error').text(value[0]);
                            });
                        } else {
                            $('.spinner-border').addClass('d-none');
                            console.log('Something went wrong. Please try again.');
                        }
                    }
                });
            });
        });
        $(document).ready(function() {
            const container = $("#select-container");
            $(document).on("click", ".add-btn", function() {
                const newRow = `<div class="row select-row">
                <x-form.selectbox parantClass="col-12 col-md-6" class="form-control py-2" name="colorattributes[]" labelName="Select Color" errorName="colorattributes">
                    <option value="">Select Color</option>
                    @isset($colorattributes)
                        @forelse ($colorattributes->options as $option)
                            <option value="{{ $option->id ?? '' }}">{{ $option->attribute_option ?? '' }}</option>
                        @empty
                            <option value="" disabled class="text-danger"> Create Attribute and name is (Color)</option>
                        @endforelse
                    @else
                        <option value="" disabled class="text-danger"> Create Attribute and name is (Color)</option>
                    @endisset
                </x-form.selectbox>
                <x-form.selectbox parantClass="col-12 col-md-5" class="form-control py-2" name="sizeattributes[]" labelName="Select Size" errorName="sizeattributes">
                    <option value="">Select Size</option>
                    @isset($sizeattributes)
                        @forelse ($sizeattributes->options as $option)
                            <option value="{{ $option->id ?? '' }}">{{ $option->attribute_option ?? '' }}</option>
                        @empty
                            <option value="" disabled class="text-danger"> Create Attribute and name is (Size)</option>
                        @endforelse
                    @else
                        <option value="" disabled class="text-danger"> Create Attribute and name is (Size)</option>
                    @endisset
                </x-form.selectbox>
                <div class="col-1 col-md-1 mt-4">
                    <button type="button" id="attribute-delete-btn" class="btn btn-danger remove-btn">x</button>
                </div>
            </div>`;
                container.append(newRow);
            });

            $(document).on("click", ".remove-btn", function() {
                $(this).closest(".select-row").remove();
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const uploadInput = document.querySelector(".upload__inputfile");
            const previewContainer = document.querySelector(".upload__img-preview");
            const maxFiles = Number(uploadInput.getAttribute("data-max_length")) || 20;

            uploadInput.addEventListener("change", (event) => {
                const files = event.target.files;
                previewContainer.innerHTML = "";

                if (files.length > maxFiles) {
                    flashMessage('warning', `You can upload a maximum of ${maxFiles} images.`);
                    return;
                }

                Array.from(files).forEach((file) => {
                    if (!file.type.startsWith("image/")) {
                        flashMessage('warning', "Only image files are allowed.");
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const previewBox = document.createElement("div");
                        previewBox.className = "position-relative shadow-lg";
                        previewBox.style.width = "100px";
                        previewBox.style.height = "100px";
                        previewBox.style.marginRight = "10px";
                        previewBox.style.display = "inline-block";

                        const img = document.createElement("img");
                        img.src = e.target.result;
                        img.width = 100;
                        img.height = 100;
                        img.style.borderRadius = "5px";

                        const closeBtn = document.createElement("span");
                        closeBtn.textContent = "×";
                        closeBtn.style.position = "absolute";
                        closeBtn.style.top = "-10px";
                        closeBtn.style.right = "-10px";
                        closeBtn.style.cursor = "pointer";
                        closeBtn.style.fontSize = "28px";
                        closeBtn.style.color = "red";

                        closeBtn.addEventListener("click", () => {
                            previewContainer.removeChild(
                                previewBox);
                        });

                        previewBox.appendChild(img);
                        previewBox.appendChild(closeBtn);

                        previewContainer.appendChild(previewBox);
                    };

                    reader.readAsDataURL(file);
                });
            });
        });

        function deleteImage(imageId) {
            Swal.fire({
                title: "Are you sure? delete this item",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/gallery-image/${imageId}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            if (res.status === 'success') {
                                flashMessage(res.status, res.message);
                                location.reload();
                            } else {
                                console.log("Failed to delete the image. Try again.");
                            }
                        },
                        error: function(err) {
                            console.log("Something went wrong!");
                        }
                    });
                }
            });

        }
        $(document).ready(function() {
            // When a megacategory is clicked
            $(".megacategorie").change(function() {
                let subcategoryId = $(this).data("parent");
                let parentCategoryId = $("#subcategory_" + subcategoryId).data("parent");

                if ($(this).is(":checked")) {
                    $("#subcategory_" + subcategoryId).prop("checked", true);
                    $("#category_" + parentCategoryId).prop("checked", true);
                } else {
                    // Uncheck subcategory if no megacategories are selected
                    if ($(".megacategorie[data-parent='" + subcategoryId + "']:checked").length === 0) {
                        $("#subcategory_" + subcategoryId).prop("checked", false);
                    }

                    // Uncheck parent category if no subcategories are selected
                    if ($(".subcategory[data-parent='" + parentCategoryId + "']:checked").length === 0) {
                        $("#category_" + parentCategoryId).prop("checked", false);
                    }
                }
            });

            // When a subcategory is clicked
            $(".subcategory").change(function() {
                let parentCategoryId = $(this).data("parent");

                if ($(this).is(":checked")) {
                    $("#category_" + parentCategoryId).prop("checked", true);
                } else {
                    // Uncheck parent category if no other subcategories are selected
                    if ($(".subcategory[data-parent='" + parentCategoryId + "']:checked").length === 0) {
                        $("#category_" + parentCategoryId).prop("checked", false);
                    }
                }
            });

            // When a parent category is clicked
            $(".parent-category").change(function() {
                let categoryId = $(this).val();
                let isChecked = $(this).is(":checked");

                // This ensures only the parent category is selected without affecting subcategories
                $(".subcategory[data-parent='" + categoryId + "']").each(function() {
                    if (!isChecked) {
                        $(this).prop("checked", false);
                        $(".megacategorie[data-parent='" + $(this).val() + "']").prop("checked",
                            false);
                    }
                });
            });
        });
    </script>
@endpush
