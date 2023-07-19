<div class="modal fade" id="editModal{{$faq->id}}" tabindex="-1" aria-labelledby="editModal{{$faq->id}}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal{{$faq->id}}Label">Formulir Perubahan FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('modul-faq.update', $faq->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="pertanyaan" class="form-label">Pertanyaan</label>
                        <input type="text" class="form-control" id="pertanyaan" name="pertanyaan" value="{{$faq->pertanyaan}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="jawaban" class="form-label">Jawaban</label>
                        <textarea class="form-control" id="jawaban" name="jawaban" required>{{$faq->jawaban}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <option value="UKT" @if($faq->kategori == 'UKT') selected @endif>UKT</option>
                            <option value="beasiswa" @if($faq->kategori == 'beasiswa') selected @endif>Beasiswa</option>
                            <option value="kelulusan" @if($faq->kategori == 'kelulusan') selected @endif>Kelulusan</option>
                            <option value="PMB" @if($faq->kategori == 'PMB') selected @endif>PMB</option>
                            <option value="perkuliahan" @if($faq->kategori == 'perkuliahan') selected @endif>Perkuliahan</option>
                            <option value="surat menyurat" @if($faq->kategori == 'surat menyurat') selected @endif>Surat Menyurat</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="attachment" class="form-label">Attachment Baru</label>
                        <input type="file" class="form-control" id="attachment" name="attachment[]" multiple>
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
