<?php

namespace Webkul\Admin\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\Ui\DataGrid\DataGrid;
use Illuminate\Support\Facades\Storage;

class ShopifyFileUpload extends DataGrid
{
    /**
     * Index.
     *
     * @var string
     */
    protected $index = 'id';

    /**
     * Sort order.
     *
     * @var string
     */
    protected $sortOrder = 'desc';

    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {

        $queryBuilder = DB::table('shopify_file_csv as a')->leftJoin('admins as b','b.id','a.vendor_id')
        ->addSelect('a.id', 'a.file_name', 'a.file_name as download', 'a.created_at')->where('a.vendor_id',auth()->guard('admin')->user()->id) ;

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
            'index'      => 'id',
            'label'      => trans('admin::app.datagrid.id'),
            'type'       => 'number',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => false,
        ]);

        $this->addColumn([
            'index'      => 'file_name',
            'label'      => 'Fle Name',
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);
        
        $this->addColumn([
            'index'      => 'created_at',
            'label'      => 'Created At',
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => false,
            'wrapper'    => function($data) {
                return date( 'M d, y H:i' , strtotime($data->created_at)) ;
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
            'title'  => 'Download File',
            'method' => 'GET',
            'route'  => 'admin.catalog.shopify.download',
            'icon'   => 'fas fa-file-download fa-24x text-grey',
        ]);
        $this->addAction([
            'title'  => trans('admin::app.datagrid.delete'),
            'method' => 'POST',
            'route'  => 'admin.catalog.shopify.delete',
            'icon'   => 'icon trash-icon',
        ]);
    }

}
