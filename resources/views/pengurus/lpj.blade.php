@extends('layouts.main')
@section('content')
    <div class="card shadow">
        <div class="card-header row">
            <h5 class="card-title col-8 mt-3">
                Halo Pengurus, selamat datang di Laporan Pertanggung Jawaban Kegiatan !
            </h5>
            <button type="button" class="btn btn-primary col-4" data-bs-toggle="modal" data-bs-target="#modalCreate">
                <i class="tf-icons bx bx-plus-circle"></i>
                Buat LPJ
            </button>
        </div>
    </div>
    <div class="card mt-2">
    
        <div class="table-responsive text-wrap card-body">
            <table class="table" id="dataAset">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>judul kegiatan</th>
                        <th>total pengeluaran</th>
                        <th>isi</th>
                        {{-- <th>Actions</th> --}}
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($lpj as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kegiatan->judul }}</td>
                        <td class="text-end">Rp{{ number_format($item->total_pengeluaran) }}</td>
                        <td>{{ Str::limit($item->isi, 100, '...') }}</td>
                        {{-- <td class="text-center">
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
                        </td> --}}
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
            <form class="modal-content" action="{{ route('pengurus.lpj.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateTitle">Buat Lpj</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="kegiatan_id" class="form-label">Kegiatan</label>
                            <select name="kegiatan_id" id="kegiatan_id" class="form-select">
                                <option value="0" hidden> pilih kegiatan<kegiatan></kegiatan>
                                </option>
                                @forelse ($kegiatan as $item)
                                <option value="{{ $item->id }}">{{ $item->judul }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="total_pengeluaran" class="form-label">Total Pengeluaran</label>
                            <input type="number" id="total_pengeluaran" class="form-control" name="total_pengeluaran"
                                placeholder="masukan total pengeluaran" autofocus required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="isi" class="form-label">isi</label>
                            <textarea name="isi" id="isi" class="form-control" cols="30" rows="10"></textarea>
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