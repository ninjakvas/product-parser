<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Product;
use Goutte\Client;
use Illuminate\Support\Str;

class ProcessParsing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $url;

    /**
     * Create a new job instance.
     *
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    public function createProduct($url)
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $name = $crawler->filter('h1')->text('not found');
        $images = $crawler->filter('.br-main-img')->extract(['src']);

        try {
            $product = Product::create([
                'name' => $name,
                'sku' => $crawler->filter('.product-code-num > span')->text('not found'),
                'brand' => $crawler->filter('.br-pr-fixed-buy')->extract(['data-brand'])[0] ?: 'not found',
                'url' => $url,
                'slug' => Str::slug($name)
            ]);
            foreach ($images as $image) {
                $product->images()->create(['url' => $image]);
            }
        } catch (QueryException $e) {
//            info($e->getMessage());
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (pathinfo($this->url, PATHINFO_EXTENSION) === 'html') {
            $this->createProduct($this->url);
        } else {
            $client = new Client();
            $crawler = $client->request('GET', $this->url);
            $links = $crawler->filter('.br-pp-desc > a')->extract(['href']);
            $base = parse_url($this->url, PHP_URL_SCHEME) . '://' . parse_url($this->url, PHP_URL_HOST);
            foreach ($links as $link) {
                $this->createProduct($base . $link);
            }
        }
    }
}
