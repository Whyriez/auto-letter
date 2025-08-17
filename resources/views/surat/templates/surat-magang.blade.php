<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Rekomendasi Magang</title>
</head>

<style>
    body{
        font-family: 'Times New Roman', Times, serif;
    }
</style>

<body style="font-size: 12pt; line-height: 1.5;">
    <div class="page" style="width:21cm;min-height:29.7cm;padding:2cm;margin:1cm auto;background:white;box-shadow:0 0 0.5cm rgba(0,0,0,0.5);">
        <div class="kop-surat" style="border-bottom:2px solid black;padding-bottom:2px;margin-bottom:15px;">
            <div class="kop-surat-content" style="display:flex;align-items:center;border-bottom:4px solid black;padding-bottom:10px;">
                <img src="{{ asset('images/logo-ung.jpeg') }}" alt="Logo UNG" class="logo" style="width:100px;height:auto;margin-right:0px;">
                <div class="text-kop" style="text-align:center;flex-grow:1;">
                    <p style="margin:0;line-height:1.2;">KEMENTERIAN PENDIDIKAN TINGGI,</p>
                    <p style="margin:0;line-height:1.2;">SAINS DAN TEKNOLOGI</p>
                    <h3 style="margin:0;line-height:1.2;">UNIVERSITAS NEGERI GORONTALO</h3>
                    <h4 style="margin:0;line-height:1.2;">FAKULTAS TEKNIK</h4>
                    <h4 style="margin:0;line-height:1.2;">JURUSAN TEKNIK INFORMATIKA</h4>
                    <p class="alamat-kop" style="font-size:12px;margin-bottom:-7px;margin:0;line-height:1.2;">
                        Jalan B.J. Habibie Desa Moutong Kecamatan Tilongkabila Kab. Bone Bolango<br>
                        Telp. (0435) 821152, Fax. (0435) 821752 Gorontalo<br>
                        Laman www.ft.ung.ac.id
                    </p>
                </div>
            </div>
        </div>

        <table class="meta-surat" style="width:100%;border-collapse:collapse;margin-top:20px;margin-bottom:30px;">
            <tr>
                <td>
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td style="width:15%;">Nomor</td>
                            <td>: {{ $nomor_surat }}</td>
                        </tr>
                        <tr>
                            <td>Hal</td>
                            <td>: {{ $hal }}</td>
                        </tr>
                    </table>
                </td>
                <td class="tanggal" style="text-align:right;">{{ $tanggal_surat }}</td>
            </tr>
        </table>

        <div class="penerima" style="margin-bottom:30px;">
            <p>Yth.<br>{{ $penerima_surat }}<br>Di Gorontalo</p>
        </div>

        <p>Yang bertanda tangan di bawah ini:</p>
        <table class="tabel-data" style="margin-left:20px;width:100%;border-collapse:collapse;">
            <tr>
                <td style="width:15%;padding:2px 0;vertical-align:top;">Nama</td>
                <td style="padding:2px 0;vertical-align:top;">: {{ $dosen['nama'] }}</td>
            </tr>
            <tr>
                <td style="padding:2px 0;vertical-align:top;">Jabatan</td>
                <td style="padding:2px 0;vertical-align:top;">: {{ $dosen['jabatan'] }}</td>
            </tr>
        </table>

        <p>Memberikan rekomendasi kepada mahasiswa atas nama:</p>
        <table class="tabel-mahasiswa" style="margin-left:20px;margin-top:15px;margin-bottom:15px;width:100%;border-collapse:collapse;">
            @foreach ($mahasiswa as $mhs)
                <tr>
                    <td style="width:2%;padding:2px 8px;vertical-align:top;">{{ $loop->iteration }}.</td>
                    <td style="width:40%;padding:2px 8px;vertical-align:top;">{{ $mhs['nama'] }}</td>
                    <td style="padding:2px 8px;vertical-align:top;">NIM. {{ $mhs['nim'] }}</td>
                </tr>
            @endforeach
        </table>

        <p>Untuk melaksanakan magang di {{ $lokasi_magang }} selama {{ $durasi_magang }} Bulan.</p>

        <p>Demikian rekomendasi ini di buat, untuk digunakan sebagaimana mestinya.</p>

        <div class="signature-block" style="width:40%;margin-left:55%;margin-top:40px;position:relative;">
            <p style="font-weight:600;margin:0;">Ketua Program Studi</p>
            <p style="font-weight:bold;margin:0;">Sistem Informasi</p>
            <div style="border:1px solid #000;width:120px;height:60px;margin:10px 0 15px 0;"></div>
            <p class="nama-terang" style="font-weight:bold;text-decoration:underline;margin-top:70px;margin:0;">{{ $dosen['nama'] }},MCE</p>
            <p style="margin:0;">NIP {{ $dosen['nip'] }}</p>
        </div>
    </div>
</body>

</html>
