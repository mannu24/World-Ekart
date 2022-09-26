<?php

namespace Webkul\Shop\Http\Controllers;

use Webkul\Shop\Http\Controllers\Controller;
use Webkul\Core\Repositories\SliderRepository;
use Webkul\Sales\Repositories\OrderItemRepository;
use Webkul\Product\Repositories\SearchRepository;
use DB;

class HomeController extends Controller
{
    /**
     * Slider repository instance.
     *
     * @var \Webkul\Core\Repositories\SliderRepository
     */
    protected $sliderRepository;


    protected $orderItemRepository;

    /**
     * Search repository instance.
     *
     * @var \Webkul\Core\Repositories\SearchRepository
     */
    protected $searchRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Core\Repositories\SliderRepository  $sliderRepository
     * @param  \Webkul\Product\Repositories\SearchRepository  $searchRepository
     * @return void
     */
    public function __construct(
        SliderRepository $sliderRepository,
        SearchRepository $searchRepository,
        OrderItemRepository $orderItemRepository,
    ) {
        $this->sliderRepository = $sliderRepository;

        $this->searchRepository = $searchRepository;

        $this->orderItemRepository = $orderItemRepository;
        parent::__construct();
    }

    /**
     * Loads the home page for the storefront.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sliderData = $this->sliderRepository->getActiveSliders();
        $cat_data =  $this->orderItemRepository->getModel()
            ->leftJoin('products', 'order_items.product_id', 'products.id')
            ->leftJoin('product_categories', 'products.id', 'product_categories.product_id')
            ->leftJoin('categories', 'product_categories.category_id', 'categories.id')
            ->leftJoin('category_translations', 'categories.id', 'category_translations.category_id')
            ->where('category_translations.locale', app()->getLocale())
            ->where('categories.parent_id', 1)
            ->addSelect('category_translations.slug','category_translations.name','categories.image as image_path')
            ->groupBy('categories.id')
            ->havingRaw('SUM(qty_invoiced - qty_refunded) > 0')
            ->limit(10)
            ->get();
        $category = [] ;
        foreach ($cat_data as $key => $value) {
            $category[] = ['slug'=>$value->slug,'name'=>$value->name,'image_path'=>$value->image_path,];
        }
        // dd($category);
        return view($this->_config['view'], compact('sliderData','category'));
    }

    /**
     * Loads the home page for the storefront if something wrong.
     *
     * @return \Exception
     */
    public function notFound()
    {
        abort(404);
    }

    /**
     * Upload image for product search with machine learning.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload()
    {
        return $this->searchRepository->uploadSearchImage(request()->all());
    }
}
