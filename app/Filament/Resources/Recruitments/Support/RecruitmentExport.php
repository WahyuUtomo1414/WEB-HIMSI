<?php

namespace App\Filament\Resources\Recruitments\Support;

use App\Models\Recruitment;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RecruitmentExport
{
    public static function download(Builder $query): StreamedResponse
    {
        $filename = 'data-rekrutmen-himsi-'.now()->format('Ymd-His').'.xls';

        return response()->streamDownload(function () use ($query) {
            echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
            echo '<?mso-application progid="Excel.Sheet"?>'."\n";
            echo '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" ';
            echo 'xmlns:o="urn:schemas-microsoft-com:office:office" ';
            echo 'xmlns:x="urn:schemas-microsoft-com:office:excel" ';
            echo 'xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">'."\n";
            echo '<Worksheet ss:Name="Data Rekrutmen"><Table>'."\n";

            self::row([
                'NIM',
                'Nama',
                'Semester',
                'Email',
                'Instagram',
                'Nomor WhatsApp',
                'Cabang',
                'Status',
                'Deskripsi',
                'Bukti Follow DPC',
                'e-KTM',
                'CV',
                'Dibuat Oleh',
                'Dibuat Pada',
            ]);

            $query
                ->with(['branch', 'status', 'createdBy'])
                ->chunk(200, function ($recruitments) {
                    foreach ($recruitments as $recruitment) {
                        self::row([
                            $recruitment->nim,
                            $recruitment->name,
                            $recruitment->semester,
                            $recruitment->email,
                            $recruitment->instagram,
                            WhatsAppFormatter::url($recruitment->no_wa),
                            $recruitment->branch?->name,
                            $recruitment->status?->name,
                            $recruitment->description,
                            $recruitment->follow_dpc,
                            $recruitment->ektm,
                            $recruitment->cv,
                            self::creatorName($recruitment),
                            $recruitment->created_at?->format('d/m/Y H:i'),
                        ]);
                    }
                });

            echo '</Table></Worksheet></Workbook>';
        }, $filename, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
        ]);
    }

    private static function row(array $cells): void
    {
        echo '<Row>';

        foreach ($cells as $cell) {
            echo '<Cell><Data ss:Type="String">'.e((string) ($cell ?? '-')).'</Data></Cell>';
        }

        echo '</Row>'."\n";
    }

    private static function creatorName(Recruitment $recruitment): string
    {
        if ((int) $recruitment->created_by === 1) {
            return 'System';
        }

        return $recruitment->createdBy?->name ?? 'System';
    }
}
