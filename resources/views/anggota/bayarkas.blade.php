@extends('layouts.main')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tagihan uang kas :</h5>
        </div>
    </div>
    <div class="card mt-2">
    
        <div class="table-responsive text-wrap card-body">
            <table class="table" id="dataAset">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>judul</th>
                        <th class="text-end">nominal</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($tagihan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->iuran->judul }}</td>
                        <td class="text-end">Rp{{ number_format($item->iuran->nominal) }}</td>
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
    <!-- Modal untuk Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" action="{{ route('anggota.bayarkas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateTitle">Konfirmasi Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="Editid" class="form-control" name="id" placeholder="masukan id" hidden
                    required />
                    <div class="row">
                        <div class="col mb-3">
                            <label for="bukti" class="form-label">bukti pembayaran</label>
                            <input type="file" id="bukti" class="form-control" name="bukti" required />
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
    }
    let table = new DataTable('#dataAset', {
        // options
        });
</script>
@endpush