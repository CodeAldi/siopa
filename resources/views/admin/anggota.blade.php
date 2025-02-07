@extends('layouts.main')
@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header row">
            <h5 class="card-title col-8 mt-3">
                Halo Admin, selamat datang di Manajemen Anggota !
            </h5>
            <button type="button" class="btn btn-primary col-4" data-bs-toggle="modal" data-bs-target="#modalCreate">
                <i class="tf-icons bx bx-plus-circle"></i>
                Tambah Aset
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
                        <th>jenis kelamin</th>
                        <th>alamat</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($kosong as $item)
                    <tr>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->aset->nama }}</td>
                        <td class="text-center">{{ $item->jumlah }}</td>
                        <td>{{ $item->alasan }}</td>
                        <td class="text-center"><span class="badge bg-label-primary me-1">{{ $item->status }}</span>
                        </td>
                        <td class="text-center">{{ $item->tanggal_mulai_pinjam }}</td>
                        <td class="text-center">{{ $item->lama_pinjam }}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <form action="#"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item btn btn-success mb-1 text-white"><i
                                                class="bx bx-check-circle me-1"></i>
                                            Teruskan kepada Kabag</button>
                                    </form>
                                    <form action="#"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item btn btn-danger mb-1 text-white"><i
                                                class="bx bx-x-circle me-1"></i>
                                            Tolak</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td>1</td>
                        <td>aldi</td>
                        <td>laki laki</td>
                        <td>jl taman karya perumahan citra kencana blok b nomor 23 rt 15 rw 5</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <form action="#" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item btn btn-success mb-1 text-white"><i
                                                class="bx bx-check-circle me-1"></i>
                                            Teruskan kepada Kabag</button>
                                    </form>
                                    <form action="#" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item btn btn-danger mb-1 text-white"><i
                                                class="bx bx-x-circle me-1"></i>
                                            Tolak</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal untuk create -->
<div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTitle">Tambah Data Aset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" id="nama" class="form-control" name="namaAset"
                            placeholder="masukan nama aset" autofocus required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="jumlah" class="form-label">jumlah aset</label>
                        <input type="number" id="jumlah" class="form-control" name="jumlahAset"
                            placeholder="masukan jumlah aset yang akan diinput (angka)" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="fotoaset" class="form-label">foto aset</label>
                        <input type="file" id="fotoaset" class="form-control" name="fotoaset" required />
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col mb-3">
                        <label for="jenkel" class="form-label">Kategori Aset</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                            <option value="0" hidden> pilih jenis Kategori aset</option>
                            <option value="laki laki">elektronik</option>
                            <option value="perempuan">alat tulis</option>
                            <option value="perempuan">alat tulis</option>
                            <option value="perempuan">alat tulis</option>
                            <option value="perempuan">alat tulis</option>
                        </select>
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

@endsection
@push('page-js')
<script>
    let table = new DataTable('#dataAset', {
        // options
        });
</script>
@endpush