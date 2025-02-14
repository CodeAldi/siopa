@extends('layouts.main')
@section('content')
@if (Auth()->user()->hasRole('pengurus'))
<div class="container">
    <div class="card shadow">
        <div class="card-header row">
            <h5 class="card-title col-8 mt-3">
                Halo Pengurus, selamat datang di Manajemen Pengumuman !
            </h5>
            <button type="button" class="btn btn-primary col-4" data-bs-toggle="modal" data-bs-target="#modalCreate">
                <i class="tf-icons bx bx-plus-circle"></i>
                Tambah Pengumuman
            </button>
        </div>
    </div>
</div>
@endif
<div class="container mt-2">
    <div class="card">

        <div class="table-responsive text-wrap card-body">
            <table class="table" id="dataAset" >
                <thead>
                    <tr>
                        <th>no</th>
                        <th>Judul</th>
                        <th>lokasi</th>
                        <th>tanggal</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($pengumuman as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->lokasi }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <button type="submit" class="dropdown-item btn btn-primary mb-1 text-white"
                                        data-bs-toggle="modal" data-bs-target="#modalLihat" data-index="{{ $item }}"
                                        onclick="modalLihat(this)"><i class="bx bx-info-circle me-1"></i>
                                        Lihat</button>
                                    @if (Auth()->user()->hasRole('pengurus'))
                                    <button type="submit" class="dropdown-item btn btn-success mb-1 text-white"
                                        data-bs-toggle="modal" data-bs-target="#modalEdit" data-index="{{ $item }}"
                                        onclick="modalEdit(this)"><i class="bx bx-pencil me-1"></i>
                                        Edit</button>

                                    <button class="dropdown-item btn btn-danger mb-1 text-white" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete" data-index="{{ $item }}"
                                        onclick="modalDelete(this)"><i class="bx bx-x-circle me-1"></i>Hapus</button>
                                    @endif
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
        <form class="modal-content" action="{{ route('pengurus.pengumuman.store') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTitle">Tambah Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="judul" class="form-label">Judul Pengumuman</label>
                        <input type="text" id="judul" class="form-control" name="judul"
                            placeholder="masukan judul pengumuman " required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="lokasi" class="form-label">lokasi <span class="text-secondary">(optional)</span></label>
                        <input type="text" id="lokasi" class="form-control" name="lokasi"
                            placeholder="masukan lokasi (optional) "/>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="tanggal" class="form-label">Tanggal <span class="text-secondary">(optional)</span></label>
                        <input type="date" id="tanggal" class="form-control" name="tanggal" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="isi" class="form-label">Isi pengumuman</label>
                        <textarea name="isi" class="form-control" id="isi" cols="30" rows="5"></textarea>
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
<!-- Modal untuk Lihat -->
<div class="modal fade" id="modalLihat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTitle">Pengumuman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="id" class="form-label">id</label>
                        <input type="text" id="Lihatid" class="form-control" name="id" readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="judul" class="form-label">Judul Pengumuman</label>
                        <input type="text" id="Lihatjudul" class="form-control" name="judul" readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="lokasi" class="form-label">lokasi <span class="text-secondary">(optional)</span></label>
                        <input type="text" id="Lihatlokasi" class="form-control" name="lokasi" readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="tanggal" class="form-label">Tanggal <span class="text-secondary">(optional)</span></label>
                        <input type="date" id="Lihattanggal" class="form-control" name="tanggal" readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="isi" class="form-label">Isi pengumuman</label>
                        <textarea name="isi" class="form-control" id="Lihatisi" cols="30" rows="5" readonly></textarea>
                    </div>
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal untuk Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" action="{{ route('pengurus.pengumuman.update') }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTitle">Edit Pengumuman</h5>
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
                        <label for="judul" class="form-label">Judul Pengumuman</label>
                        <input type="text" id="Editjudul" class="form-control" name="judul" placeholder="masukan judul pengumuman "
                            required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="lokasi" class="form-label">lokasi <span class="text-secondary">(optional)</span></label>
                        <input type="text" id="Editlokasi" class="form-control" name="lokasi" placeholder="masukan lokasi (optional) " />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="tanggal" class="form-label">Tanggal <span class="text-secondary">(optional)</span></label>
                        <input type="date" id="Edittanggal" class="form-control" name="tanggal" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="isi" class="form-label">Isi pengumuman</label>
                        <textarea name="isi" class="form-control" id="Editisi" cols="30" rows="5"></textarea>
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
        <form class="modal-content" action="{{ route('pengurus.pengumuman.delete') }}" method="POST">
            @method('DELETE')
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTitle">Yakin Pengumuman ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="Hapusid" class="form-control" name="id" readonly hidden />
                <div class="row">
                    <div class="col mb-3">
                        <label for="judul" class="form-label">judul</label>
                        <input type="text" id="Hapusjudul" class="form-control" name="judul" readonly />
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
    document.getElementById("Hapusjudul").value = myjson.judul;
    // document.getElementById("Hapusemail").value = myjson.email;
    // document.getElementById("HapusNik ").value = myjson.nik;
    console.log(myjson);
    
    }
    function modalLihat(item) {
        let indexnya = item.getAttribute("data-index");
        const myjsonLihat = JSON.parse(indexnya);
        document.getElementById("Lihatid").value = myjsonLihat.id;
        document.getElementById("Lihatjudul").value = myjsonLihat.judul;
        document.getElementById("Lihattanggal").value = myjsonLihat.tanggal;
        document.getElementById("Lihatlokasi").value = myjsonLihat.lokasi;
        document.getElementById("Lihatisi").value = myjsonLihat.isi;
        console.log(myjsonEdit);
    }
    function modalEdit(item) {
        let indexnya = item.getAttribute("data-index");
        const myjsonEdit = JSON.parse(indexnya);
        document.getElementById("Editid").value = myjsonEdit.id;
        document.getElementById("Editjudul").value = myjsonEdit.judul;
        document.getElementById("Edittanggal").value = myjsonEdit.tanggal;
        document.getElementById("Editlokasi").value = myjsonEdit.lokasi;
        document.getElementById("Editisi").value = myjsonEdit.isi;
        console.log(myjsonEdit);
    }
    let table = new DataTable('#dataAset', {
        // options
        });
</script>
@endpush