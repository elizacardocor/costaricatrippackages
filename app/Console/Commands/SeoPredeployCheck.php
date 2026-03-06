<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class SeoPredeployCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:predeploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run all critical SEO checks before deployment';

    public function handle(): int
    {
        $this->info('🔎 Running SEO pre-deploy checks...');

        $hasErrors = false;

        $requiredFiles = [
            public_path('robots.txt'),
            public_path('images/og-image.jpg'),
            public_path('images/og-tours.jpg'),
            public_path('images/og-hotels.jpg'),
        ];

        foreach ($requiredFiles as $filePath) {
            if (!File::exists($filePath)) {
                $this->error('Missing required file: ' . $filePath);
                $hasErrors = true;
            }
        }

        $robotsPath = public_path('robots.txt');
        if (File::exists($robotsPath)) {
            $content = File::get($robotsPath);
            preg_match_all('/^\s*Sitemap\s*:\s*(.+)$/mi', $content, $matches);
            $sitemaps = $matches[1] ?? [];

            if (count($sitemaps) !== 1) {
                $this->error('robots.txt must contain exactly one Sitemap line. Found: ' . count($sitemaps));
                $hasErrors = true;
            }
        }

        $this->line('Running service SEO audit...');
        $exitCode = Artisan::call('seo:audit-services', ['--fail-on-error' => true]);
        $this->line(Artisan::output());

        if ($exitCode !== self::SUCCESS) {
            $hasErrors = true;
        }

        if ($hasErrors) {
            $this->error('❌ SEO pre-deploy checks failed.');
            return self::FAILURE;
        }

        $this->info('✅ SEO pre-deploy checks passed. Ready to deploy.');
        return self::SUCCESS;
    }
}
