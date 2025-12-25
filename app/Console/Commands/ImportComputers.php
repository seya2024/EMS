<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Computer;
use Illuminate\Support\Facades\DB;

class ImportComputers extends Command
{
    protected $signature = 'import:computers {file}';
    protected $description = 'Import computers from CSV file';

    public function handle(): int
    {
        $file = $this->argument('file');

        if (!file_exists($file)) {
            $this->error('CSV file not found');
            return Command::FAILURE;
        }

        $rows = array_map('str_getcsv', file($file));
        $header = array_map('trim', array_shift($rows));

        DB::beginTransaction();

        try {
            foreach ($rows as $row) {
                $data = array_combine($header, $row);

                Computer::updateOrCreate(
                    ['serialNo' => $data['serialNo']], // unique key
                    [
                        'hardwareType' => $data['hardwareType'],
                        'pcModel' => $data['pcModel'],
                        'tagNo' => $data['tagNo'],
                        'harddiskSize' => $data['harddiskSize'],
                        'ramSize' => $data['ramSize'],
                        'speed' => $data['speed'],
                        'quantity' => (int) $data['quantity'],
                        'unit' => $data['unit'],
                        'price' => $data['price'] !== '' ? $data['price'] : null,
                        'os' => $data['os'],
                        'isActivated' => (bool) $data['isActivated'],
                        'IpAddress' => $data['IpAddress'] ?: null,
                        'hostName' => $data['hostName'] ?: null,
                        'status' => $data['status'] ?? 'Active',
                    ]
                );
            }

            DB::commit();
            $this->info('Computers imported successfully');
            return Command::SUCCESS;
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->error($e->getMessage());
            return Command::FAILURE;
        }
    }
}
