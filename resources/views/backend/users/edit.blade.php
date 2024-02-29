@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit User</h5>
    <div class="card-body">
      <form method="post" action="{{route('users.update',$users->id)}}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">User NID</label>
        <input id="inputTitle" type="text" name="user_nid" placeholder="Masukkan User NID ..."  value="{{$users->user_nid}}" class="form-control">
        @error('user_nid')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Nama User</label>
        <input id="inputTitle" type="text" name="user_nama" placeholder="Masukkan Nama User ..."  value="{{$users->user_nama}}" class="form-control">
        @error('user_nama')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
            <label for="jabatan" class="col-form-label">Jabatan</label>
            <select name="jabatan" class="form-control">
                <option value="">---- Pilih Jabatan ----</option>
                @foreach($jabatans as $jabatan)
                        <option value="{{ $jabatan->jabatan_id }}" {{ $jabatan->jabatan_id == $users->jabatan_id ? 'selected' : '' }}>
                            {{ $jabatan->jabatan_name }}
                        </option>
                @endforeach
            </select>
          @error('jabatan_name')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>

          <div class="form-group">
            <label for="bidang" class="col-form-label">Bidang</label>
            <select name="bidang" class="form-control">
                <option value="">---- Pilih Bidang ----</option>
                @foreach($bidangs as $bidang)
                        <option value="{{ $bidang->bidang_id }}" {{ $bidang->bidang_id == $users->bidang_id ? 'selected' : '' }}>
                            {{ $bidang->bidang_name }}
                        </option>
                @endforeach
            </select>
          @error('bidang_name')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>

          <div class="form-group">
            <label for="fungsi" class="col-form-label">Fungsi</label>
            <select name="fungsi" class="form-control">
                <option value="">---- Pilih Fungsi ----</option>
                @foreach($fungsis as $fungsi)
                        <option value="{{ $fungsi->fungsi_id }}" {{ $fungsi->fungsi_id == $users->fungsi_id ? 'selected' : '' }}>
                            {{ $fungsi->fungsi_name }}
                        </option>
                @endforeach
            </select>
          @error('fungsi_name')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>

          {{-- <div class="form-group"> 
            <label for="inputPassword" class="col-form-label">Password</label>
          <input id="inputPassword" type="password" name="password" placeholder="Enter password"  value="{{$users->password}}" class="form-control">
          @error('password')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div> --}}
        
        <div class="form-group">
        <label for="inputPhoto" class="col-form-label">Photo</label>
        <div class="input-group">
            <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> Pilih
                </a>
            </span>
            <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$users->photo}}">
        </div>
        <img id="holder" style="margin-top:15px;max-height:100px;">
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        @php 
        $roles=DB::table('userss')->select('role')->where('id',$users->id)->get();
        // dd($roles);
        @endphp
        <div class="form-group">
            <label for="role" class="col-form-label">Role</label>
            <select name="role" class="form-control">
                <option value="">---- Pilih Role ----</option>
                @foreach($roles as $role)
                    <option value="{{$role->role}}" {{(($role->role=='admin') ? 'selected' : '')}}>Admin</option>
                    <option value="{{$role->role}}" {{(($role->role=='user') ? 'selected' : '')}}>User</option>
                @endforeach
            </select>
          @error('role')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>

          <div class="form-group">
            <label for="status" class="col-form-label">Status</label>
            <select name="status" class="form-control">
                <option value="active" {{(($users->status=='active') ? 'selected' : '')}}>Active</option>
                <option value="inactive" {{(($users->status=='inactive') ? 'selected' : '')}}>Inactive</option>
            </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>
          
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>
@endpush