<?php

namespace App\Console\Commands;

use App\Models\Hotel;
use App\Models\Tour;
use App\Models\Transport;
use App\Services\Seo\ServiceSeoValidator;
use Illuminate\Console\Command;

class SeoAuditServices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:audit-services {--fail-on-error : Return non-zero exit code when issues are found}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Audit active tours, hotels and transports for SEO publication requirements';

    public function handle(ServiceSeoValidator $validator): int
    {
        $issues = [];

        $this->auditModel(Tour::where('status', 'active')->get(), 'tour', $validator, $issues);
        $this->auditModel(Hotel::where('status', 'active')->get(), 'hotel', $validator, $issues);
        $this->auditModel(Transport::where('status', 'active')->get(), 'transport', $validator, $issues);

        if (empty($issues)) {
            $this->info('✅ SEO audit passed. All active services meet publication requirements.');
            return self::SUCCESS;
        }

        $this->error('❌ SEO audit found issues:');
        foreach ($issues as $issue) {
            $this->line('- [' . $issue['type'] . ' #' . $issue['id'] . '] ' . $issue['name']);
            foreach ($issue['errors'] as $error) {
                $this->line('    • ' . $error);
            }
        }

        return $this->option('fail-on-error') ? self::FAILURE : self::SUCCESS;
    }

    private function auditModel(iterable $items, string $type, ServiceSeoValidator $validator, array &$issues): void
    {
        foreach ($items as $item) {
            $errors = $validator->validate($item);
            if (!empty($errors)) {
                $issues[] = [
                    'type' => $type,
                    'id' => $item->id,
                    'name' => $item->name,
                    'errors' => $errors,
                ];
            }
        }
    }
}
