@extends('layouts.index')

@section('content')
    <div class="card mt-5">
        <div class="card-body">
            <form method="POST"
                action="{{ $url }}">
                @csrf
                @if ($method == 'update')
                    @method('PUT')
                @endif
                <div class="form-group mt-4">
                    <label for="name">Nama:</label>
                    <input type="text"
                        name="name"
                        value="{{ old('name', @$keluarga->name) }}"
                        class="form-control @error('name') is-invalid @enderror"
                        id="name">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for="gender">Jenis Kelamin:</label>
                    <select name="gender"
                        class="form-control @error('gender') is-invalid @enderror"
                        id="gender">
                        <option value=""
                            selected
                            disabled>-- Pilih Jenis Kelamin --</option>
                        <option value="Laki - laki"
                            {{ old('gender', @$keluarga->gender) === 'Laki - laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan"
                            {{ old('gender', @$keluarga->gender) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for="parent_id">ID Orang Tua (Kosongkan jika tidak ada):</label>
                    <select name="parent_id"
                        class="form-control @error('parent_id') is-invalid @enderror"
                        id="parent_id">
                        <option value=""
                            selected
                            disabled>-- Pilih Orang Tua --</option>
                        @foreach ($parents as $parent)
                            <option value="{{ $parent->id }}"
                                {{ old('parent_id', @$keluarga->parent_id) == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}</option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <br>
                <button type="submit"
                    class="btn btn-primary">Tambahkan</button>
                @if ($method == 'update')
                    <form action="{{ route('keluarga.destroy', @$keluarga->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="btn btn-danger"
                            onclick="return confirm('Are you can delete this person ?')">Hapus</button>
                    </form>
                @endif
            </form>
        </div>
    </div>
@endsection
