<?php

namespace Leroy\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Leroy\Imports\ProductsImport;
use Illuminate\Http\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class CreateProductsFromXls implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $pathFile;
    public $tries = 5;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($pathFile)
    {
        $this->pathFile = $pathFile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //lendo arquivo
        $productsFile = Excel::toArray(new ProductsImport, new File(storage_path("app/{$this->pathFile}")));
        foreach ($productsFile as $products){
            if($products[0][0] == 'Category'){
                $data['category'] = $products[0][1];
                unset($products[0]);
                unset($products[1]);
            }
            dd($data, $products);
            /*if(){

            }*/
            foreach ($products as $product){
                $data = [];
            }
        }
        //apagando arquivo depois de processado
        Storage::delete($this->pathFile);

    }
}
