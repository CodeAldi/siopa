@extends('layouts.main')
@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header row">
            <h5 class="card-title col-8 mt-3">
                Halo Admin, selamat datang di Manajemen Pengurus !
            </h5>
            <button type="button" class="btn btn-primary col-4" data-bs-toggle="modal" data-bs-target="#modalCreate">
                <i class="tf-icons bx bx-plus-circle"></i>
                Tambah Pengurus
            </button>
        </div>
    </div>
</div>
<div class="container mt-2">
    <div class="card">

        <div class="table-responsive text-wrap card-body">
            <table class="table" id="dataAset">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>nama</th>
                        <th>nohp</th>
                        <th>alamat</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($pengurus as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->nohp }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <button type="submit" class="dropdown-item btn btn-success mb-1 text-white"
                                        data-bs-toggle="modal" data-bs-target="#modalEdit" data-index="{{ $item }}"
                                        onclick="modalEdit(this)"><i class="bx bx-pencil me-1"></i>
                                        Edit</button>

                                    <button class="dropdown-item btn btn-danger mb-1 text-white" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete" data-index="{{ $item }}"
                                        onclick="modalDelete(this)"><i class="bx bx-x-circle me-1"></i>Hapus</button>
                                </div>
                            </div>
                        </td>
                    </tr>

                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal untuk create -->
<div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" action="{{ route('admin.management.pengurus.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTitle">Tambah pengurus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="email" class="form-label">email</label>
                        <input type="email" id="email" class="form-control" name="email" placeholder="masukan email"
                            autofocus required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="password" class="form-label">password</label>
                        <input type="password" id="password" class="form-control" name="password"
                            placeholder="masukan password" autofocus required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nik" class="form-label">Nik</label>
                        <input type="text" id="nik" class="form-control" name="nik" placeholder="masukan nik" autofocus
                            required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" id="nama" class="form-control" name="name" placeholder="masukan nama"
                            autofocus required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nohp" class="form-label">no hp</label>
                        <input type="text" id="nohp" class="form-control" name="nohp"
                            placeholder="masukan nomor hp, contoh 081223344556" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="alamat" class="form-label">alamat</label>
                        <input type="text" id="alamat" class="form-control" name="alamat"
                            placeholder="masukan alamat lengkap, contoh jl. soekarno-hatta nomor 100, rt 15 rw 05 "
                            required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="tempatLahir" class="form-label">Tempat Lahir</label>
                        <input type="text" id="tempatLahir" class="form-control" name="tempat_lahir"
                            placeholder="masukan kota/kabupaten tempat lahir " required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" id="tanggalLahir" class="form-control" name="tanggal_lahir"
                            placeholder="masukan kota/kabupaten tanggal lahir " required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal untuk Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" action="{{ route('admin.management.anggota.update') }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTitle">Edit Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="id" class="form-label">id</label>
                        <input type="text" id="Editid" class="form-control" name="id" autofocus required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="email" class="form-label">email</label>
                        <input type="email" id="Editemail" class="form-control" name="email" autofocus required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nik" class="form-label">Nik</label>
                        <input type="text" id="Editnik" class="form-control" name="nik" autofocus required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" id="Editnama" class="form-control" name="nama" autofocus required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nohp" class="form-label">no hp</label>
                        <input type="text" id="Editnohp" class="form-control" name="nohp" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="alamat" class="form-label">alamat</label>
                        <input type="text" id="Editalamat" class="form-control" name="alamat" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="tempatLahir" class="form-label">Tempat Lahir</label>
                        <input type="text" id="EdittempatLahir" class="form-control" name="tempat_lahir" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" id="EdittanggalLahir" class="form-control" name="tanggal_lahir" required />
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- modal warning delete --}}
<div class="modal fade" id="modalDelete" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" action="{{ route('admin.management.anggota.delete') }}" method="POST">
            @method('DELETE')
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTitle">Yakin Hapus Anggota ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="Hapusid" class="form-control" name="id" readonly hidden />
                {{-- <div class="row">
                    <div class="col mb-3">
                        <label for="email" class="form-label">email</label>
                        <input type="text" id="Hapusemail" class="form-control" name="email" readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nik" class="form-label">Nik</label>
                        <input type="text" id="HapusNik" class="form-control" name="nik" readonly />
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" id="Hapusname" class="form-control" name="name" readonly />
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@push('page-js')
<script>
    function modalDelete(item) {
    let indexnya = item.getAttribute("data-index");
    const myjson = JSON.parse(indexnya);
    document.getElementById("Hapusid").value = myjson.id;
    document.getElementById("Hapusname").value = myjson.name;
    // document.getElementById("Hapusemail").value = myjson.email;
    // document.getElementById("HapusNik ").value = myjson.nik;
    console.log(myjson);
    
    }
    function modalEdit(item) {
        let indexnya = item.getAttribute("data-index");
        const myjsonEdit = JSON.parse(indexnya);
        document.getElementById("Editid").value = myjsonEdit.id;
        document.getElementById("Editemail").value = myjsonEdit.email;
        document.getElementById("Editnik").value = myjsonEdit.nik;
        document.getElementById("Editnama").value = myjsonEdit.name;
        document.getElementById("Editnohp").value = myjsonEdit.nohp;
        document.getElementById("Editalamat").value = myjsonEdit.alamat;
        document.getElementById("EdittempatLahir").value = myjsonEdit.tempat_lahir;
        document.getElementById("EdittanggalLahir").value = myjsonEdit.tanggal_lahir;
        console.log(myjsonEdit);
    }
    let table = new DataTable('#dataAset', {
        // options
        });
</script>
@endpush