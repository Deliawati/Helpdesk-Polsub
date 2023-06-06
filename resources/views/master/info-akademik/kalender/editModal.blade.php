<div class="modal fade" id="editModal{{$kalender->id}}" tabindex="-1" aria-labelledby="editModal{{$kalender->id}}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal{{$kalender->id}}Label">Formulir Perubahan Kalender Akademik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('master-kalender-akademik.update', $kalender->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">                    
                    <div class="mb-3">
                        <label for="file" class="form-label">File Baru</label>
                        <input type="file" class="form-control" id="file" name="file" accept="application/pdf">
                        <div class="form-text">File harus berupa PDF.
                            <a href="{{ asset('storage/kalender-akademik/'.$kalender->file) }}" target="_blank">Lihat file sebelumnya</a>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                        <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" placeholder="ex: 2023/2024" value="{{$kalender->tahun_ajaran}}" required>
                        <div class="form-text">Format: yyyy/yyyy</div>
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
