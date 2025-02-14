@extends('layouts.main')
@section('content')
<div class="card shadow">
    <div class="card-header row">
        <h5 class="card-title col-8 mt-3">
            Halo Pengurus, selamat datang di Manajemen Keuangan Organisasi !
        </h5>
        <button type="button" class="btn btn-primary col-4" data-bs-toggle="modal" data-bs-target="#modalCreate">
            <i class="tf-icons bx bx-plus-circle"></i>
            Tambah Catatan Keuangan
        </button>
    </div>
</div>
<div class="row mt-2">
    <div class="col-4">
        <div class="card bg-primary">
            <div class="card-body">
                <h5 class="card-title text-white">Total Uang Kas : Rp.{{ number_format($total) }}</h5>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card bg-success">
            <div class="card-body">
                <h5 class="card-title text-white">Total Uang Masuk : Rp.{{ number_format($masuk) }}</h5>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card bg-danger">
            <div class="card-body">
                <h5 class="card-title text-white">Total Uang Keluar : Rp.{{ number_format($keluar) }}</h5>
            </div>
        </div>
    </div>
</div>
<div class="card mt-2">

    <div class="table-responsive text-wrap card-body">
        <table class="table" id="dataAset">
            <thead>
                <tr>
                    <th>no</th>
                    <th>judul</th>
                    <th>tanggal</th>
                    <th>kategori</th>
                    <th>Nominal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ($keuangan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td class="text-end">Rp{{ number_format($item->nominal) }}</td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
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
<!-- Modal untuk create -->
<div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" action="{{ route('pengurus.keuangan.store') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTitle">Tambah Catatan Keuangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="judul" class="form-label">Catatan Keuangan</label>
                        <input type="text" id="judul" class="form-control" name="judul" placeholder="masukan judul"
                            autofocus required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="kategori" class="form-label">Kategori Kegiatan</label>
                        <select name="kategori" id="kategori" class="form-select">
                            <option value="0" hidden> pilih kategori <kegiatan></kegiatan>
                            </option>
                            <option value="masuk">masuk</option>
                            <option value="keluar">keluar</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="keterangan" class="form-label">keterangan</label>
                        <input type="text" id="keterangan" class="form-control" name="keterangan" placeholder="masukan keterangan"
                            autofocus required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="tanggal" class="form-label">tanggal</label>
                        <input type="date" id="tanggal" class="form-control" name="tanggal" autofocus
                            required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nominal" class="form-label">nominal</label>
                        <input type="number" id="nominal" class="form-control" name="nominal" autofocus
                            required />
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col mb-3">
                        <label for="fotoaset" class="form-label">foto aset</label>
                        <input type="file" id="fotoaset" class="form-control" name="fotoaset" required />
                    </div>
                </div> --}}


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
        <form class="modal-content" action="{{ route('pengurus.keuangan.update') }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTitle">Edit Catatan keuangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="id" class="form-label">id</label>
                        <input type="text" id="Editid" class="form-control" name="id" placeholder="masukan id" autofocus
                            required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" id="Editjudul" class="form-control" name="judul" placeholder="masukan judul" autofocus
                            required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select name="kategori" id="Editkategori" class="form-select">
                            <option value="0" hidden> pilih kategori</option>
                            <option value="masuk">masuk</option>
                            <option value="keluar">keluar</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="keterangan" class="form-label">keterangan</label>
                        <input type="text" id="Editketerangan" class="form-control" name="keterangan" placeholder="masukan keterangan"
                            autofocus required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="tanggal" class="form-label">tanggal</label>
                        <input type="date" id="Edittanggal" class="form-control" name="tanggal" autofocus required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nominal" class="form-label">nominal</label>
                        <input type="number" id="Editnominal" class="form-control" name="nominal" autofocus required />
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col mb-3">
                        <label for="fotoaset" class="form-label">foto aset</label>
                        <input type="file" id="fotoaset" class="form-control" name="fotoaset" required />
                    </div>
                </div> --}}


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
        <form class="modal-content" action="{{ route('pengurus.keuangan.delete') }}" method="POST">
            @method('DELETE')
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTitle">Yakin Hapus Catatan Keuangan ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="judul" class="form-label">judul</label>
                        <input type="text" id="Hapusjudul" class="form-control" name="judul" readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="id" class="form-label">id</label>
                        <input type="text" id="Hapusid" class="form-control" name="id" readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nominal" class="form-label">nominal</label>
                        <input type="text" id="Hapusnominal" class="form-control" name="nominal" readonly />
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col mb-3">
                        <label for="fotoaset" class="form-label">foto aset</label>
                        <input type="file" id="fotoaset" class="form-control" name="fotoaset" required />
                    </div>
                </div> --}}

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
    document.getElementById("Hapusnominal").value = myjson.nominal;
    // document.getElementById("HapusNik ").value = myjson.nik;
    // console.log(myjson);
    
    }
    function modalEdit(item) {
    let indexnya = item.getAttribute("data-index");
    const myjsonEdit = JSON.parse(indexnya);
    // console.log(myjsonEdit);
    document.getElementById("Editid").value = myjsonEdit.id;
    document.getElementById("Editjudul").value = myjsonEdit.judul;
    document.getElementById("Editkategori").value = myjsonEdit.kategori;
    document.getElementById("Editketerangan").value = myjsonEdit.keterangan;
    document.getElementById("Edittanggal").value = myjsonEdit.tanggal;
    document.getElementById("Editnominal").value = myjsonEdit.nominal;
    // // document.getElementById("Editlama_kegiatan").value = myjsonEdit.lama_kegiatan;
    document.getElementById("Editdeskripsi").value = myjsonEdit.deskrispsi;
    }
    let table = new DataTable('#dataAset', {
        // options
        });
</script>
@endpush