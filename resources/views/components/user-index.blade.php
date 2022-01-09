<div>
    <table class="table table-sm">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Gender</th>
                <th>No Tlp</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Reg Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $key => $u)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $u->nama }}</td>
                    <td>{{ $u->gender }}</td>
                    <td>{{ $u->no_tlp }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->alamat }}</td>
                    <td>{{ $u->regdate }}</td>
                    <td>
                        @if ($u->status == 9)
                            deleted
                        @else
                            <form action="/user/{{ $u->id }}" method="POST" class="text-center">
                                @csrf
                                @method('DELETE')
                                <a href="/user/{{ $u->id }}/edit" class="btn btn-sm btn-success">Ubah</a>
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>