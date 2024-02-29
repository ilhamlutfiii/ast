@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Tambah User</h5>
    <div class="card-body">
      <form method="post" action="{{route('users.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">User NID</label>
        <input id="inputTitle" type="text" name="user_nid" placeholder="Masukkan User NID ..."  value="{{old('user_nid')}}" class="form-control">
        @error('user_nid')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Nama User</label>
        <input id="inputTitle" type="text" name="user_nama" placeholder="Masukkan Nama User ..."  value="{{old('user_nama')}}" class="form-control">
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="jabatan" class="col-form-label">Jabatan</label>
          <select name="jabatan_id" class="form-control" required>
          <option value="">---- Pilih Jabatan ----</option>
                    @foreach ($jabatans as $jabatan)
                        <option value="{{ $jabatan->jabatan_id }}">{{ $jabatan->jabatan_name }}</option>
                    @endforeach
                </select>
        @error('jabatan_name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="jabatan" class="col-form-label">bidang</label>
          <select name="bidang_id" class="form-control" required>
          <option value="">---- Pilih Bidang ----</option>
                    @foreach ($bidangs as $bidang)
                        <option value="{{ $bidang->bidang_id }}">{{ $bidang->bidang_name }}</option>
                    @endforeach
                </select>
        @error('bidang_name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="fungsi" class="col-form-label">fungsi</label>
          <select name="fungsi_id" class="form-control" required>
          <option value="">---- Pilih Fungsi ----</option>
                    @foreach ($fungsis as $fungsi)
                        <option value="{{ $fungsi->fungsi_id }}">{{ $fungsi->fungsi_name }}</option>
                    @endforeach
                </select>
        @error('fungsi_name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>


        <div class="form-group">
            <label for="inputPassword" class="col-form-label">Password</label>
          <input id="inputPassword" type="password" name="password" placeholder="Masukkan Password"  value="{{old('password')}}" class="form-control">
          @error('password')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
        <label for="inputPhoto" class="col-form-label">Photo</label>
        <div class="input-group">
            <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> Choose
                </a>
            </span>
            <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}">
        </div>
        <img id="holder" style="margin-top:15px;max-height:100px;">
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        @php 
        $roles=DB::table('userss')->select('role')->get();
        @endphp
        <div class="form-group">
            <label for="role" class="col-form-label">Role</label>
            <select name="role" class="form-control">
                <option value="">---- Pilih Role ----</option>
                @foreach($roles as $role)
                    <option value="{{$role->role}}">{{$role->role}}</option>
                @endforeach
            </select>
          @error('role')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>

          <div class="form-group">
            <label for="status" class="col-form-label">Status</label>
            <select name="status" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>

        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Submit</button>
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