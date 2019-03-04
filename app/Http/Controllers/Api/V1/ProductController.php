<?php
/**
 * Created by Weslley Ribeiro.
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Date: 27/02/2019 15:05
 */

namespace Leroy\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Leroy\Services\Api\V1\ProductService;
use Leroy\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $_service;
    protected $_request;

    function __construct(ProductService $service, Request $request)
    {
        $this->_request = $request;
        $this->_service = $service;
    }

    public function index(){
        try{
            $data = $this->_service->index();
            return $data;

        }catch (\Exception $ex){
            return returnJson($ex);
        }
    }

    public function store(){
        try{
            $file = $this->_request->file('products_xls');
            $data = $this->_service->store($file);
            return $data;

        }catch (\Exception $ex){
            return returnJson($ex);
        }
    }

    public function show($id){
        try{
            $data = $this->_service->show($id);
            return $data;

        }catch (\Exception $ex){
            return returnJson($ex);
        }
    }

    public function update($id){
        try{
            $data = $this->_service->update($id, $this->_request->all());
            return $data;

        }catch (\Exception $ex){
            return returnJson($ex);
        }
    }

    public function destroy($id){
        try{
            $data = $this->_service->destroy($id);
            return $data;

        }catch (\Exception $ex){
            return returnJson($ex);
        }
    }

    public function getFilesHistory()
    {
        try{
            $data = $this->_service->getFilesHistory();
            return $data;

        }catch (\Exception $ex){
            return returnJson($ex);
        }
    }
}