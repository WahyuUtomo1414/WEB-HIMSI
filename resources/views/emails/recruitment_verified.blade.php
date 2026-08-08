<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran HIMSI UBSI Terverifikasi</title>
    <style>
        body { margin: 0; padding: 0; background: #f0f4ff; color: #1a1c1e; font-family: Arial, Helvetica, sans-serif; }
        .wrapper { max-width: 620px; margin: 28px auto; background: #ffffff; border: 1px solid #c5c5d4; border-radius: 18px; overflow: hidden; }
        .header { background: #000c46; color: #ffffff; padding: 30px; border-bottom: 4px solid #f59e0b; }
        .header h1 { margin: 0 0 8px; font-size: 24px; line-height: 1.25; }
        .header p { margin: 0; color: #dbe5ff; font-size: 14px; line-height: 1.6; }
        .content { padding: 28px 30px; }
        .greeting { margin: 0 0 14px; font-size: 18px; font-weight: 700; color: #000c46; }
        .text { margin: 0 0 20px; color: #454652; font-size: 14px; line-height: 1.65; }
        .box { margin: 20px 0; border: 1px solid #c5c5d4; border-radius: 14px; overflow: hidden; }
        .box table { width: 100%; border-collapse: collapse; }
        .box td { padding: 12px 14px; border-bottom: 1px solid #eef1fb; font-size: 14px; }
        .box tr:last-child td { border-bottom: 0; }
        .label { width: 38%; color: #454652; font-weight: 700; }
        .value { color: #1a1c1e; font-weight: 700; }
        .badge { display: inline-block; padding: 5px 12px; border-radius: 999px; background: #e9f7ef; color: #047857; font-size: 12px; font-weight: 800; }
        .footer { padding: 22px 30px; background: #f9f9fc; color: #757683; font-size: 12px; line-height: 1.5; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>Pendaftaran Terverifikasi</h1>
            <p>Data Open Recruitment HIMSI UBSI Anda telah selesai diverifikasi oleh panitia.</p>
        </div>

        <div class="content">
            <p class="greeting">Halo, {{ $recruitment->name }}</p>
            <p class="text">
                Status pendaftaran Anda sudah berubah menjadi <strong>terverifikasi</strong>. Silakan ikuti arahan lanjutan dari panitia melalui kanal resmi HIMSI UBSI.
            </p>

            <div class="box">
                <table>
                    <tr>
                        <td class="label">Nama</td>
                        <td class="value">{{ $recruitment->name }}</td>
                    </tr>
                    <tr>
                        <td class="label">NIM</td>
                        <td class="value">{{ $recruitment->nim }}</td>
                    </tr>
                    <tr>
                        <td class="label">Cabang</td>
                        <td class="value">{{ $branch?->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Status</td>
                        <td class="value"><span class="badge">{{ $recruitment->status?->name ?? 'Terverifikasi' }}</span></td>
                    </tr>
                </table>
            </div>

            <p class="text">
                Pastikan email dan nomor WhatsApp Anda tetap aktif selama proses rekrutmen berlangsung.
            </p>
        </div>

        <div class="footer">
            Email ini dikirim otomatis oleh Sistem Informasi Rekrutmen HIMSI UBSI.
        </div>
    </div>
</body>
</html>
