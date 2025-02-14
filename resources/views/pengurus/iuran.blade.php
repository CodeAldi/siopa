@extends('layouts.main')
@section('content')
<div class="card shadow">
    <div class="card-header row">
        <h5 class="card-title col-8 mt-3">
            Halo Pengurus, selamat datang di Manajemen Iuran Kas Anggota !
        </h5>
        <button type="button" class="btn btn-primary col-4" data-bs-toggle="modal" data-bs-target="#modalCreate">
            <i class="tf-icons bx bx-plus-circle"></i>
            Tambah
        </button>
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
                    <th>rekening</th>
                    <th>Nominal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ($iuran as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->rekening }} A.N {{ $item->nama }}</td>
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
        <form class="modal-content" action="{{ route('pengurus.iuran.store') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTitle">Iuran Uang Kas Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="judul" class="form-label">judul</label>
                        <input type="text" id="judul" class="form-control" name="judul" placeholder="masukan judul"
                            autofocus required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="rekening" class="form-label">rekening / e-wallet pembayaran</label>
                        <input type="text" id="rekening" class="form-control" name="rekening"
                            placeholder="masukan nomor rekening / e-wallet pembayaran" autofocus required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="jenis" class="form-label">jenis rekening / e-wallet pembayaran</label>
                        <input type="text" id="jenis" class="form-control" name="jenis"
                            placeholder="contoh : BRI, BCA, Shopee, Dana, Dll" autofocus required />
                    </div>
                    <div class="col mb-3">
                        <label for="nama" class="form-label">rekening / e-wallet pembayaran Atas nama</label>
                        <input type="text" id="nama" class="form-control" name="nama"
                            placeholder="masukan nama pemilik nomor rekening / e-wallet pembayaran" autofocus required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="bulan" class="form-label">bulan</label>
                        <input type="date" id="bulan" class="form-control" name="bulan" autofocus required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nominal" class="form-label">nominal</label>
                        <input type="number" id="nominal" class="form-control" name="nominal" autofocus required />
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
        <form class="modal-content" action="{{ route('pengurus.iuran.update') }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTitle">Edit Data Iuran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="id" class="form-label">id</label>
                        <input type="text" id="Editid" class="form-control" name="id" placeholder="masukan id" readonly autofocus
                            required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="judul" class="form-label">judul</label>
                        <input type="text" id="Editjudul" class="form-control" name="judul" placeholder="masukan judul" autofocus
                            required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="rekening" class="form-label">rekening / e-wallet pembayaran</label>
                        <input type="text" id="Editrekening" class="form-control" name="rekening"
                            placeholder="masukan nomor rekening / e-wallet pembayaran" autofocus required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="jenis" class="form-label">jenis rekening / e-wallet pembayaran</label>
                        <input type="text" id="Editjenis" class="form-control" name="jenis"
                            placeholder="contoh : BRI, BCA, Shopee, Dana, Dll" autofocus required />
                    </div>
                    <div class="col mb-3">
                        <label for="nama" class="form-label">rekening / e-wallet pembayaran Atas nama</label>
                        <input type="text" id="Editnama" class="form-control" name="nama"
                            placeholder="masukan nama pemilik nomor rekening / e-wallet pembayaran" autofocus required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="bulan" class="form-label">Tanggal</label>
                        <input type="date" id="Edittanggal" class="form-control" name="bulan" autofocus required />
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
        <form class="modal-content" action="{{ route('pengurus.iuran.delete') }}" method="POST">
            @method('DELETE')
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTitle">Yakin Hapus Data Iuran ?</h5>
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
    console.log(myjsonEdit);
    document.getElementById("Editid").value = myjsonEdit.id;
    document.getElementById("Editjudul").value = myjsonEdit.judul;
    document.getElementById("Editrekening").value = myjsonEdit.rekening;
    document.getElementById("Editjenis").value = myjsonEdit.jenis;
    document.getElementById("Editnama").value = myjsonEdit.nama;
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