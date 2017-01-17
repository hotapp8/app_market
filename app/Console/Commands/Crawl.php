<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\AppMarket;
use App\Models\AppTags;
use App\Models\AppScreenshot;

class Crawl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'crawl path-to-json';

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
     * @return void
     */
    public function handle()
    {
        $base_url = 'https://minapp.com/api/v3/trochili/miniapp/';
        $total_count = json_decode(file_get_contents($base_url), true)['meta']['total_count'];

        $local_count = AppMarket::count();

        if ($total_count > $local_count) {
            $objects = json_decode(file_get_contents($base_url . '?limit=' . $total_count), true)['objects'];

            foreach ($objects as $key => $value) {
                $mid = AppMarket::where('id', $value['id'])->value('id');

                if (!$mid) {
                    // Creating
                    $mid = AppMarket::insertGetId([
                        'id'             => $value['id'],
                        'uid'            => 1,
                        'name'           => $value['name'],
                        'qrcode'         => $value['qrcode']['image'],
                        'url'            => $value['url'],
                        'description'    => $value['description'],
                        'overall_rating' => $value['overall_rating'] * 10,
                        'icon'           => $value['icon']['image'],
                        'available'      => 1,
                        'create_time'    => $value['created_at'],
                        'update_time'    => $value['created_at']
                    ]);

                    $screenshot = [];
                    foreach ($value['screenshot'] as $skey => $svalue) {
                        $screenshot[$skey]['image'] = $svalue['image'];
                        $screenshot[$skey]['mid'] = $mid;
                        $screenshot[$skey]['create_time'] = time();
                        $screenshot[$skey]['update_time'] = time();
                    }
                    AppScreenshot::insert($screenshot);

                    $tags = [];
                    foreach ($value['tag'] as $tkey => $tvalue) {
                        $tags[$tkey]['tid'] = $tvalue['id'];
                        $tags[$tkey]['mid'] = $mid;
                        $tags[$tkey]['create_time'] = time();
                        $tags[$tkey]['update_time'] = time();
                    }
                    AppTags::insert($tags);

                    echo "\e[92m{$mid} Created successfully" . PHP_EOL;
                } else {
                    // Already exist
                    // echo $mid . ' Already exist' . PHP_EOL;
                }
            }
        } else {
            echo "\e[92mAlready the latest" . PHP_EOL;
        }
    }
}
