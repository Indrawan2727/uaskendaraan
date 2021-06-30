<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Kendaraan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body class="bg-secondary" >
    <div class="container mt-4">
        <div class="row ">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded ">
                    <div class="card-body ">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th class="text-center" >No.</th>
                                <th class="text-center">NO. POLISI</th>
                                <th class="text-center">MERK</th>
                                <th class="text-center">TIPE</th>
                                <th class="text-center">GAMBAR</th>
                                <th class="text-center">AKSI</th>
                              </tr>
                            </thead>

                            <tbody>
                             <?php $no = 1; ?>
                              @forelse ($kendaraans as $i)
                                <tr>
                                    <td class="text-center align-middle"><?php echo $no++; ?></td>
                                    <td class="text-center align-middle">{{ $i->nopol }}</td>
                                    <td class="text-center align-middle">{{ $i->merk }}</td>
                                    <td class="text-center align-middle">{{ $i->tipe }}</td>
                                    <td class="text-center">
                                        <img src="{{ Storage::url('public/kendaraans/').$i->image }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td class="text-center align-middle">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('kendaraan.destroy', $i->id) }}" method="POST">
                                            <a href="{{ route('kendaraan.edit', $i->id) }}" class="btn btn-sm btn-warning">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger text-center">
                                      Data Kendaraan belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>  
                          {{ $kendaraans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script>

</body>
</html>