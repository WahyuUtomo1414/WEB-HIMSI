<?php

namespace App\Filament\Resources\Recruitments\Support;

use App\Mail\RecruitmentVerifiedMail;
use App\Models\Recruitment;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;

class RecruitmentActions
{
    public static function verify(Recruitment $recruitment): void
    {
        self::verifyRecord($recruitment);

        Notification::make()
            ->title('Pendaftar berhasil diverifikasi')
            ->body('Status pendaftar diubah menjadi terverifikasi dan email sudah dikirim.')
            ->success()
            ->send();
    }

    public static function verifyMany(Collection $recruitments): void
    {
        $verifiedCount = 0;

        foreach ($recruitments as $recruitment) {
            if ((int) $recruitment->status_id === 2 || filled($recruitment->deleted_at)) {
                continue;
            }

            self::verifyRecord($recruitment);
            $verifiedCount++;
        }

        if ($verifiedCount === 0) {
            Notification::make()
                ->title('Tidak ada data yang diverifikasi')
                ->body('Data yang dipilih sudah terverifikasi atau sedang terhapus.')
                ->warning()
                ->send();

            return;
        }

        Notification::make()
            ->title('Verifikasi massal berhasil')
            ->body($verifiedCount.' pendaftar berhasil diverifikasi dan email sudah dikirim.')
            ->success()
            ->send();
    }

    private static function verifyRecord(Recruitment $recruitment): void
    {
        $recruitment->forceFill([
            'status_id' => 2,
        ])->save();

        $recruitment->load(['branch', 'status']);

        Mail::to($recruitment->email)->send(new RecruitmentVerifiedMail($recruitment));
    }
}
