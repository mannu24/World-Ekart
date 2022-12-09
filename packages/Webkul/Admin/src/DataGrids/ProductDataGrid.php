<?php

namespace Webkul\Admin\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\Core\Models\Channel;
use Webkul\Core\Models\Locale;
use Webkul\Ui\DataGrid\DataGrid;

class ProductDataGrid extends DataGrid
{
    /**
     * Default sort order of datagrid.
     *
     * @var string
     */
    protected $sortOrder = 'desc';

    /**
     * Set index columns, ex: id.
     *
     * @var string
     */
    protected $index = 'product_id';

    /**
     * If paginated then value of pagination.
     *
     * @var int
     */
    protected $itemsPerPage = 10;
    protected $itemsPerOptions = [10,20,30,40,50,60];

    /**
     * Locale.
     *
     * @var string
     */
    protected $locale = 'all';

    /**
     * Channel.
     *
     * @var string
     */
    protected $channel = 'all';

    /**
     * Contains the keys for which extra filters to show.
     *
     * @var string[]
     */
    protected $extraFilters = [
        'channels',
        'locales',
        'user_id',
    ];

    /**
     * Create datagrid instance.
     *
     * @return void
     */
    public function __construct()
    {
        /* locale */
        $this->locale = core()->getRequestedLocaleCode();

        /* channel */
        $this->channel = core()->getRequestedChannelCode();

        /* parent constructor */
        parent::__construct();
    }

    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        if ($this->channel === 'all') {
            $whereInChannels = Channel::query()->pluck('code')->toArray();
        } else {
            $whereInChannels = [$this->channel];
        }

        if ($this->locale === 'all') {
            $whereInLocales = Locale::query()->pluck('code')->toArray();
        } else {
            $whereInLocales = [$this->locale];
        }

        /* query builder */
        if(auth()->guard('admin')->user()->role_id==1){

            $queryBuilder = DB::table('product_flat')
                ->leftJoin('products', 'product_flat.product_id', '=', 'products.id')
                ->leftJoin('attribute_families', 'products.attribute_family_id', '=', 'attribute_families.id')
                ->leftJoin('product_inventories', 'product_flat.product_id', '=', 'product_inventories.product_id')
                ->leftJoin('admins', 'products.user_id', '=', 'admins.id')
                ->where('product_flat.parent_id',null)
                ->select(
                    'product_flat.locale',
                    'product_flat.channel',
                    'admins.name as vendor_name',
                    'product_flat.product_id',
                    'products.sku as product_sku',
                    'product_flat.product_number',
                    'product_flat.name as product_name',
                    'products.type as product_type',
                    'product_flat.status',
                    'product_flat.price',
                    'attribute_families.name as attribute_family',
                    DB::raw('SUM(' . DB::getTablePrefix() . 'product_inventories.qty) as quantity')
                );
        }
        else{
            $queryBuilder = DB::table('product_flat')
                ->leftJoin('products', 'product_flat.product_id', '=', 'products.id')
                ->leftJoin('attribute_families', 'products.attribute_family_id', '=', 'attribute_families.id')
                ->leftJoin('product_inventories', 'product_flat.product_id', '=', 'product_inventories.product_id')
                ->where('product_flat.parent_id',null)
                ->select(
                    'product_flat.locale',
                    'product_flat.channel',
                    'product_flat.product_id',
                    'products.sku as product_sku',
                    'product_flat.product_number',
                    'product_flat.name as product_name',
                    'products.type as product_type',
                    'product_flat.status',
                    'product_flat.price',
                    'attribute_families.name as attribute_family',
                    DB::raw('SUM(' . DB::getTablePrefix() . 'product_inventories.qty) as quantity')
                )->where('products.user_id',auth()->guard('admin')->user()->id);
        }

        ///
        $queryBuilder->groupBy('product_flat.product_id', 'product_flat.locale', 'product_flat.channel');

        $queryBuilder->whereIn('product_flat.locale', $whereInLocales);
        $queryBuilder->whereIn('product_flat.channel', $whereInChannels);

        $this->addFilter('product_id', 'product_flat.product_id');
        $this->addFilter('product_name', 'product_flat.name');
        $this->addFilter('product_sku', 'products.sku');
        $this->addFilter('product_number', 'product_flat.product_number');
        $this->addFilter('status', 'product_flat.status');
        $this->addFilter('product_type', 'products.type');
        $this->addFilter('attribute_family', 'attribute_families.name');

        $this->setQueryBuilder($queryBuilder);
    }

    /**
     * Add columns.
     *
     * @return void
     */
    public function addColumns()
    {
        

        $this->addColumn([
            'index'      => 'product_id',
            'label'      => trans('admin::app.datagrid.id'),
            'type'       => 'number',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);
        if(auth()->guard('admin')->user()->role_id==1){
            $this->addColumn([
                'index'      => 'vendor_name',
                'label'      => 'Vendor',
                'type'       => 'string',
                'searchable' => false,
                'sortable'   => false,
                'filterable' => true,
            ]);
        }

        $this->addColumn([
            'index'      => 'product_sku',
            'label'      => trans('admin::app.datagrid.sku'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        // $this->addColumn([
        //     'index'      => 'product_number',
        //     'label'      => trans('admin::app.datagrid.product-number'),
        //     'type'       => 'string',
        //     'searchable' => true,
        //     'sortable'   => true,
        //     'filterable' => true,
        // ]);

        

        $this->addColumn([
            'index'      => 'product_name',
            'label'      => trans('admin::app.datagrid.name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'attribute_family',
            'label'      => trans('admin::app.datagrid.attribute-family'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'product_type',
            'label'      => trans('admin::app.datagrid.type'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => trans('admin::app.datagrid.status'),
            'type'       => 'boolean',
            'sortable'   => true,
            'searchable' => false,
            'filterable' => true,
            'closure'    => function ($value) {
                if ($value->status == 1) {
                    return trans('admin::app.datagrid.active');
                } else {
                    return trans('admin::app.datagrid.inactive');
                }
            },
        ]);

        // $this->addColumn([
        //     'index'      => 'price',
        //     'label'      => trans('admin::app.datagrid.price'),
        //     'type'       => 'price',
        //     'sortable'   => true,
        //     'searchable' => false,
        //     'filterable' => true,
        // ]);

        $this->addColumn([
            'index'      => 'quantity',
            'label'      => 'Total Qty.',
            'type'       => 'number',
            'sortable'   => true,
            'searchable' => false,
            'filterable' => false,
            'closure'    => function ($row) {
                if ($row->product_type =='simple') {
                    return $row->quantity;
                } else {
                    return $this->totat_quantity($row);
                }
            },
        ]);
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    public function prepareActions()
    {
        $this->addAction([
            'title'     => trans('admin::app.datagrid.edit'),
            'method'    => 'GET',
            'route'     => 'admin.catalog.products.edit',
            'icon'      => 'icon pencil-lg-icon',
            'condition' => function () {
                return true;
            },
        ]);

        $this->addAction([
            'title'        => trans('admin::app.datagrid.delete'),
            'method'       => 'POST',
            'route'        => 'admin.catalog.products.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'product']),
            'icon'         => 'icon trash-icon',
        ]);

        $this->addAction([
            'title'  => trans('admin::app.datagrid.copy'),
            'method' => 'GET',
            'route'  => 'admin.catalog.products.copy',
            'icon'   => 'icon copy-icon',
        ]);
    }

    /**
     * Prepare mass actions.
     *
     * @return void
     */
    public function prepareMassActions()
    {
        $this->addMassAction([
            'type'   => 'delete',
            'label'  => trans('admin::app.datagrid.delete'),
            'action' => route('admin.catalog.products.massdelete'),
            'method' => 'POST',
        ]);

        $this->addMassAction([
            'type'    => 'update',
            'label'   => trans('admin::app.datagrid.update-status'),
            'action'  => route('admin.catalog.products.massupdate'),
            'method'  => 'POST',
            'options' => [
                trans('admin::app.datagrid.active')    => 1,
                trans('admin::app.datagrid.inactive')  => 0,
            ],
        ]);
    }

    /**
     * Render quantity view.
     *
     * @param  object  $row
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    private function renderQuantityView($row)
    {
        $product = app(\Webkul\Product\Repositories\ProductRepository::class)->find($row->product_id);

        $inventorySources = app(\Webkul\Inventory\Repositories\InventorySourceRepository::class)->findWhere(['status' => 1]);

        $totalQuantity = $row->quantity;

        return view('admin::catalog.products.datagrid.quantity', compact('product', 'inventorySources', 'totalQuantity'))->render();
    }

    private function totat_quantity($row)
    {
        $v_ids = DB::table('products')->where('parent_id', $row->product_id)->pluck('id');

        $q = DB::table('product_inventories')->whereIn('product_id', $v_ids)->sum('qty');

        return $q;
    }
}
