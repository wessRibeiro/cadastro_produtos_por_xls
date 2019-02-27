<?php
/**
 * Created by Weslley Ribeiro.
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Date: 27/02/2019 15:17
 */

namespace Leroy\Services\Api\V1;

use Validator;
use Leroy\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductService
{
    protected $_productModel;

    public function __construct(Product $productModel)
    {
        $this->_productModel = $productModel;
    }

    public function index()
    {
        try {
            $data = $this->_productModel->all();
            return returnJson(null, 200, 'api.index.success', $data);
        } catch (\Exception $ex) {
            return returnJson(null, 400, 'api.index.error');
        }
    }

    public function store($data)
    {
        try {
            if ($entity = $this->_productModel->create($data)) {
                return returnJson(null, 201, 'api.store.success');
            }

            return returnJson(null, 400, 'api.store.error');
        } catch (\Exception $ex) {
            return returnJson($ex, 400);
        }
    }

    public function show($id)
    {
        try {
            $entity = $this->_productModel->withTrashed()->findOrFail($id);
            if (null === $entity) {
                return returnJson(null, 400, 'api.show.error');
            }
            return returnJson(null, 200, 'api.show.success', $entity);
        } catch (ModelNotFoundException $ex) {
            return returnJson(null, 400, 'api.show.error');
        } catch (\Exception $ex) {
            return returnJson(null, 400, 'api.show.error');
        }
    }

    public function update($id, $data)
    {
        try {
            if ($entity = $this->_productModel->where('id', $id)->update($data)) {
                return returnJson(null, 200, 'api.update.success');
            }

            return returnJson(null, 400, 'api.update.error');
        } catch (\Exception $ex) {
            return returnJson($ex, 400);
        }
    }

    public function destroy($id)
    {
        try {
            if ($this->_productModel->destroy($id)) {
                return returnJson(null, 200, 'api.destroy.success');
            } else {
                return returnJson(null, 400, 'api.destroy.error');
            }
        } catch (\Exception $ex) {
            return returnJson(null, 400, 'api.destroy.error');
        }
    }

    private function validateRequest($data, $rules){

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            $menssage = '';
            foreach($validator->errors()->all() as $m){
                $menssage .= $m."<br>";
            }
            return ['success' => false, 'errors'=> $menssage];
        }

        return true;
    }
}