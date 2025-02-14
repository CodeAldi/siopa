@extends('layouts.main')
@section('content')
    <div class="card">
        <h5 class="card-header">Detail Pembayaran: {{ $detail[0]->iuran->judul }}</h5>
    </div>
    <div class="card mt-2">
        <div class="table-responsive text-wrap card-body">
            <table class="table" id="dataAset">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>nama anggota</th>
                        <th>status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($detail as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->anggota->name }}</td>
                        <td>
                            @if ($item->status)
                                <i class='bx bx-check-circle text-success'></i>
                            @else
                                <i class='bx bx-x-circle text-danger'></i>
                            @endif
                        </td>
                        {{-- <td class="text-end">Rp{{ number_format($item->nominal) }}</td> --}}
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <button type="submit" class="dropdown-item btn btn-primary mb-1 text-white"
                                        data-bs-toggle="modal" data-bs-target="#modalLihat{{ $loop->iteration }}" data-index="{{ $item }}"
                                        onclick="modalLihatBukti(this)"><i class="bx bx-pencil me-1"></i>
                                        Lihat bukti transfer</button>
                                    @if (!$item->status)
                                    <button type="submit" class="dropdown-item btn btn-success mb-1 text-white" data-bs-toggle="modal"
                                        data-bs-target="#modalKonfirmasi" data-index="{{ $item }}" onclick="modalLihat(this)"><i class="bx bx-detail me-1"></i>
                                        Konfirmasi</button>
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
    {{-- modal untuk setujui --}}
    <div class="modal fade" id="modalKonfirmasi" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" action="{{ route('pengurus.iuran.detail.setujui') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateTitle">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="modal-text">Setujui pembayaran iuran oleh anggota ?</p>
                    <input type="text" id="Lihatid" class="form-control" name="id" hidden readonly />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-success">Setuju</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    {{-- modal untuk lihatbukti --}}
    @foreach ($detail as $item)
    <div class="modal fade" id="modalLihat{{ $loop->iteration }}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateTitle">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="Lihatid" class="form-control" name="id" hidden readonly />
                    <img src="{{ asset($item->bukti_transfer) }}" alt="bukti" id="bukti" class="img-thumbnail">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            No
                        </button>
                        <button type="submit" class="btn btn-success">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    @endforeach
    
@endsection
@push('page-js')
    <script>
        function modalLihat(item){
        let indexnya = item.getAttribute("data-index");
        const myjsonLihat = JSON.parse(indexnya);
        document.getElementById("Lihatid").value = myjsonLihat.id;
        }
        
        let table = new DataTable('#dataAset', {
        // options
        });
    </script>
@endpush