@extends('backend.layouts.master')

@section('title','pinjam Detail')

@section('main-content')
<div class="card">
  <h5 class="card-header">Pinjam Edit</h5>
  <div class="card-body">
    <form action="{{route('pinjam.update',$pinjam->id)}}" method="POST">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="status">Status :</label>
        <select name="status" id="" class="form-control">
          <option value="Baru" {{($pinjam->status=='Siap Diambil' || $pinjam->status=="Diproses" || $pinjam->status=="Dibatalkan") ? 'disabled' : ''}}  {{(($pinjam->status=='Baru')? 'selected' : '')}}>Baru</option>
          <option value="Diproses" {{($pinjam->status=='Siap Diambil'|| $pinjam->status=="Dibatalkan") ? 'disabled' : ''}}  {{(($pinjam->status=='Diproses')? 'selected' : '')}}>Diproses</option>
          <option value="Siap Diambil" {{($pinjam->status=="Dibatalkan") ? 'disabled' : ''}}  {{(($pinjam->status=='Siap Diambil')? 'selected' : '')}}>Siap Diambil</option>
          <option value="Dibatalkan" {{($pinjam->status=='Siap Diambil') ? 'disabled' : ''}}  {{(($pinjam->status=='Dibatalkan')? 'selected' : '')}}>Dibatalkan</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
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
