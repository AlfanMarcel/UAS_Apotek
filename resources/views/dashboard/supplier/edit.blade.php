@extends('layouts.dashboard.layout')

@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Barang</h1>
    </div>
    <div class="pull-right">
        <a href="{{ route('supplier.index') }}" class="btn btn-warning btn-xs mb-4"><i class="glyphicon glyphicon-chevron-left"> Kembali</i></a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <form method="post" enctype="multipart/form-data" action="{{ route('supplier.edit', $supplier->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama Supplier</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"  value="{{ old( 'harga', $supplier->nama) }}" required autofocus>
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group pull-right mt-2">
                    <input type="submit" name="add" value="Update" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
