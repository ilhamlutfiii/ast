@extends('backend.layouts.master')

@section('title','Pinjam Detail')

@section('main-content')
<div class="card">
  <div class="card-body">
    @if($pinjam)
    <table class="table table-striped table-hover">
      <thead>
        <tr>
            <th>Pinjam No.</th>
            <th>Name</th>
            <th>Aset</th>
            <th>Waktu Pinjam</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>{{$pinjam->pinjam_number}}</td>
            <td>{{$pinjam->user->user_nama}}</td>
            <td>{{$pinjam->aset->title}}</td>
            <td>{{$pinjam->created_at->setTimezone('Asia/Jakarta')->format('d M Y')}}, jam {{$pinjam->created_at->setTimezone('Asia/Jakarta')->format('g : i a')}} </td>
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
                <a href="{{route('pinjam.edit',$pinjam->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                <form method="POST" action="{{route('pinjam.destroy',[$pinjam->id])}}">
                  @csrf
                  @method('delete')
                      <button class="btn btn-danger btn-sm dltBtn" data-id="{{$pinjam->id}}" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                </form>
            </td>
        </tr>
      </tbody>
    </table>
    @endif

  </div>
</div>
@endsection

@push('styles')
<style>
    .pinjam-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .pinjam-info h4,.shipping-info h4{
        text-decoration: underline;
    }

</style>
@endpush
