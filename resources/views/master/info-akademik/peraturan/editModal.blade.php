<div class="modal fade" id="editModal{{$peraturan->id}}" tabindex="-1" aria-labelledby="editModal{{$peraturan->id}}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal{{$peraturan->id}}Label">Formulir Perubahan Peraturan Akademik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('master-peraturan-akademik.update', $peraturan->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">                    
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="ex: Peraturan Akademik 2020/2021" value="{{$peraturan->nama}}" required>                        
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">File Baru</label>
                        <input type="file" class="form-control" id="file" name="file" accept="application/pdf">
                        <div class="form-text">File harus berupa PDF.
                            <a href="{{ asset('storage/peraturan-akademik/'.$peraturan->file) }}" target="_blank">Lihat file sebelumnya</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
