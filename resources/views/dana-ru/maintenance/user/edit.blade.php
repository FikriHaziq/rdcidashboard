@component("layouts.app")
@slot("module") Maintenance @endslot
@slot("submodule") User @endslot
@push('custom-css')
@endpush
@slot('content')
<x-title>User</x-title>
<div class="row gap-y-6 mt-5 justify-content-center">
    <div class="intro-y col-12 col-xl-8">
        <form id="form_1" action="{{ route('dana-ru.maintenance.user.update', $user->id) }}" method="post">
        @csrf
            <div class="intro-y box p-5">
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="name">NAME</label>
                    </div>
                    <div class="g-col-9">
                        <input id="name" name="name" type="text" value="{{ $user->name }}" class="form-control @error('name') border-theme-6 @enderror" placeholder="Name" aria-describedby="name" disabled>
                        @error('name')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="email">EMAIL</label>
                    </div>
                    <div class="g-col-9">
                        <input id="email" name="email" type="text" value="{{ $user->email }}" class="form-control @error('email') border-theme-6 @enderror" placeholder="Email" aria-describedby="email" disabled>
                        @error('email')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="role_radis">ROLE RADIS</label>
                    </div>
                    <div class="g-col-9">
                        <input id="role_radis" name="role_radis" type="text" value="{{ $role_radis_label }}" class="form-control @error('role_radis') border-theme-6 @enderror" placeholder="Role Radis" aria-describedby="role_radis" disabled>
                        @error('role_radis')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="faculty_code">FACULTY</label>
                    </div>
                    <div class="g-col-9">
                        <input id="faculty_code" name="faculty_code" type="text" value="{{ $user->faculty_code }}" class="form-control @error('faculty_code') border-theme-6 @enderror" placeholder="Faculty" aria-describedby="faculty_code" disabled>
                        @error('faculty_code')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="role">SYSTEM ROLE</label>
                    </div>
                    <div class="g-col-9">
                        <select id="role" name="role" class="form-select @error('role') border-theme-6 @enderror">
                            <option value="">--Sila pilih--</option>
                            <option value="super_admin" @if($user->role == "super_admin") selected @endif>Super Admin</option>
                            <option value="admin" @if($user->role == "admin") selected @endif>Admin</option>
                            <option value="faculty" @if($user->role == "faculty") selected @endif>Faculty</option>
                        </select>
                        @error('role')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="grid columns-12 gap-6 pb-2">
                    <div class="g-col-3 d-flex align-items-center justify-content-end">
                        <label for="status">STATUS</label>
                    </div>
                    <div class="g-col-9">
                        <select id="status" name="status" class="form-select @error('status') border-theme-6 @enderror">
                            <option value="">--Sila pilih--</option>
                            <option value="verified" @if($user->status == "verified") selected @endif selected>Verified</option>
                            <option value="pending" @if($user->status == "pending") selected @endif>Pending</option>
                        </select>
                        @error('status')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="mt-5 d-flex justify-content-end">
                    <a href="{{ route('dana-ru.maintenance.user') }}" class="btn btn-light me-3">Cancel</a>
                    <button type="submit" form="form_1" class="btn btn-primary" name="submit_btn" value="0">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endslot
@push('custom-js')
@endpush
@endcomponent