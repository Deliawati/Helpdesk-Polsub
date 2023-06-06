<div class="modal fade" id="balasModal{{$tiket->id}}" tabindex="-1" aria-labelledby="balasModal{{$tiket->id}}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="balasModal{{$tiket->id}}Label">Formulir Penambahan User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('modul-tiket.update', $tiket->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="pertanyaan" class="form-label">Pertanyaan</label>
                        <input type="text" class="form-control" id="pertanyaan" value="{{$tiket->pertanyaan}}" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="balasan" class="form-label">Balasan</label>
                        <textarea class="form-control" id="balasan" name="balasan" required>{{$tiket->balasan}}</textarea>
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
