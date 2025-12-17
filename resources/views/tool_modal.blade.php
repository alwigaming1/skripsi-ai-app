<div class="modal fade" id="toolModal" tabindex="-1" aria-labelledby="toolModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="toolModalLabel"><i class="fas fa-tools me-2"></i> Tool AI: Generator Judul</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div id="titleGeneratorContainer">
                    <p class="text-muted small">Isi detail di bawah untuk mendapatkan 5 opsi judul skripsi yang spesifik dan realistis.</p>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Program Studi</label>
                            <input type="text" id="modalProdi" class="form-control" placeholder="Contoh: Teknik Elektro">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Metode/Fokus Utama</label>
                            <select id="modalFokus" class="form-select">
                                <option value="">-- Pilih Fokus --</option>
                                <option value="Sistem Pendukung Keputusan (AHP, SAW, DSS)">Sistem Pendukung Keputusan</option>
                                <option value="Implementasi Jaringan/IoT (Monitoring, Keamanan)">Implementasi Jaringan/IoT</option>
                                <option value="Analisis Kinerja Keuangan/SDM">Analisis Kinerja</option>
                                <option value="Rancang Bangun Sistem Informasi">Rancang Bangun SI</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kata Kunci/Deskripsi Penelitian</label>
                        <textarea id="modalDeskripsi" class="form-control" rows="2" placeholder="Contoh: Monitoring suhu gudang berbasis Arduino dan Lora, atau Analisis profitabilitas UMKM"></textarea>
                    </div>

                    <button type="button" id="startTitleGenerator" class="btn btn-primary w-100 fw-bold">
                        <i class="fas fa-robot me-2"></i> Generate 5 Opsi Judul
                    </button>
                    
                    <div class="mt-4" id="titleGeneratorOutput" style="display:none;">
                        <h6 class="fw-bold text-success">Hasil Generator:</h6>
                        <div id="titleList"></div>
                    </div>
                </div>
                
                <div id="journalSearchContainer" style="display:none;">
                    <p class="text-muted small">Masukkan judul bab, variabel, atau topik utama untuk mencari 5 rekomendasi jurnal terkait.</p>
                    
                    <div class="input-group mb-3">
                        <input type="text" id="journalQuery" class="form-control" placeholder="Contoh: Metode AHP untuk DSS">
                        <button type="button" id="startJournalSearch" class="btn btn-warning fw-bold text-dark">
                            <i class="fas fa-search me-2"></i> Cari Jurnal
                        </button>
                    </div>
                    
                    <div class="mt-4" id="journalSearchOutput" style="display:none;">
                        <h6 class="fw-bold text-success">Hasil Rekomendasi Jurnal:</h6>
                        <ul id="journalResultList" class="list-group"></ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>