@extends('layouts.main')
@section('content')
    <div class="card mt-2">
        <div class="table-responsive text-wrap card-body">
            <table class="table" id="dataAset">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>Nama Anggota</th>
                        <th>upload bukti pembayaran</th>
                        <th>status iuran kas</th>
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
@endsection