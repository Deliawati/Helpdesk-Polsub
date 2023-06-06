<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Formulir Penambahan Layanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('master-layanan-akademik.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Layanan</label>
                        <textarea class="form-control" id="nama" name="nama" rows="3"></textarea>                        
                    </div>
                    <div class="mb-3">
                        <label for="melalui" class="form-label">Melalui</label>
                        <input type="text" class="form-control" id="melalui" name="melalui">
                        <div class="form-text">Pisahkan dengan ';' untuk bisa melalui banyak kontak yang bisa dihubungi</div>
                    </div>
                    <div class="mb-3">
                        <label for="konfirmasi" class="form-label">Konfimasi</label>
                        <input type="text" class="form-control" id="konfirmasi" name="konfirmasi">
                        <div class="form-text">Pisahkan dengan ';' untuk bisa melalui banyak kontak yang bisa dikonfirmasi</div>
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
