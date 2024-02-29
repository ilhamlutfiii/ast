@extends('user.layouts.master')

@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('user.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Pinjam Lists</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($pinjams)>0)
        <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Pinjam No.</th>
              <th>Nama</th>
              <th>Aset</th>
              <th>QTY</th>
              <th>Waktu Pinjam</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pinjams as $pinjam)
                <tr>
                    <td>{{$pinjam->pinjam_number}}</td>
                    <td>{{$pinjam->user->user_nama}}</td>
                    <td>{{$pinjam->aset->title}}</td>
                    <td>{{$pinjam->quantity}}</td>
                    <td>{{$pinjam->created_at->setTimezone('Asia/Jakarta')->format('d M Y')}}, Jam {{$pinjam->created_at->setTimezone('Asia/Jakarta')->format('g : i a')}} </td>
                    <td>
                        @if($pinjam->status=='Baru')
                          <span class="badge badge-primary">{{$pinjam->status}}</span>
                        @elseif($pinjam->status=='Diproses')
                          <span class="badge badge-warning">{{$pinjam->status}}</span>
                        @elseif($pinjam->status=='Siap Diambil')
                          <span class="badge badge-success">{{$pinjam->status}}</span>
                        @else
                          <span class="badge badge-danger">{{$pinjam->status}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('user.pinjam.show',$pinjam->id)}}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="view" data-placement="bottom"><i class="fas fa-eye"></i></a>
                        <form method="POST" action="{{route('user.pinjam.delete',[$pinjam->id])}}">
                          @csrf
                          @method('delete')
                          @if($pinjam->status=='Siap Diambil')
                          <button class="btn btn-danger btn-sm dltBtn" data-id="{{$pinjam->id}}" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                          
                        </form>
                        <form method="POST" action="{{ route('pinjam.return', [$pinjam->id]) }}">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Pengembalian"><i class="fas fa-undo"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
        <span style="float:right">
        <ul class="pagination justify-content-end">
          <li class="page-item {{ $pinjams->previousPageUrl() ? '' : 'disabled' }}">
            <a class="page-link" href="{{ $pinjams->previousPageUrl() ?? '#' }}" rel="prev">Previous</a>
          </li>

          @for ($i = 1; $i <= $pinjams->lastPage(); $i++)
            <li class="page-item {{ ($i == $pinjams->currentPage()) ? 'active' : '' }}">
              <a class="page-link" href="{{ $pinjams->url($i) }}">{{ $i }}</a>
            </li>
            @endfor

            <li class="page-item {{ $pinjams->nextPageUrl() ? '' : 'disabled' }}">
              <a class="page-link" href="{{ $pinjams->nextPageUrl() ?? '#' }}" rel="next">Next</a>
            </li>
        </ul>
      </span>
        @else
          <h6 class="text-center">Peminjaman Kosong!!!</h6>
        @endif
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
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

      $('#order-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[3,4]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){

        }
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
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
