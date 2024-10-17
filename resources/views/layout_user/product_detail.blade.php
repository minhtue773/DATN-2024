@include('layout_user.menu')

@section('tieude')
    {{ $sp->name }}
@endsection

@include('inc_user.product_detail_a');
    
@include('layout_user.footer')