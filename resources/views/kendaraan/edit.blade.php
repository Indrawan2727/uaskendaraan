<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data Kendaraan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body >

    <div class="container mt-4">

        <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="font-weight-bold">NO. POLISI</label>
                <input type="text" class="form-control @error('nopol') is-invalid @enderror" name="nopol" value="{{ old('nopol', $kendaraan->nopol) }}" placeholder="Masukkan No. Polisi Kendaraan">
            
            
                @error('nopol')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>                     

            <div class="form-group">
                <label class="font-weight-bold">MERK</label>
                <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk" value="{{ old('merk', $kendaraan->merk) }}" placeholder="Masukkan Merk Kendaraan">
            
                
                @error('merk')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="font-weight-bold">TIPE</label>
                <input type="text" class="form-control @error('tipe') is-invalid @enderror" name="tipe" value="{{ old('tipe', $kendaraan->tipe) }}" placeholder="Masukkan Tipe Kendaraan">
            
                
                @error('tipe')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="font-weight-bold">GAMBAR</label>
                <input type="file" class="form-control" name="image">
            </div>

            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
            <button type="reset" class="btn btn-md btn-warning">RESET</button>

        </form> 
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'content' );
</script>
</body>
</html>