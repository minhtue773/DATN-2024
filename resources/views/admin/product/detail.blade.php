<div class="container my-5">
    <div class="row d-flex justify-content-center align-items-start">
        <div class="col-md-6">
            <img src="{{ asset('uploads/images/product') }}/{{ $product->image }}" alt="" class="img-fluid mb-3 rounded border">
            <div class="previews d-flex justify-content-center" style="gap: 20px">
                @if ($product->productImages->isNotEmpty())
                    @foreach ($product->productImages as $item)
                    <img src="{{ asset('uploads/images/product') }}/{{ $item->image }}" alt="" class="img-thumbnail" style="height: 75px; width:75px">
                    @endforeach
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <h3 class="product-title text-primary">{{ $product->name }}</h3>
            <h6>Danh mục: <span>{{ $product->productCategory->name }}</span></h6>
            <div class="rating mb-3">
                <div class="stars mb-2">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
                <span class="text-muted m-0 mb-3">{{ $product->stock }} còn lại | 77 bình luận</span>
                <span class="d-block mt-1">Trạng thái:
                    @switch($product->status)
                    @case(0) <strong class="text-primary">Đang bán</strong> @break
                    @case(1) <strong class="text-success">Sản phẩm mới</strong> @break
                    @case(2) <strong class="text-info">Sản phẩm hot</strong> @break
                    @case(3) <strong class="text-warning">Sắp hết hàng</strong> @break
                    @case(4) <strong class="text-danger">Đã hết</strong> @break
                    @case(5) <strong class="text-secondary">Ngừng bán</strong> @break
                    @default   
                    <strong class="text-primary">Đang bán</strong>
                    @endswitch
                </span>
            </div>
            <p style="text-align: justify">{!! $product->description !!}</p>
            @if ($product->discount > 0)
                <h5 class="price text-danger">Giá khuyến mãi: <span>{{ number_format(($product->price * (100 - $product->discount) / 100),0,'.','.') }} đ</span></h5>
                <h5 class="price">Giá bán: <s>{{ number_format($product->price,0,'.','.') }} đ</s></h5>
            @else
                <h5 class="price text-danger">Giá bán: <span>{{ number_format($product->price,0,'.','.') }} đ</h5>
            @endif
        </div>
    </div>
</div>
