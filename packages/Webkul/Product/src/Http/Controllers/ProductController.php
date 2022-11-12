<?php

namespace Webkul\Product\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Webkul\Admin\DataGrids\ProductDataGrid;
use Webkul\Admin\DataGrids\ShopifyFileUpload;
use Webkul\Attribute\Repositories\AttributeFamilyRepository;
use Webkul\Category\Repositories\CategoryRepository;
use Webkul\Core\Contracts\Validations\Slug;
use Webkul\Inventory\Repositories\InventorySourceRepository;
use Webkul\Product\Helpers\ProductType;
use Webkul\Product\Http\Requests\ProductForm;
use Webkul\Product\Models\Product;
use Webkul\Product\Repositories\ProductAttributeValueRepository;
use Webkul\Product\Repositories\ProductDownloadableLinkRepository;
use Webkul\Product\Repositories\ProductDownloadableSampleRepository;
use Webkul\Product\Repositories\ProductInventoryRepository;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Attribute\Repositories\AttributeGroupRepository;
use Webkul\Attribute\Repositories\AttributeGroupMapRepository;
use Webkul\Attribute\Repositories\AttributeRepository;

ini_set('max_execution_time', 3000);

class ProductController extends Controller
{
    /**
     * Contains route related configuration.
     *
     * @var array
     */
    protected $_config;

    /**
     * Category repository instance.
     *
     * @var \Webkul\Category\Repositories\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * Product repository instance.
     *
     * @var \Webkul\Product\Repositories\ProductRepository
     */
    protected $productRepository;

    /**
     * Product downloadable link repository instance.
     *
     * @var \Webkul\Product\Repositories\ProductDownloadableLinkRepository
     */
    protected $productDownloadableLinkRepository;

    /**
     * Product downloadable sample repository instance.
     *
     * @var \Webkul\Product\Repositories\ProductDownloadableSampleRepository
     */
    protected $productDownloadableSampleRepository;

    /**
     * Attribute family repository instance.
     *
     * @var \Webkul\Attribute\Repositories\AttributeFamilyRepository
     */
    protected $attributeFamilyRepository;
    protected $attributeRepository;
    protected $attributeGroupRepository;
    protected $attributeGroupMapRepository;

    /**
     * Inventory source repository instance.
     *
     * @var \Webkul\Inventory\Repositories\InventorySourceRepository
     */
    protected $inventorySourceRepository;

    /**
     * Product attribute value repository instance.
     *
     * @var \Webkul\Product\Repositories\ProductAttributeValueRepository
     */
    protected $productAttributeValueRepository;

    /**
     * Product inventory repository instance.
     *
     * @var \Webkul\Product\Repositories\ProductInventoryRepository
     */
    protected $productInventoryRepository;

    protected $shop_category = null;
    protected $delivery_charge = null;
    protected $countries = null;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Category\Repositories\CategoryRepository                 $categoryRepository
     * @param  \Webkul\Product\Repositories\ProductRepository                   $productRepository
     * @param  \Webkul\Product\Repositories\ProductDownloadableLinkRepository   $productDownloadableLinkRepository
     * @param  \Webkul\Product\Repositories\ProductDownloadableSampleRepository $productDownloadableSampleRepository
     * @param  \Webkul\Attribute\Repositories\AttributeFamilyRepository         $attributeFamilyRepository
     * @param  \Webkul\Inventory\Repositories\InventorySourceRepository         $inventorySourceRepository
     * @param  \Webkul\Product\Repositories\ProductAttributeValueRepository     $productAttributeValueRepository
     * @return void
     */
    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        ProductDownloadableLinkRepository $productDownloadableLinkRepository,
        ProductDownloadableSampleRepository $productDownloadableSampleRepository,
        AttributeFamilyRepository $attributeFamilyRepository,
        AttributeGroupRepository $attributeGroupRepository,
        AttributeGroupMapRepository $attributeGroupMapRepository,
        AttributeRepository $attributeRepository,
        InventorySourceRepository $inventorySourceRepository,
        ProductAttributeValueRepository $productAttributeValueRepository,
        ProductInventoryRepository $productInventoryRepository
    ) {
        $this->_config = request('_config');

        $this->categoryRepository = $categoryRepository;

        $this->productRepository = $productRepository;

        $this->productDownloadableLinkRepository = $productDownloadableLinkRepository;

        $this->productDownloadableSampleRepository = $productDownloadableSampleRepository;

        $this->attributeFamilyRepository = $attributeFamilyRepository;

        $this->attributeGroupRepository = $attributeGroupRepository;

        $this->attributeGroupMapRepository = $attributeGroupMapRepository;

        $this->attributeRepository = $attributeRepository;

        $this->inventorySourceRepository = $inventorySourceRepository;

        $this->productAttributeValueRepository = $productAttributeValueRepository;

        $this->productInventoryRepository = $productInventoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(ProductDataGrid::class)->toJson();
        }

        return view($this->_config['view']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $families = $this->attributeFamilyRepository->all();

        $categories = $this->categoryRepository->getCategoryTree();

        $inventorySources = $this->inventorySourceRepository->findWhere(['status' => 1]);

        $configurableFamily = null;

        if ($familyId = request()->get('family')) {
            $configurableFamily = $this->attributeFamilyRepository->find($familyId);
        }

        $countries = DB::table('countries')->orderBy('name', 'ASC')->get();

        return view($this->_config['view'], compact('families', 'inventorySources', 'configurableFamily', 'countries', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if (
            !request()->get('family')
            && ProductType::hasVariants(request()->input('type'))
            && request()->input('sku') != ''
        ) {
            return redirect(url()->current() . '?type=' . request()->input('type') . '&family=' . request()->input('attribute_family_id') . '&sku=' . request()->input('sku') . '&country=' . request()->input('country') . '&delivery_charge=' . request()->input('delivery_charge'));
        }

        if (
            ProductType::hasVariants(request()->input('type'))
            && (!request()->has('super_attributes')
                || !count(request()->get('super_attributes')))
        ) {
            session()->flash('error', trans('admin::app.catalog.products.configurable-error'));

            return back();
        }

        $this->validate(request(), [
            'type'                => 'required',
            'attribute_family_id' => 'required',
            'country'             => 'required',
            'delivery_charge'     => 'required',
            'sku'                 => ['required', 'unique:products,sku', new Slug],
        ]);
        $product = $this->productRepository->create(request()->all());

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Product']));

        return redirect()->route($this->_config['redirect'], ['id' => $product->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = $this->productRepository->with(['variants', 'variants.inventories'])->findOrFail($id);

        $categories = $this->categoryRepository->getCategoryTree();

        $inventorySources = $this->inventorySourceRepository->findWhere(['status' => 1]);
        $countries = DB::table('countries')->orderBy('name', 'ASC')->get();
        $c_count = 1;
        $d_count = 1;
        return view($this->_config['view'], compact('product', 'categories', 'inventorySources', 'countries', 'c_count', 'd_count'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Webkul\Product\Http\Requests\ProductForm  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductForm $request, $id)
    {
        $data = request()->all();

        $multiselectAttributeCodes = [];

        $productAttributes = $this->productRepository->findOrFail($id);

        foreach ($productAttributes->attribute_family->attribute_groups as $attributeGroup) {
            $customAttributes = $productAttributes->getEditableAttributes($attributeGroup);

            if (count($customAttributes)) {
                foreach ($customAttributes as $attribute) {
                    if ($attribute->type == 'multiselect' || $attribute->type == 'checkbox') {
                        array_push($multiselectAttributeCodes, $attribute->code);
                    }
                }
            }
        }

        if (count($multiselectAttributeCodes)) {
            foreach ($multiselectAttributeCodes as $multiselectAttributeCode) {
                if (!isset($data[$multiselectAttributeCode])) {
                    $data[$multiselectAttributeCode] = [];
                }
            }
        }

        $this->productRepository->update($data, $id);

        session()->flash('success', trans('admin::app.response.update-success', ['name' => 'Product']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Update inventories.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateInventories($id)
    {
        $product = $this->productRepository->findOrFail($id);

        $this->productInventoryRepository->saveInventories(request()->all(), $product);

        return response()->json([
            'message'      => __('admin::app.catalog.products.saved-inventory-message'),
            'updatedTotal' => $this->productInventoryRepository->where('product_id', $product->id)->sum('qty'),
        ]);
    }

    /**
     * Uploads downloadable file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadLink($id)
    {
        return response()->json(
            $this->productDownloadableLinkRepository->upload(request()->all(), $id)
        );
    }

    /**
     * Copy a given Product.
     *
     * @param  int  $productId
     * @return \Illuminate\Http\Response
     */
    public function copy(int $productId)
    {
        $originalProduct = $this->productRepository->findOrFail($productId);

        if (!$originalProduct->getTypeInstance()->canBeCopied()) {
            session()->flash(
                'error',
                trans('admin::app.response.product-can-not-be-copied', [
                    'type' => $originalProduct->type,
                ])
            );

            return redirect()->to(route('admin.catalog.products.index'));
        }

        if ($originalProduct->parent_id) {
            session()->flash(
                'error',
                trans('admin::app.catalog.products.variant-already-exist-message')
            );

            return redirect()->to(route('admin.catalog.products.index'));
        }

        $copiedProduct = $this->productRepository->copy($originalProduct);

        if ($copiedProduct instanceof Product && $copiedProduct->id) {
            session()->flash('success', trans('admin::app.response.product-copied'));
        } else {
            session()->flash('error', trans('admin::app.response.error-while-copying'));
        }

        return redirect()->to(route('admin.catalog.products.edit', ['id' => $copiedProduct->id]));
    }

    /**
     * Uploads downloadable sample file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadSample($id)
    {
        return response()->json(
            $this->productDownloadableSampleRepository->upload(request()->all(), $id)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->findOrFail($id);

        try {
            $this->productRepository->delete($id);

            return response()->json([
                'message' => trans('admin::app.response.delete-success', ['name' => 'Product']),
            ]);
        } catch (Exception $e) {
            report($e);
        }

        return response()->json([
            'message' => trans('admin::app.response.delete-failed', ['name' => 'Product']),
        ], 500);
    }

    /**
     * Mass delete the products.
     *
     * @return \Illuminate\Http\Response
     */
    public function massDestroy()
    {
        $productIds = explode(',', request()->input('indexes'));

        foreach ($productIds as $productId) {
            $product = $this->productRepository->find($productId);

            if (isset($product)) {
                $this->productRepository->delete($productId);
            }
        }

        session()->flash('success', trans('admin::app.catalog.products.mass-delete-success'));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Mass update the products.
     *
     * @return \Illuminate\Http\Response
     */
    public function massUpdate()
    {
        $data = request()->all();

        if (!isset($data['massaction-type'])) {
            return redirect()->back();
        }

        if (!$data['massaction-type'] == 'update') {
            return redirect()->back();
        }

        $productIds = explode(',', $data['indexes']);

        foreach ($productIds as $productId) {
            $this->productRepository->update([
                'channel' => null,
                'locale'  => null,
                'status'  => $data['update-options'],
            ], $productId);
        }

        session()->flash('success', trans('admin::app.catalog.products.mass-update-success'));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * To be manually invoked when data is seeded into products.
     *
     * @return \Illuminate\Http\Response
     */
    public function sync()
    {
        Event::dispatch('products.datagrid.sync', true);

        return redirect()->route('admin.catalog.products.index');
    }

    /**
     * Result of search product.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function productLinkSearch()
    {
        if (request()->ajax()) {
            $results = [];

            foreach ($this->productRepository->searchProductByAttribute(request()->input('query')) as $row) {
                $results[] = [
                    'id'   => $row->product_id,
                    'sku'  => $row->sku,
                    'name' => $row->name,
                ];
            }

            return response()->json($results);
        } else {
            return view($this->_config['view']);
        }
    }

    /**
     * Download image or file.
     *
     * @param  int  $productId
     * @param  int  $attributeId
     * @return \Illuminate\Http\Response
     */
    public function download($productId, $attributeId)
    {
        $productAttribute = $this->productAttributeValueRepository->findOneWhere([
            'product_id'   => $productId,
            'attribute_id' => $attributeId,
        ]);

        return Storage::download($productAttribute['text_value']);
    }

    /**
     * Search simple products.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchSimpleProducts()
    {
        return response()->json(
            $this->productRepository->searchSimpleProducts(request()->input('query'))
        );
    }

    public function custum_bulk_upload()
    {
        $attribute_families = DB::table('attribute_families')->get();
        $countries = DB::table('countries')->get();
        // $categories = $this->categoryRepository->get() ;

        if (request()->ajax()) {
            return app(ShopifyFileUpload::class)->toJson();
        }
        return view($this->_config['view'], compact('attribute_families','countries'));
    }

    public function save_bulk_upload()
    {

        $d = request()->validate([
            'attribute_families' => 'required|string',
            'type' => 'required|string',
            'margin' => 'required|numeric',
            'delivery_charge' => 'required|numeric',
            'countries' => 'required',
        ]);

        $this->countries = json_encode($d['countries']);
        $this->delivery_charge = $d['delivery_charge'];

        $name = request()->file('csv-file')->getClientOriginalName();
        $check = DB::table('shopify_file_csv')->where('file_name', "converted_csv/converted-$name")->get()->count();

        if ($check > 0) {
            session()->flash('error', 'File Name Already Exists!');
            return redirect()->back();
        }

        // $d['categories'] = implode(',',$d['categories']) ;

        $file = fopen(request()->file('csv-file'), "r");
        $data = [];
        while (!feof($file)) {
            $data[] = fgetcsv($file);
        }
        fclose($file);

        if ($d['type'] == 'Simple') $completed = $this->manipulate_file($data, $name, $d);
        else $completed = $this->manipulate_file_config($data, $name, $d);

        if ($completed) {
            $upload['vendor_id'] = auth()->guard('admin')->user()->id;
            $upload['file_name'] = "converted_csv/converted-$name";

            $check = DB::table('shopify_file_csv')->insert($upload);

            if ($check) session()->flash('success', 'File Converted Successfully!');
            else session()->flash('failed', 'File Conversion Unsuccessful!');

            return redirect()->back();
        }
    }

    public function manipulate_file($data, $name, $d)
    {

        //Change Header for Bulk Upload
        $data[0][0] = 'url_key';
        $data[0][1] = 'name';
        $data[0][2] = 'description';
        $data[0][4] = 'categories_slug';
        $data[0][6] = 'status';
        $data[0][13] = 'sku';
        $data[0][14] = 'weight';
        $data[0][15] = 'inventory_sources';
        $data[0][16] = 'inventories';
        $data[0][19] = 'price';
        $data[0][21] = 'tax_category_id';
        $data[0][24] = 'images';
        $data[0][28] = 'meta_title';
        $data[0][29] = 'meta_description';

        //Remove Null Value Record at Last
        if (!$data[count($data) - 1]) unset($data[count($data) - 1]);

        //Image Implode and Extra Row Removal
        foreach ($data as $key => $item) {
            if ($key == 0) continue;

            if ($item[25] == "1") {
                $parent = $key;
            }

            if ((int)$item[25] > 1) {
                $data[$parent][24] = $data[$parent][24] . ',' . $data[$key][24];
                unset($data[$key]);
                // unset($data[$parent][25]);
            }
        }
        foreach ($data as $key => $item) {
            unset($data[$key][25]);
        }

        //Column Removal and Updation
        foreach ($data as $key => $value) {
            unset(
                $data[$key][3],
                $data[$key][5],
                $data[$key][17],
                $data[$key][18],
                $data[$key][20],
                $data[$key][22],
                $data[$key][23],
                $data[$key][26],
                $data[$key][27],
                $data[$key][30],
                $data[$key][31],
                $data[$key][32],
                $data[$key][33],
                $data[$key][34],
                $data[$key][35],
                $data[$key][36],
                $data[$key][37],
                $data[$key][38],
                $data[$key][39],
                $data[$key][40],
                $data[$key][41],
                $data[$key][42],
                $data[$key][43],
                $data[$key][44],
                $data[$key][45],
                $data[$key][46]
            );
            if ($key == 0) {
                $data[$key][30] = 'new';
                $data[$key][31] = 'featured';
                $data[$key][32] = 'visible_individually';
                $data[$key][33] = 'cost';
                $data[$key][34] = 'width';
                $data[$key][35] = 'height';
                $data[$key][36] = 'depth';
                $data[$key][37] = 'type';
                $data[$key][38] = 'attribute_family_name';
                $data[$key][39] = 'guest_checkout';
                $data[$key][40] = 'meta_keywords';
                $data[$key][41] = 'short_description';
                $data[$key][42] = 'special_price';
                $data[$key][43] = 'special_price_from';
                $data[$key][44] = 'special_price_to';
            } else {
                $data[$key][0] = strtolower($value[0]);
                $category = $this->categoryCheck($data[$key][4]);
                $data[$key][4] = $category;
                $data[$key][6] = $data[$key][6] == "TRUE" ? 1 : 0;
                $data[$key][15] = 'default';
                $data[$key][21] = null;
                $data[$key][30] = 0;
                $data[$key][31] = 0;
                $data[$key][32] = 1;
                $data[$key][33] = null;
                $data[$key][34] = null;
                $data[$key][35] = null;
                $data[$key][36] = null;
                $data[$key][37] = 'simple';
                $data[$key][38] = $d['attribute_families'];
                $data[$key][39] = 1;
                $data[$key][40] = null;
                $data[$key][41] = $data[$key][2] ? explode('<br', $data[$key][2])[0] : '';
                $data[$key][42] = null;
                $data[$key][43] = null;
                $data[$key][44] = null;
            }
        }

        //Parent Array Reindexing
        $data = array_values($data);

        //Item Array Reindexing
        foreach ($data as $key => $item) {
            $data[$key] = array_values($item);
        }

        //Attribute Header Set
        foreach ($data as $key => $item) {
            if ($key == 0) continue;

            if (false == $location = array_search(strtolower($item[5]), $data[0])) if (strtolower($item[5]) != '') $data[0][] = strtolower($item[5]);
            if (false == $location = array_search(strtolower($item[7]), $data[0])) if (strtolower($item[7]) != '') $data[0][] = strtolower($item[7]);
            if (false == $location = array_search(strtolower($item[9]), $data[0])) if (strtolower($item[9]) != '') $data[0][] = strtolower($item[9]);
        }

        //All Attributes Null
        foreach ($data as $key => $item) {
            if ($key == 0) continue;
            $len = count($data[0]);
            if ($len > 34) {
                $i = 34 + 1;
                while ($i < $len) {
                    $data[$key][$i] = null;
                    $i++;
                }
            }
        }

        // Updating Attribute Values
        foreach ($data as $key => $item) {
            if ($key == 0) continue;

            if (false !== $location = array_search(strtolower($item[5]), $data[0])) if (strtolower($item[5 + 1]) != '') $data[$key][$location] = $item[5 + 1];
            if (false !== $location = array_search(strtolower($item[7]), $data[0])) if (strtolower($item[7 + 1]) != '') $data[$key][$location] = $item[7 + 1];
            if (false !== $location = array_search(strtolower($item[9]), $data[0])) if (strtolower($item[9 + 1]) != '') $data[$key][$location] = $item[9 + 1];
        }

        //User ID + Country + Delivery Charge Column Addition 
        foreach ($data as $key => $item) {
            if ($key == 0) {
                $data[0][] = 'user_id';
                $data[0][] = 'country';
                $data[0][] = 'delivery_charge';
            } else {
                $data[$key][] = auth()->guard('admin')->user()->id;
                $data[$key][] = $this->countries;
                $data[$key][] = $this->delivery_charge;
            }
        }

        //Deleting Original Attributes Column
        foreach ($data as $key => $item) {
            unset($data[$key][5], $data[$key][6], $data[$key][7], $data[$key][8], $data[$key][9], $data[$key][10]);
        }

        //Item Array Reindexing
        foreach ($data as $key => $item) {
            $data[$key] = array_values($item);
        }

        $length = count($data[0]);

        //Adding min and max price
        $data[0][$length] = 'min_price';
        $data[0][$length + 1] = 'max_price';

        foreach ($data as $key => $value) {
            if ($key == 0) continue;

            $data[$key][$length] = $value[9];
            $data[$key][$length + 1] = $value[9];
        }

        //Attributes header Style FORMATTING 
        foreach ($data[0] as $key => $value) {
            if ($key > 28 && $key < (count($data[0]) - 3)) {
                $data[0][$key] = str_replace(' ', '_', $value);
            }
        }

        // dd($data);

        // $data = include(public_path('csvjson.php'));
        $fp = fopen(public_path("converted_csv/converted-$name"), 'w+');
        foreach ($data as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);

        return true;
    }

    public function manipulate_file_config($data, $name, $d)
    {

        //Change Header for Bulk Upload
        $data[0][0] = 'url_key';
        $data[0][1] = 'name';
        $data[0][2] = 'description';
        $data[0][4] = 'categories_slug';
        $data[0][6] = 'status';
        $data[0][13] = 'sku';
        $data[0][14] = 'weight';
        $data[0][15] = 'inventory_sources';
        $data[0][16] = 'inventories';
        $data[0][19] = 'price';
        $data[0][21] = 'tax_category_id';
        $data[0][24] = 'images';
        $data[0][28] = 'meta_title';
        $data[0][29] = 'meta_description';


        //Remove Null Value Record at Last
        if (!$data[count($data) - 1]) unset($data[count($data) - 1]);

        //Image Implode and Extra Row Removal
        foreach ($data as $key => $item) {
            if ($key == 0) continue;

            if ($item[25] == "1") {
                $parent = $key;
            }

            if ((int)$item[25] > 1) {
                $data[$parent][24] = $data[$parent][24] . ',' . $data[$key][24];
                $data[$key][24] = '';

                if ($data[$key][13] == '' && array_key_exists($key + 1, $data) && $data[$key + 1][25] != '1') unset($data[$key]);
                // unset($data[$parent][25]);
            }
        }

        //Null Meta Desc in Child Cell
        foreach ($data as $key => $item) {
            if ($key == 0) continue;
            if ($item[13] == '') {
                $data[$key][26] = '';
                $data[$key][27] = '';
                $data[$key][28] = '';
            }
            if ($item[25] != "1") {
                $data[$key][29] = '';
            }
        }

        //Extra Variant Row Addition
        $newData = [];
        $parent = '';
        foreach ($data as $key => $value) {
            if ($key == 0) $newData[] = $value;
            else {
                if ($data[$key][25] == '1') {
                    $parent = $key;
                    $newData[] = $value;
                } else {
                    if ($data[$key][25] == '2' && $data[$key][13] != '') {
                        $newData[] = $value;
                        $last = array_keys($newData);
                        $last = end($last);
                        $newData[$last][8] = $data[$parent][8];
                        $newData[$last][10] = $data[$parent][10];
                        $newData[$last][12] = $data[$parent][12];

                        $newData[] = $value;
                    } else $newData[] = $value;
                }
            }
        }
        $data = $newData;

        //Column Removal and Updation
        foreach ($data as $key => $value) {
            unset(
                $data[$key][3],
                $data[$key][5],
                $data[$key][17],
                $data[$key][18],
                $data[$key][20],
                $data[$key][22],
                $data[$key][23],
                $data[$key][26],
                $data[$key][27],
                $data[$key][30],
                $data[$key][31],
                $data[$key][32],
                $data[$key][33],
                $data[$key][34],
                $data[$key][35],
                $data[$key][36],
                $data[$key][37],
                $data[$key][38],
                $data[$key][39],
                $data[$key][40],
                $data[$key][41],
                $data[$key][42],
                $data[$key][43],
                $data[$key][44],
                $data[$key][45],
                $data[$key][46]
            );
            if ($key == 0) {
                $data[$key][30] = 'new';
                $data[$key][31] = 'featured';
                $data[$key][32] = 'visible_individually';
                $data[$key][33] = 'cost';
                $data[$key][34] = 'width';
                $data[$key][35] = 'height';
                $data[$key][36] = 'depth';
                $data[$key][37] = 'type';
                $data[$key][38] = 'attribute_family_name';
                $data[$key][39] = 'guest_checkout';
                $data[$key][40] = 'meta_keywords';
                $data[$key][41] = 'short_description';
                $data[$key][42] = 'special_price';
                $data[$key][43] = 'special_price_from';
                $data[$key][44] = 'special_price_to';
            } else {
                $data[$key][0] = preg_replace("/[^A-Za-z0-9_-]+/", "", strtolower($value[0]));
                //category
                if ($data[$key][25] == '1') {
                    $data[$key][4] = str_replace('\'', '', $data[$key][4]);

                    if ($this->shop_category == null) {
                        $category = $this->categoryCheck($data[$key][4]);
                    } else {
                        $category = $this->shop_category->slug;
                    }

                    $data[$key][4] = $category;
                } else $data[$key][4] = '';
                //STATUS
                // if($data[$key][25] == '1') {
                // $data[$key][6] = $data[$key][6] == "TRUE" ? 1 : 0;
                $data[$key][6] = 1;
                // }
                // else $data[$key][6] = '' ;
                $data[$key][13] = str_replace([' ', '\"', '\''], '-', $value[13]);
                $data[$key][15] = 'default';
                $data[$key][21] = null;
                $data[$key][30] = 0;
                $data[$key][31] = 0;
                $data[$key][32] = 1;
                $data[$key][33] = null;
                $data[$key][34] = null;
                $data[$key][35] = null;
                $data[$key][36] = null;
                $data[$key][37] = $data[$key][25] == '1' ? 'configurable' : 'variant';
                $data[$key][38] = $d['attribute_families'];
                $data[$key][39] = 1;
                $data[$key][40] = null;
                $data[$key][41] = $data[$key][2] ? explode('<br', $data[$key][2])[0] : '';
                $data[$key][42] = null;
                $data[$key][43] = null;
                $data[$key][44] = null;
            }
        }

        //Columns Addition and Price Change
        foreach ($data as $key => $item) {
            if ($key == 0) {
                $data[0][] = 'user_id';
                $data[0][] = 'country';
                $data[0][] = 'delivery_charge';
                $data[0][] = 'barcode';
                $data[0][] = 'min_price';
                $data[0][] = 'max_price';
                $data[0][] = 'super_attributes';
                $data[0][] = 'super_attribute_option';
                $data[0][] = 'super_attribute_price';
                $data[0][] = 'super_attribute_qty';
                $data[0][] = 'super_attribute_weight';
            } else {
                $data[$key][42] = (int) $data[$key][19];
                $data[$key][19] = ceil(((int) $data[$key][19]) * (1 + ($d['margin'] / 100)));

                $data[$key][] = auth()->guard('admin')->user()->id;
                $data[$key][] = $this->countries;
                $data[$key][] = $this->delivery_charge;
                $data[$key][] = 0;
                $data[$key][] = $data[$key][42];
                $data[$key][] = $data[$key][19];
                $data[$key][] = '';
                $data[$key][] = '';
                $data[$key][] = '';
                $data[$key][] = '';
                $data[$key][] = '';
            }
        }

        //Image Position Column Removal
        foreach ($data as $key => $item) {
            unset($data[$key][25]);
        }

        //Parent Array Reindexing
        $data = array_values($data);

        //Item Array Reindexing
        foreach ($data as $key => $item) {
            $data[$key] = array_values($item);
        }

        $parent = '';

        // Updating Attribute Values
        foreach ($data as $key => $item) {
            if ($key == 0) continue;
            if ($item[27] == 'configurable') {
                $parent = $key;
                $data[$key][11] = strtolower($item[11]);
            } else {
                $data[$key][41] = strtolower($data[$parent][5] . ($data[$parent][7] != '' ? ',' : '') . $data[$parent][7] . ($data[$parent][9] != '' ? ',' : '') . $data[$parent][9]);
                if ($item[11] == '') {
                    $data[$key][11] = strtolower(
                        $data[$parent][11] . ($data[$parent][6] != '' ? '-' : '') . str_replace([',', ' '], '-', $data[$parent][6])
                            . ($data[$parent][8] != '' ? '-' : '') .
                            str_replace([',', ' '], '-', $data[$parent][8])
                            . ($data[$parent][10] != '' ? '-' : '') .
                            str_replace([',', ' '], '-', $data[$parent][10])
                    );
                    $data[$key][42] =
                        preg_replace('/\s+/', ' ', str_replace(',', ' ', $data[$parent][6]))
                        . ($data[$parent][8] != '' ? ',' : '') .
                        preg_replace('/\s+/', ' ', str_replace(',', ' ', $data[$parent][8]))
                        . ($data[$parent][10] != '' ? ',' : '') .
                        preg_replace('/\s+/', ' ', str_replace(',', ' ', $data[$parent][10]));
                } else {
                    $data[$key][11] = strtolower(
                        $data[$key][11] . '-' . str_replace([',', ' '], '-', $data[$key][6])
                            . ($data[$parent][8] != '' ? '-' : '') .
                            str_replace([',', ' '], '-', $data[$key][8])
                            . ($data[$parent][10] != '' ? '-' : '') .
                            str_replace([',', ' '], '-', $data[$key][10])
                    );
                    $data[$key][42] =
                        preg_replace('/\s+/', ' ', str_replace([','], ' ', $data[$key][6]))
                        . ($data[$parent][8] != '' ? ',' : '') .
                        preg_replace('/\s+/', ' ', str_replace([','], ' ', $data[$key][8]))
                        . ($data[$parent][10] != '' ? ',' : '') .
                        preg_replace('/\s+/', ' ', str_replace([','], ' ', $data[$key][10]));
                }

                $data[$key][43] = $data[$parent][15];
                $data[$key][44] = $data[$parent][14];
                $data[$key][45] = $data[$parent][12];
                $data[$key][1] = $data[$parent][1];
                $data[$key][2] = $data[$parent][2];
                $data[$key][19] = $data[$parent][19];
                $data[$key][22] = 0; //Visble Indivdually False

                $data[$key][32] =  $data[$parent][32]; //Special Price
                $data[$key][15] = $data[$parent][15]; // MRP
                $data[$key][39] = $data[$parent][39]; // Min Price
                $data[$key][40] = $data[$parent][40]; // Max Price
            }
        }


        //Deleting Original Attributes Column
        foreach ($data as $key => $item) {
            unset($data[$key][5], $data[$key][6], $data[$key][7], $data[$key][8], $data[$key][9], $data[$key][10], $data[$key][12], $data[$key][14]);
        }

        //Item Array Reindexing
        foreach ($data as $key => $item) {
            $data[$key] = array_values($item);
        }

        //For Attribute Checking and Addition
        foreach ($data as $key => $value) {
            if ($key == 0) continue;
            if ($value[19] != 'configurable') {
                $att_code = explode(',', $value[33]);
                $att_values = explode(',', $value[34]);
                $pass_data = [];
                if ($att_code[0] != '' && $att_values[0] != '') $pass_data[] = [$att_code[0], $att_values[0]];
                if (isset($att_code[1]) && $att_code[1] != '' && $att_values[1] != '') $pass_data[] = [$att_code[1], $att_values[1]];
                if (isset($att_code[2]) && $att_code[2] != '' && $att_values[2] != '') $pass_data[] = [$att_code[2], $att_values[2]];
                // dd($pass_data);
                // $pass_data = [[$att_code[0],$att_values[0]],[$att_code[1],$att_values[1]],[$att_code[2],$att_values[2]]] ;
                $this->attributeCheck_config($pass_data, $d['attribute_families']);
            }
        }

        // dd($data);
        // $data= json_decode( json_encode($data), true);

        $fp = fopen(public_path("converted_csv/converted-$name"), 'w+');
        foreach ($data as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);

        return true;
    }

    public function categoryCheck($category)
    {
        $cat = strtolower(str_replace(" ", "-", $category));
        // $check = DB::table('category_translations')->where('slug', $cat)->first() ;
        $check = DB::table('category_translations')->where('slug', 'like', "%$cat%")->first();
        if (isset($check)) {
            $this->shop_category = $check;
            return $check->slug;
        } else {
            $data['position'] = 1;
            $data['status'] = 0;
            $data['parent_id'] = 1;
            $data['display_mode'] = 'products_only';
            $insert = $this->categoryRepository->create($data);
            if ($insert) {
                $newCat['name'] = $category;
                $newCat['slug'] = $cat;
                $newCat['category_id'] = $insert->id;
                $newCat['locale'] = 'en';
                $newCat['locale_id'] = 1;
                DB::table('category_translations')->insertGetId($newCat);
            }

            return $cat;
        }
    }


    public function attributeCheck_config($pass_data, $af)
    {
        $aFamily = $this->attributeFamilyRepository->findOneByfield(['name' => $af]);
        $attributeArray = $this->attributeRepository->pluck('code')->toArray();


        $attribute_fam_groups = $this->attributeGroupRepository->where('attribute_family_id', $aFamily->id)->pluck('id');
        $all_fam_attributes = $this->attributeGroupMapRepository->whereIn('attribute_group_id', $attribute_fam_groups)->pluck('attribute_id');
        $all_fam_att_codes = $this->attributeRepository->whereIn('id', $all_fam_attributes)->pluck('code')->toArray();
        $fam_gen = $this->attributeGroupRepository->where('attribute_family_id', $aFamily->id)->where('name', 'General')->first();
        // dd($aFamily,$attribute_fam_groups,$all_fam_att_codes,$all_fam_attributes, $fam_gen) ;


        foreach ($pass_data as $key => $value) {
            if ($value[0] != '' && $value[1] != '') {
                if (in_array($value[0], $attributeArray)) {
                    $att_to_add = $this->attributeRepository->where('code', $value[0])->first();
                    if (!in_array($value[0], $all_fam_att_codes)) {
                        DB::table('attribute_group_mappings')->insert([
                            'attribute_id' => $att_to_add->id,
                            'attribute_group_id' => $fam_gen->id
                        ]);
                    }
                    //Link attribute with category
                    $check0  = DB::table('category_filterable_attributes')->where('attribute_id', $att_to_add->id)->where('category_id', $this->shop_category->category_id)->count();
                    if($check0 <1 ){
                        $cfa_id =  DB::table('category_filterable_attributes')->insertGetId([
                            'attribute_id' => $att_to_add->id,
                            'category_id' => $this->shop_category->category_id,
                        ]);
                    }

                    //check for option existence
                    $check  = DB::table('attribute_options')->where('attribute_id', $att_to_add->id)->where('admin_name', $value[1])->first();
                    if (empty($check)) {

                        $new_option_id =  DB::table('attribute_options')->insertGetId([
                            'attribute_id' => $att_to_add->id,
                            'admin_name' => $value[1],
                            'sort_order' => 1,
                        ]);

                        //Linking option with category
                        DB::table('attribute_category_options')->insert([
                            'attribute_id' => $att_to_add->id,
                            'category_id' => $this->shop_category->category_id,
                            'option_id' => $new_option_id,
                        ]);
                    }

                    else{
                        $check1  = DB::table('attribute_category_options')->where('option_id', $check->id)->where('category_id', $this->shop_category->category_id)->count();
                        if ($check1 < 1) {
                            //Linking option with category
                            DB::table('attribute_category_options')->insert([
                                'attribute_id' => $att_to_add->id,
                                'category_id' => $this->shop_category->category_id,
                                'option_id' => $check->id,
                            ]);
                        }
                    }
                } else {

                    //Created attribute
                    $id = $this->attributeRepository->insertGetId([
                        'code' => $value[0],
                        'admin_name' => ucwords(str_replace("_", " ", $value[0])),
                        'is_visible_on_front' => 1,
                        'is_configurable' => 1,
                        'is_filterable' => 1,
                        'swatch_type' => 'dropdown',
                        'type' => 'select',
                    ]);

                    //Link attribute with category
                    $cfa_id =  DB::table('category_filterable_attributes')->insertGetId([
                        'attribute_id' => $id,
                        'category_id' => $this->shop_category->category_id,
                    ]);

                    //Linked to group
                    DB::table('attribute_group_mappings')->insert([
                        'attribute_id' => $id,
                        'attribute_group_id' => $fam_gen->id
                    ]);

                    //Creating option 
                    $new_option_id =  DB::table('attribute_options')->insertGetId([
                        'attribute_id' => $id,
                        'admin_name' => $value[1],
                        'sort_order' => 1,
                    ]);

                    //Linking option with category
                    DB::table('attribute_category_options')->insert([
                        'attribute_id' => $id,
                        'category_id' => $this->shop_category->category_id,
                        'option_id' => $new_option_id,
                    ]);
                }
            }
        }
    }

    public function delete_shopify_file($id)
    {
        $check = DB::table('shopify_file_csv')->find($id);
        if (file_exists($file =  public_path($check->file_name))) {
            unlink($file);
            $flag = DB::table('shopify_file_csv')->delete($id);
        }
        if ($flag) return response()->json(['message' => 'File Deleted Successfully!']);
        else return response()->json(['message' => 'File Deletion Unsuccessful!'], 500);
    }

    public function download_shopify_file($id)
    {
        $check = DB::table('shopify_file_csv')->find($id);
        if (file_exists($file =  public_path($check->file_name))) {
            return response()->download($file);
        } else return response()->json(['message' => 'File Not Found!'], 500);
    }

    public function save_bulk_upload_back($data)
    {
        unset($data[count($data) - 1]);


        // $data = include(public_path('csvjson.php'));
        $parent = 0;
        $fp = fopen('file1.csv', 'w+');

        foreach ($data as $key => $item) {
            if ($key == 0) continue;
            // dd($item[25]);
            // $current_index = $key;
            // if(!isset($item[25])){
            //     print_r("hello");
            // }
            if ($item[25] == "1") {
                $parent = $key;
            }
            // if(current($item['Handle']) == next($item['Handle'])){
            //     $data[$parent]['Image Src'] = $data[$parent]['Image Src'].','.$data[$key]['Image Src'];
            //     // current($item['Image Src']) .= (','.next(($item['Image Src'])));
            // }
            if ((int)$item[25] > 1) {
                $data[$parent][24] = $data[$parent][24] . ',' . $data[$key][24];
                unset($data[$key]);
            }
        }
        foreach ($data as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);


        // dd($data);
    }
    // if(false !== $new_location = array_search($item[7], $new_attributes)){

    //     // $data[$key][$location] = $item[8];
    //     $data[$key][45 + $new_location] = $item[8];
    // }

    // else{
    //     $new_attributes[] =  $item[7];
    //     $data[0][] = $item[7];

    //     $new_location = array_search($item[7], $new_attributes);

    //     $data[$key][45 + $new_location] = $item[8];
    // }
}
