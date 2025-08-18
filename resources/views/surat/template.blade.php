<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $nama_surat }}</title>
</head>

<style>
    body {
        font-family: 'Times New Roman', Times, serif;
    }
</style>

<body style="font-size: 12pt; line-height: 1.5;">
    <div class="page">
        <div class="kop-surat" style="border-bottom: 2px solid black; padding-bottom: 2px; margin-bottom: 15px;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 15%; text-align: left; padding: 0; vertical-align: middle;">
                        <img src="{{ $logo_base64 }}" alt="Logo UNG" width="100" height="100">
                    </td>

                    <td style="width: 70%; text-align: center; padding: 0; vertical-align: middle;">
                        <p style="margin: 0; line-height: 1.2;font-size: 20px;">KEMENTERIAN PENDIDIKAN TINGGI,</p>
                        <p style="margin: 0; line-height: 1.2;font-size: 20px;">SAINS DAN TEKNOLOGI</p>
                        <h3 style="margin: 0; line-height: 1.2; font-weight: bold;font-size: 20px;">UNIVERSITAS NEGERI
                            GORONTALO</h3>
                        <h4 style="margin: 0; line-height: 1.2; font-weight: bold;font-size: 20px;">FAKULTAS TEKNIK</h4>
                        <h4 style="margin: 0; line-height: 1.2; font-weight: bold;font-size: 20px;">JURUSAN TEKNIK
                            INFORMATIKA</h4>
                        <p style="font-size: 14px; margin: 0; line-height: 1.2;">
                            Jalan B.J. Habibie Desa Moutong Kecamatan Tilongkabila Kab. Bone Bolango<br>
                            Telp. (0435) 821152, Fax. (0435) 821752 Gorontalo<br>
                            Laman www.ft.ung.ac.id
                        </p>
                    </td>

                    <td style="width: 15%;"></td>
                </tr>
            </table>
        </div>

        <table class="meta-surat" style="width:100%; border-collapse:collapse; margin-top:20px; margin-bottom:30px;">
            <tr>
                <td style="width:50%; vertical-align:top;">
                    <table style="width:100%; border-collapse:collapse;">
                        <tr>
                            <td style="width:15%;">Nomor</td>
                            <td>: {{ $nomor_surat }}</td>
                        </tr>
                        <tr>
                            <td>Hal</td>
                            <td>: {{ $perihal }}</td>
                        </tr>
                    </table>
                </td>

                <td style="width:50%; text-align:right; vertical-align:top;">
                    {{ $date }}
                </td>
            </tr>
        </table>

        <div class="penerima">
            <p style="margin-bottom: 5px;">Yth. <br>
                {{ $tujuan_nama }} <br>
                Di {{ $tujuan_lokasi }}</p>
        </div>

        <div class="body-content">
            <br>
            {!! $bodyContent !!}
        </div>

        <table style="width: 100%; border-collapse: collapse; margin-top: 40px;">
            <tr>
                <td style="width: 50%; text-align: center; vertical-align: top;">
                    <div class="signature-box">
                        <div class="text-sm">
                            <!-- Spacer untuk menyamakan tinggi dengan teks jabatan -->
                            <div style="height: 5rem; visibility: hidden;">
                                &nbsp; <!-- Ini adalah placeholder tak terlihat -->
                            </div>
                            <img src="data:image/png;base64, {!! base64_encode(QrCode::size(120)->generate($verificationUrl)) !!}">
                            <p style="margin-top: 0.5rem; color: #6b7280;">Scan untuk Verifikasi</p>
                        </div>
                    </div>
                </td>

                <td style="width: 50%; text-align: center; vertical-align: top;">
                    <div class="signature-block">
                        @if ($signer->role === 'kaprodi')
                            <p style="font-weight: 600; margin-bottom: 1rem;">Ketua Program Studi <br> Sistem Informasi
                            </p>
                        @elseif ($signer->role === 'kajur')
                            <p style="font-weight: 600; margin-bottom: 1rem;">Ketua Jurusan <br> Teknik Informatika</p>
                        @else
                            <p style="font-weight: 600; margin-bottom: 1rem;">Pihak Berwenang</p>
                            <p style="font-weight: 600; margin-bottom: 1rem;">[Nama Program Studi/Jurusan]</p>
                        @endif

                        @if ($signature_base64)
                            <img src="{{ $signature_base64 }}" alt="Signature"
                                style="width: 135px; height: auto; margin-bottom: 0.5rem;">
                        @else
                            <p>Tanda tangan tidak ditemukan</p>
                        @endif
                        <p style="margin-top: 0.5rem; color: #6b7280;">Tanda Tangan Digital</p>

                        <p style="font-weight: bold; margin-bottom: 0;">
                            {{ $signer->name }}
                        </p>
                        <p style="margin: 0;">NIP. {{ $signer->nim_nip }}</p>
                    </div>
                </td>
            </tr>
        </table>
        {{-- <table style="width: 100%; border-collapse: collapse; margin-top: 40px; font-size: 13px;">
            <tr>
                <td style="width: 50%; text-align: left; vertical-align: top;">
                    <div style="display: inline-block;">
                        <div
                            style="border: 2px solid #e5e7eb; border-radius: 12px; padding: 20px; background-color: #f9fafb; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            <img src="data:image/png;base64,{!! base64_encode(QrCode::size(120)->generate($verificationUrl)) !!}"
                                style="display: block; margin: 0 auto;">
                            <p style="margin: 12px 0 0 0; color: #6b7280; font-weight: 600; text-align: center;">
                                Scan untuk Verifikasi
                            </p>
                        </div>
                    </div>
                </td>

                <td style="width: 50%; text-align: right; vertical-align: top;">
                   
                </td>
            </tr>
        </table> --}}
    </div>
</body>

</html>
