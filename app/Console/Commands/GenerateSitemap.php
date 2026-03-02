<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap.xml for SEO optimization';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $sitemapController = new SitemapController();
            $response = $sitemapController->index();

            // Guardar sitemap en storage
            $sitemapPath = public_path('sitemap.xml');
            File::put($sitemapPath, $response->getContent());

            $this->info('✅ Sitemap generated successfully!');
            $this->info('📁 Location: ' . $sitemapPath);
            $this->info('📊 Size: ' . number_format(filesize($sitemapPath) / 1024, 2) . ' KB');

            return 0;
        } catch (\Exception $e) {
            $this->error('❌ Error generating sitemap: ' . $e->getMessage());
            return 1;
        }
    }
}
