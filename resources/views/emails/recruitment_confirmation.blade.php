<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pendaftaran HIMSI UBSI 2026</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #030712;
            color: #f3f4f6;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .wrapper {
            max-width: 600px;
            margin: 30px auto;
            background: #0a1128;
            border: 1px solid #1e293b;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
        }
        .header {
            background: linear-gradient(135deg, #001b79 0%, #0453cd 50%, #000c46 100%);
            padding: 36px 30px;
            text-align: center;
            border-bottom: 2px solid #f59e0b;
        }
        .header img {
            width: 64px;
            height: 64px;
            margin-bottom: 12px;
            border-radius: 12px;
            background: #ffffff;
            padding: 4px;
        }
        .header h1 {
            color: #ffffff;
            font-size: 22px;
            font-weight: 900;
            letter-spacing: 1px;
            margin: 0 0 6px 0;
            text-transform: uppercase;
        }
        .badge {
            display: inline-block;
            background: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
            border: 1px solid rgba(245, 158, 11, 0.5);
            font-size: 11px;
            font-weight: 800;
            padding: 4px 14px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .content {
            padding: 32px 30px;
        }
        .greeting {
            font-size: 18px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 14px;
        }
        .text {
            font-size: 14px;
            line-height: 1.6;
            color: #cbd5e1;
            margin-bottom: 24px;
        }
        .detail-box {
            background: #030712;
            border: 1px solid #1e293b;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 28px;
        }
        .detail-box h3 {
            margin: 0 0 14px 0;
            font-size: 13px;
            font-weight: 800;
            color: #f59e0b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px border #1e293b;
            font-size: 13px;
        }
        .detail-label {
            color: #94a3b8;
            font-weight: 600;
        }
        .detail-value {
            color: #ffffff;
            font-weight: 700;
            text-align: right;
        }
        .cta-container {
            text-align: center;
            margin: 32px 0 24px 0;
        }
        .btn-wa {
            display: inline-block;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff !important;
            text-decoration: none;
            font-weight: 900;
            font-size: 14px;
            padding: 14px 28px;
            border-radius: 50px;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .guideline-box {
            background: rgba(59, 130, 246, 0.1);
            border-left: 4px solid #3b82f6;
            padding: 16px;
            border-radius: 0 12px 12px 0;
            margin-bottom: 24px;
        }
        .guideline-box h4 {
            margin: 0 0 6px 0;
            color: #60a5fa;
            font-size: 13px;
            font-weight: 800;
        }
        .guideline-box p {
            margin: 0;
            font-size: 12px;
            color: #94a3b8;
            line-height: 1.5;
        }
        .footer {
            background: #030712;
            padding: 24px 30px;
            text-align: center;
            border-top: 1px solid #1e293b;
            font-size: 12px;
            color: #64748b;
        }
        .footer a {
            color: #f59e0b;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Header -->
        <div class="header">
            <img src="https://raw.githubusercontent.com/WahyuUtomo1414/WEB-HIMSI/main/public/images/himsi.png" alt="Logo HIMSI">
            <h1>HIMSI UBSI REKRUTMEN 2026</h1>
            <span class="badge">PENDAFTARAN BERHASIL DITERIMA</span>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">Halo, {{ $recruitment->name }}! 👋</div>
            
            <p class="text">
                Selamat! Data pendaftaran Anda sebagai calon generasi penerus pengurus <strong style="color: #f59e0b;">HIMSI UBSI Periode 2026/2027</strong> telah berhasil kami terima di dalam sistem.
            </p>

            <!-- Detail Pendaftaran -->
            <div class="detail-box">
                <h3>Ringkasan Pendaftaran Anda</h3>
                <table width="100%" cellpadding="6" cellspacing="0" style="border-collapse: collapse;">
                    <tr>
                        <td class="detail-label">Nama Lengkap</td>
                        <td class="detail-value">{{ $recruitment->name }}</td>
                    </tr>
                    <tr>
                        <td class="detail-label">NIM / Semester</td>
                        <td class="detail-value">{{ $recruitment->nim }} ({{ $recruitment->semester }})</td>
                    </tr>
                    <tr>
                        <td class="detail-label">Cabang DPC Pilihan</td>
                        <td class="detail-value" style="color: #60a5fa;">{{ $branch ? $branch->name : 'DPC UBSI' }}</td>
                    </tr>
                    <tr>
                        <td class="detail-label">No. WhatsApp</td>
                        <td class="detail-value">{{ $recruitment->no_wa }}</td>
                    </tr>
                    <tr>
                        <td class="detail-label">Instagram</td>
                        <td class="detail-value">{{ $recruitment->instagram }}</td>
                    </tr>
                    <tr>
                        <td class="detail-label">Status Awal</td>
                        <td class="detail-value" style="color: #f59e0b;">Belum Diverifikasi</td>
                    </tr>
                </table>
            </div>

            <!-- WhatsApp Group CTA -->
            @php
                $waGroupUrl = $branch && filled($branch->grup_wa) ? $branch->grup_wa : 'https://chat.whatsapp.com/JZhi2akI93bIVRFxcSJCAO?s=cl&p=a&ilr=1';
            @endphp

            <div class="cta-container">
                <p style="font-size: 13px; font-weight: 700; color: #ffffff; margin-bottom: 12px;">
                    Langkah Selanjutnya: Wajib Bergabung ke Grup WhatsApp Cabang
                </p>
                <a href="{{ $waGroupUrl }}" target="_blank" class="btn-wa">
                    💬 GABUNG GRUP WA {{ strtoupper($branch ? $branch->name : 'DPC UBSI') }}
                </a>
            </div>

            <!-- Guideline Box -->
            <div class="guideline-box">
                <h4>📌 Informasi Penting Tahapan Selanjutnya:</h4>
                <p>
                    1. Pastikan Anda telah bergabung dalam grup WhatsApp resmi cabang di atas.<br>
                    2. Pengumuman seleksi berkas dan jadwal wawancara akan disampaikan melalui grup WhatsApp & Email.<br>
                    3. Jaga nomor WhatsApp Anda tetap aktif selama proses verifikasi.
                </p>
            </div>

            <p class="text" style="margin-bottom: 0;">
                Terima kasih atas antusiasme dan semangat Anda untuk menjadi bagian dari keluarga besar HIMSI UBSI!
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p style="margin: 0 0 6px 0;"><strong>Himpunan Mahasiswa Sistem Informasi (HIMSI) UBSI</strong></p>
            <p style="margin: 0;">Email ini dikirimkan secara otomatis dari Sistem Informasi Rekrutmen HIMSI.</p>
        </div>
    </div>
</body>
</html>
