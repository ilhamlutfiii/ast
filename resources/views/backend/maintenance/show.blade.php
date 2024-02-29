@extends('backend.layouts.master')

@section('main-content')
<div class="card">
  <div class="card-body">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-12">
          @if($maintenances->photo)
          @php
          $photo = explode(',', $maintenances->photo);
          @endphp
          @if(isset($photo[0]))
          <img src="{{$photo[0]}}" class="img-fluid" style="max-width:450px" alt="{{$maintenances->photo}}">
          @else
          <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:450px" alt="thumbnail-default.jpg">
          @endif
          @else
          <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:450px" alt="thumbnail-default.jpg">
          @endif

        </div>
        <div class="col-lg-6 col-12">
          <div class="aset-des">
            <div class="short">
              <h4>{{$maintenances->title}}</h4>
              <p class="description">{!!($maintenances->summary)!!}</p>
            </div>
            <p class="cat">Kategori : <a href="{{route('aset-cat',$maintenances->cat_info['slug'])}}">{{$maintenances->cat_info['title']}}</a></p>
            @if($maintenances->sub_cat_info)
            <p class="cat mt-1">Sub-Kategori : <a href="{{route('aset-sub-cat',[$maintenances->cat_info['slug'],$maintenances->sub_cat_info['slug']])}}">{{$maintenances->sub_cat_info['title']}}</a></p>
            @endif
            <div id="asetBox">
              <p class="aset blink">Perlu Maintenance...!!!</p>
            </div>
            <h5>Keterangan : </h5>
            <p class="keterangan">{{$maintenances->ket_main}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('styles')
<style>
  .aset-info,
  .shipping-info {
    background: #ECECEC;
    padding: 20px;
  }

  .aset-info h4,
  .shipping-info h4 {
    text-decoration: underline;
  }

  #asetBox {
    padding: 10px;
    width: fit-content;
    background-color: #f2f2f2;
    color: red;
  }

  .keterangan {
    color: red;
  }

  @keyframes blink {
    0% {
      opacity: 1;
    }

    50% {
      opacity: 0;
    }

    100% {
      opacity: 1;
    }
  }

  .blink {
    animation: blink 1s infinite;
  }
</style>
@endpush