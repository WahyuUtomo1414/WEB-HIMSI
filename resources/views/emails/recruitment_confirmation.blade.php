<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pendaftaran HIMSI UBSI 2026</title>
    <style>
        body { margin: 0; padding: 0; background: #f0f4ff; color: #1a1c1e; font-family: Arial, Helvetica, sans-serif; }
        .wrapper { max-width: 620px; margin: 28px auto; background: #ffffff; border: 1px solid #c5c5d4; border-radius: 18px; overflow: hidden; }
        .header { background: #000c46; color: #ffffff; padding: 30px; border-bottom: 4px solid #f59e0b; }
        .header h1 { margin: 0 0 8px; font-size: 22px; font-weight: 800; line-height: 1.25; }
        .header p { margin: 0; color: #dbe5ff; font-size: 14px; line-height: 1.6; }
        .badge { display: inline-block; margin-top: 10px; padding: 4px 12px; border-radius: 999px; background: #fef3c7; color: #d97706; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; }
        .content { padding: 28px 30px; }
        .greeting { margin: 0 0 14px; font-size: 18px; font-weight: 700; color: #000c46; }
        .text { margin: 0 0 20px; color: #454652; font-size: 14px; line-height: 1.65; }
        .box { margin: 20px 0; border: 1px solid #c5c5d4; border-radius: 14px; overflow: hidden; }
        .box table { width: 100%; border-collapse: collapse; }
        .box td { padding: 12px 14px; border-bottom: 1px solid #eef1fb; font-size: 14px; }
        .box tr:last-child td { border-bottom: 0; }
        .label { width: 38%; color: #454652; font-weight: 700; }
        .value { color: #1a1c1e; font-weight: 700; }
        .cta-box { text-align: center; margin: 26px 0; padding: 20px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; }
        .cta-title { font-size: 14px; font-weight: 700; color: #000c46; margin: 0 0 12px 0; }
        .btn-wa { display: inline-block; background: #25d366; color: #ffffff !important; text-decoration: none; font-weight: 800; font-size: 14px; padding: 12px 24px; border-radius: 50px; text-transform: uppercase; letter-spacing: 0.5px; }
        .guideline { margin: 20px 0; padding: 16px; background: #eff6ff; border-left: 4px solid #2563eb; border-radius: 0 10px 10px 0; font-size: 13px; color: #1e40af; line-height: 1.6; }
        .guideline h4 { margin: 0 0 6px 0; font-size: 13px; font-weight: 800; color: #1e3a8a; }
        .footer { padding: 22px 30px; background: #f9f9fc; color: #757683; font-size: 12px; line-height: 1.5; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>Konfirmasi Pendaftaran</h1>
            <p>Pendaftaran Open Recruitment HIMSI UBSI 2026 Berhasil Diterima</p>
            <span class="badge">Menunggu Verifikasi</span>
        </div>

        <div class="content">
            <p class="greeting">Halo, {{ $recruitment->name }} 👋</p>
            <p class="text">
                Selamat! Data pendaftaran Anda sebagai calon pengurus <strong>HIMSI UBSI Periode 2026/2027</strong> telah berhasil kami terima di dalam sistem.
            </p>

            <div class="box">
                <table>
                    <tr>
                        <td class="label">Nama Lengkap</td>
                        <td class="value">{{ $recruitment->name }}</td>
                    </tr>
                    <tr>
                        <td class="label">NIM / Semester</td>
                        <td class="value">{{ $recruitment->nim }} (Semester {{ $recruitment->semester }})</td>
                    </tr>
                    <tr>
                        <td class="label">Cabang Pilihan</td>
                        <td class="value">{{ $branch ? $branch->name : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label">No. WhatsApp</td>
                        <td class="value">{{ $recruitment->no_wa }}</td>
                    </tr>
                    <tr>
                        <td class="label">Instagram</td>
                        <td class="value">{{ $recruitment->instagram }}</td>
                    </tr>
                    <tr>
                        <td class="label">Status Awal</td>
                        <td class="value"><span style="color: #d97706; font-weight: 800;">Belum Diverifikasi</span></td>
                    </tr>
                </table>
            </div>

            @php
                $waGroupUrl = $branch && filled($branch->grup_wa) ? $branch->grup_wa : 'https://chat.whatsapp.com/JZhi2akI93bIVRFxcSJCAO?s=cl&p=a&ilr=1';
            @endphp

            <div class="cta-box">
                <p class="cta-title">Langkah Selanjutnya: Wajib Bergabung ke Grup WhatsApp DPP</p>
                <a href="{{ $waGroupUrl }}" target="_blank" class="btn-wa">
                    <svg style="width:16px;height:16px;vertical-align:-3px;margin-right:6px;fill:currentColor;display:inline-block;" viewBox="0 0 24 24">
                        <path d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984 0 1.765.459 3.488 1.334 5.006L2 22l5.12-1.341c1.472.802 3.136 1.225 4.887 1.226h.005c5.505 0 9.988-4.478 9.989-9.984 0-2.668-1.038-5.176-2.924-7.062A9.923 9.923 0 0 0 12.012 2zm0 18.258h-.004a8.272 8.272 0 0 1-4.22-1.161l-.303-.18-3.135.821.836-3.054-.197-.314a8.261 8.261 0 0 1-1.265-4.386c0-4.564 3.714-8.278 8.28-8.278 2.21 0 4.288.862 5.852 2.427a8.232 8.232 0 0 1 2.425 5.853c-.001 4.565-3.715 8.279-8.279 8.279zm4.536-6.195c-.248-.124-1.469-.724-1.696-.807-.227-.083-.393-.124-.559.124-.165.248-.641.807-.786.972-.145.165-.29.186-.538.062-.248-.124-1.047-.386-1.995-1.231-.738-.659-1.236-1.472-1.38-1.72-.146-.248-.016-.382.108-.506.112-.112.248-.29.372-.434.124-.145.165-.248.248-.414.083-.165.041-.31-.021-.434-.062-.124-.559-1.346-.765-1.842-.201-.484-.405-.418-.559-.426l-.476-.008c-.165 0-.434.062-.661.31-.227.248-.868.848-.868 2.07 0 1.221.889 2.4 1.013 2.565.124.165 1.75 2.673 4.239 3.748.592.256 1.055.409 1.416.523.595.19 1.136.163 1.564.1.477-.07 1.469-.6 1.675-1.179.207-.579.207-1.075.145-1.179-.062-.104-.227-.166-.475-.29z"/>
                    </svg>
                    <span>GABUNG GRUP WA DPP HIMSI</span>
                </a>
            </div>

            <div class="guideline">
                <h4>📌 Informasi Penting Tahapan Selanjutnya:</h4>
                1. Pastikan Anda telah bergabung dalam grup WhatsApp resmi DPP HIMSI di atas.<br>
                2. Pengumuman seleksi berkas dan jadwal wawancara akan disampaikan melalui grup WhatsApp & Email.<br>
                3. Jaga nomor WhatsApp Anda tetap aktif selama proses verifikasi.
            </div>

            <p class="text" style="margin-bottom: 0;">
                Terima kasih atas antusiasme dan semangat Anda untuk menjadi bagian dari keluarga besar HIMSI UBSI!
            </p>
        </div>

        <div class="footer">
            <strong>Himpunan Mahasiswa Sistem Informasi (HIMSI) UBSI</strong><br>
            Email ini dikirim otomatis oleh Sistem Informasi Rekrutmen HIMSI.
        </div>
    </div>
</body>
</html>
