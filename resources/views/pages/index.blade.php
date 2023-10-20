@extends('layouts.index')

@section('content')
    <h2>Visualisasi Pohon Keluarga</h2>
    <div class="family-tree">
        <a href="{{ route('keluarga.create') }}"
            class="btn btn-primary">Tambah</a>
        <ul>
            <li>{{ $keluarga[0]->name }}
                @foreach ($keluarga as $data)
                    @if ($data->parent_id != null && $data->parent_id == 1)
                        <ul>
                            <li>{{ $data->name }}
                                <ul>
                                    @foreach ($data->parents as $parent)
                                        <li><a href="{{ route('keluarga.edit', $parent->id) }}">{{ $parent->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    @endif
                @endforeach
            </li>
        </ul>
    </div>
@endsection
