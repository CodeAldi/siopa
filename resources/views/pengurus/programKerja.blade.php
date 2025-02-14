@extends('layouts.main')
@section('content')
@if (Auth()->user()->hasRole('pengurus'))
    
<div class="container">
    <div class="card shadow">
        <div class="card-header row">
            <h5 class="card-title col-8 mt-3">
                Halo Pengurus, selamat datang di Manajemen kegiatan Organisasi !
            </h5>
            <button type="button" class="btn btn-primary col-4" data-bs-toggle="modal" data-bs-target="#modalCreate">
                <i class="tf-icons bx bx-plus-circle"></i>
                Tambah kegiatan Organisasi
            </button>
        </div>
    </div>
</div>
@endif
<div class="container mt-2">
    <div class="card">

        <div class="table-responsive text-wrap card-body">
            <table class="table" id="dataAset">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>judul kegiatan</th>
                        <th>tanggal kegiatan</th>
                        <th>lokasi kegiatan</th>
                        <th>kategori</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($programkerja as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->tanggal_kegiatan }}</td>
                        <td>{{ $item->lokasi }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if (Auth()->user()->hasRole('pengurus'))
                                    <button type="submit" class="dropdown-item btn btn-success mb-1 text-white" data-bs-toggle="modal"
                                        data-bs-target="#modalEdit" data-index="{{ $item }}" onclick="modalEdit(this)"><i class="bx bx-pencil me-1"></i>
                                        Edit</button>
                                    
                                    <button class="dropdown-item btn btn-danger mb-1 text-white" data-bs-toggle="modal" data-bs-target="#modalDelete"
                                        data-index="{{ $item }}" onclick="modalDelete(this)"><i class="bx bx-x-circle me-1"></i>Hapus</button>
                                    @else
                                    <button type="submit" class="dropdown-item btn btn-primary mb-1 text-white" data-bs-toggle="modal"
                                        data-bs-target="#modalLihat" data-index="{{ $item }}" onclick="modalLihat(this)"><i class="bx bx-show me-1"></i>
                                        Lihat</button>
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
        <form class="modal-content" action="{{ route('pengurus.programKerja.store') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTitle">Tambah Kegiatan Organisasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="judul" class="form-label">Kegiatan Organisasi</label>
                        <input type="text" id="judul" class="form-control" name="judul" placeholder="masukan judul"
                            autofocus required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="pic" class="form-label">Penanggung Jawab</label>
                        <select name="penanggung_jawab" id="pic" class="form-select">
                            <option value="0" hidden> pilih Penanggung jawab kegiatan</option>
                            @forelse ($penanggungJawab as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="kategori" class="form-label">Kategori Kegiatan</label>
                        <select name="kategori" id="kategori" class="form-select">
                            <option value="0" hidden> pilih kategori <kegiatan></kegiatan></option>
                            <option value="seni">seni</option>
                            <option value="rohani">rohani</option>
                            <option value="budaya">budaya</option>
                            <option value="sosial">sosial</option>
                            <option value="olahraga">olahraga</option>
                            <option value="kejuaraan">kejuaraan</option>
                            <option value="pendidikan">pendidikan</option>
                            <option value="kewirausahaan">kewirausahaan</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="lokasi" class="form-label">lokasi kegiatan</label>
                        <input type="text" id="lokasi" class="form-control" name="lokasi"
                            placeholder="masukan lokasi" autofocus required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="tanggal" class="form-label">tanggal kegiatan</label>
                        <input type="date" id="tanggal" class="form-control" name="tanggal_kegiatan" autofocus
                            required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        {{-- <label for="lama" class="form-label">Durasi kegiatan (hari) </label> --}}
                        {{-- <input type="number" id="lama" class="form-control" name="lama_kegiatan" autofocus required /> --}}
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="deskripsi" class="form-label">Isi atau Deskripsi kegiatan</label>
                        <textarea name="deskrispsi" class="form-control" id="deskripsi" cols="30" rows="10"></textarea>
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
<!-- Modal untuk Lihat -->
<div class="modal fade" id="modalLihat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTitle">Edit Kegiatan Organisasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="judul" class="form-label">id</label>
                        <input type="text" id="Lihatid" class="form-control" name="id" autofocus readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="judul" class="form-label">Kegiatan Organisasi</label>
                        <input type="text" id="Lihatjudul" class="form-control" name="judul" autofocus readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="pic" class="form-label">Penanggung Jawab</label>
                        <select name="penanggung_jawab" id="Lihatpenanggung_jawab" class="form-select" disabled>
                            <option value="0" hidden> pilih Penanggung jawab kegiatan</option>
                            @forelse ($penanggungJawab as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @empty
    
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="kategori" class="form-label">Kategori Kegiatan</label>
                        <select name="kategori" id="Lihatkategori" class="form-select" disabled>
                            <option value="0" hidden> pilih kategori <kegiatan></kegiatan>
                            </option>
                            <option value="seni">seni</option>
                            <option value="rohani">rohani</option>
                            <option value="budaya">budaya</option>
                            <option value="sosial">sosial</option>
                            <option value="olahraga">olahraga</option>
                            <option value="kejuaraan">kejuaraan</option>
                            <option value="pendidikan">pendidikan</option>
                            <option value="kewirausahaan">kewirausahaan</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="lokasi" class="form-label">lokasi kegiatan</label>
                        <input type="text" id="Lihatlokasi" class="form-control" name="lokasi" autofocus readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="tanggal" class="form-label">tanggal kegiatan</label>
                        <input type="date" id="Lihattanggal_kegiatan" class="form-control" name="tanggal_kegiatan" readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="deskripsi" class="form-label">Isi atau Deskripsi kegiatan</label>
                        <textarea name="deskrispsi" class="form-control" id="Lihatdeskripsi" cols="30" rows="5" readonly></textarea>
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
        <form class="modal-content" action="{{ route('pengurus.programKerja.update') }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTitle">Edit Kegiatan Organisasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="judul" class="form-label">id</label>
                        <input type="text" id="Editid" class="form-control" name="id" autofocus readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="judul" class="form-label">Kegiatan Organisasi</label>
                        <input type="text" id="Editjudul" class="form-control" name="judul" autofocus readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="pic" class="form-label">Penanggung Jawab</label>
                        <select name="penanggung_jawab" id="Editpenanggung_jawab" class="form-select">
                            <option value="0" hidden> pilih Penanggung jawab kegiatan</option>
                            @forelse ($penanggungJawab as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @empty

                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="kategori" class="form-label">Kategori Kegiatan</label>
                        <select name="kategori" id="Editkategori" class="form-select">
                            <option value="0" hidden> pilih kategori <kegiatan></kegiatan>
                            </option>
                            <option value="seni">seni</option>
                            <option value="rohani">rohani</option>
                            <option value="budaya">budaya</option>
                            <option value="sosial">sosial</option>
                            <option value="olahraga">olahraga</option>
                            <option value="kejuaraan">kejuaraan</option>
                            <option value="pendidikan">pendidikan</option>
                            <option value="kewirausahaan">kewirausahaan</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="lokasi" class="form-label">lokasi kegiatan</label>
                        <input type="text" id="Editlokasi" class="form-control" name="lokasi" autofocus readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="tanggal" class="form-label">tanggal kegiatan</label>
                        <input type="date" id="Edittanggal_kegiatan" class="form-control" name="tanggal_kegiatan" readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        {{-- <label for="lama" class="form-label">Durasi kegiatan (hari) </label> --}}
                        {{-- {{-- <input type="number" id="Editlama_kegiatan" class="form-control" name="lama_kegiatan" autofocus required /> --}} --}}
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="deskripsi" class="form-label">Isi atau Deskripsi kegiatan</label>
                        <textarea name="deskrispsi" class="form-control" id="Editdeskripsi" cols="30" rows="5"></textarea>
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
        <form class="modal-content" action="{{ route('pengurus.programKerja.delete') }}" method="POST" enctype="multipart/form-data">
            @method('DELETE')
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTitle">Yakin Hapus Kegiatan ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="judul" class="form-label">judul</label>
                        <input type="text" id="Hapusjudul" class="form-control" name="judul" value="budi@gmail.com"
                            readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="id" class="form-label">id</label>
                        <input type="text" id="Hapusid" class="form-control" name="id" value="1223344556677889" readonly />
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
        // document.getElementById("Hapusemail").value = myjson.email;
        // document.getElementById("HapusNik ").value = myjson.nik;
    console.log(myjson);
    
    }
    function modalLihat(item) {
        let indexnya = item.getAttribute("data-index");
        const myjsonLihat = JSON.parse(indexnya);
        // console.log(myjsonLihat);
        document.getElementById("Lihatid").value = myjsonLihat.id;
        document.getElementById("Lihatjudul").value = myjsonLihat.judul;
        document.getElementById("Lihatpenanggung_jawab").value = myjsonLihat.penanggung_jawab;
        document.getElementById("Lihatkategori").value = myjsonLihat.kategori;
        document.getElementById("Lihatlokasi").value = myjsonLihat.lokasi;
        document.getElementById("Lihattanggal_kegiatan").value = myjsonLihat.tanggal_kegiatan;
        // // document.getElementById("Lihatlama_kegiatan").value = myjsonLihat.lama_kegiatan;
        document.getElementById("Lihatdeskripsi").value = myjsonLihat.deskrispsi;
    }
    function modalEdit(item) {
        let indexnya = item.getAttribute("data-index");
        const myjsonEdit = JSON.parse(indexnya);
        // console.log(myjsonEdit);
        document.getElementById("Editid").value = myjsonEdit.id;
        document.getElementById("Editjudul").value = myjsonEdit.judul;
        document.getElementById("Editpenanggung_jawab").value = myjsonEdit.penanggung_jawab;
        document.getElementById("Editkategori").value = myjsonEdit.kategori;
        document.getElementById("Editlokasi").value = myjsonEdit.lokasi;
        document.getElementById("Edittanggal_kegiatan").value = myjsonEdit.tanggal_kegiatan;
        // // document.getElementById("Editlama_kegiatan").value = myjsonEdit.lama_kegiatan;
        document.getElementById("Editdeskripsi").value = myjsonEdit.deskrispsi;
    }
    let table = new DataTable('#dataAset', {
        // options
        });
</script>
@endpush