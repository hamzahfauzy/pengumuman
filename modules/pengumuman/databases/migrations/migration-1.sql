CREATE TABLE peng_periode (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(200) NOT NULL,
    record_status VARCHAR(100) NOT NULL DEFAULT 'TIDAK AKTIF',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_peng_periode_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE RESTRICT,
    CONSTRAINT fk_peng_periode_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE RESTRICT
);

CREATE TABLE peng_peserta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    periode_id INT DEFAULT NULL,
    kode VARCHAR(200) NOT NULL,
    nama VARCHAR(200) NOT NULL,
    tanggal_lahir DATE NOT NULL,
    jurusan VARCHAR(200) NOT NULL,
    foto_url VARCHAR(200) DEFAULT NULL,
    record_status VARCHAR(100) NOT NULL DEFAULT 'LULUS',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_peng_peserta_periode_id FOREIGN KEY (periode_id) REFERENCES peng_periode(id) ON DELETE RESTRICT,
    CONSTRAINT fk_peng_peserta_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE RESTRICT,
    CONSTRAINT fk_peng_peserta_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE RESTRICT
);