@extends('backend.layouts.master')

@section('main-content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="row">
    <div class="col-md-12">
      @include('backend.layouts.notification')
    </div>
  </div>
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left">Maintenance</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      @if(count($maintenances)>0)
      <table class="table table-bordered" id="maintenance-dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nama maintenance</th>
            <th>Parent Kategori</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Photo</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          @foreach($maintenances as $maintenance)
          @php
          $sub_cat_info=DB::table('categories')->select('title')->where('id',$maintenance->child_cat_id)->get();
          // dd($sub_cat_info);
          @endphp
          <tr>
            <td>{{$maintenance->title}}</td>
            <td>{{$maintenance->cat_info['title']}}</td>
            <td>{{$maintenance->sub_cat_info['title']}}</td>
            <td>
              @if($maintenance->stock>0)
              <span class="badge badge-primary">{{$maintenance->stock}}</span>
              @else
              <span class="badge badge-danger">{{$maintenance->stock}}</span>
              @endif
            </td>
            <td>
              @if($maintenance->photo)
              @php
              $photo=explode(',',$maintenance->photo);
              // dd($photo);
              @endphp
              <img src="{{$photo[0]}}" class="img-fluid" style="max-width:80px" alt="{{$maintenance->photo}}">
              @else
              <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:80px" alt="avatar.png">
              @endif
            </td>
            <td>
              @if($maintenance->status=='active')
              <span class="badge badge-success">{{$maintenance->status}}</span>
              @else
              <span class="badge badge-warning">{{$maintenance->status}}</span>
              @endif
            </td>
            <td>
              <span><a href="{{route('maintenance.show',$maintenance->id)}}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Prediksi" data-placement="bottom"><i class="fas fa-eye"></i></a></span>

              <a href="{{route('maintenance.edit',$maintenance->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>

              <form method="POST" action="{{route('maintenance.destroy',[$maintenance->id])}}">
                @csrf
                @method('delete')
                <button class="btn btn-danger btn-sm dltBtn" data-id="{{$maintenance->id}}" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
              </form>
              <a href="{{route('maintenance.edit',$maintenance->id)}}" class="btn btn-primary btn-sm float-left mr-1" data-toggle="tooltip" title="edit" data-placement="bottom">LOG HISTORY</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <span style="float:right">{{$maintenances->links()}}</span>
      @else
      <h6 class="text-center">No maintenances found!!! Please create maintenance</h6>
      @endif
    </div>
  </div>
</div>
@endsection

@push('styles')
<link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<style>
  div.dataTables_wrapper div.dataTables_paginate {
    display: none;
  }

  .zoom {
    transition: transform .2s;
    /* Animation */
  }

  .zoom:hover {
    transform: scale(5);
  }
</style>
@endpush

@push('scripts')

<!-- Page level plugins -->
<script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
<script>
  $('#maintenance-dataTable').DataTable({
    "scrollX": false,
    "columnDefs": [{
      "orderable": false,
      "targets": [5, 6]
    }]
  });


  // Sweet alert

  function deleteData(id) {

  }
</script>
<script>
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('.dltBtn').click(function(e) {
      var form = $(this).closest('form');
      var dataID = $(this).data('id');
      // alert(dataID);
      e.preventDefault();
      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this data!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            form.submit();
          } else {
            swal("Your data is safe!");
          }
        });
    })
  })
</script>
@endpush