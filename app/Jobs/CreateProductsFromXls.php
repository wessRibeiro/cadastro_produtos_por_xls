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
use Leroy\Models\Product;

class CreateProductsFromXls implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $pathFile;
    public  $tries = 5;
    private $_product;

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
        //criando obj produto
        $this->_product = new Product;

        //lendo arquivo
        $productsFile = Excel::toArray(new ProductsImport, new File(storage_path("app/{$this->pathFile}")));
        //header da planilha
        $header = [];
        //armazenará os produtos formatados para insert massivo
        $productsFormated = [];

        foreach ($productsFile as $products){
            if($products[0][0] == 'Category') {
                //obtendo categoria dos produtos
                $category = $products[0][1];
                //obtendo header
                $header = $products[2];
                //adicionando coluna category para array merge
                array_push($header, 'category');

                //apagando linhas que nao sao produtos para ajudar no foreach
                unset($products[0]);
                unset($products[1]);
                unset($products[2]);


                //adicionando categoria e tratando dados
                foreach ($products as $key => $product) {

                    //im
                    $products[$key][0] = (int)$products[$key][0];
                    //free ship
                    $products[$key][2] = (boolean)$products[$key][2];
                    //description
                    //category
                    array_push($products[$key], (int)$category);

                    //formatando arrays: key => value
                    array_push($productsFormated, array_combine($header, $products[$key]));
                }
                //insert massivo
                $this->_product->insert($productsFormated);
                //apagando arquivo depois que foi processado com sucesso
                Storage::delete($this->pathFile);
            }
            break;
        }
    }
}
