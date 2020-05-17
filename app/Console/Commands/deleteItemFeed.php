<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Article;
use Illuminate\Support\Facades\DB;

class deleteItemFeed extends Command
{
    const MAX = 5000;
    const DELETE_RECORD_CNT = 300;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deleteItems';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '記事を削除する';

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
     * @return mixed
     */
    public function handle()
    {
        $count = Article::count();
        if ($count < self::MAX) {
          \Log::info('記事件数が' . self::MAX . '未満のため削除なしで処理終了');
          exit;
        }
        $articles = Article::orderBy('id', 'asc')->take(self::DELETE_RECORD_CNT)->get();
        if ($articles->isEmpty()) {
          \Log::error('削除対象の記事が取得できませんでした。');
          exit;
        }
        try {
          foreach ($articles as $article) {
            $article->delete();
          }
          DB::commit();
        } catch (\Exception $e) {
          \Log::error('DBエラー発生。');
          DB::rollback();
        }
        echo '処理終了';
    }
}
