<?php

namespace Webkul\Admin\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\Ui\DataGrid\DataGrid;
use Illuminate\Support\Facades\Storage;

class PaymentEarningsDataGrid extends DataGrid
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

        $queryBuilder = DB::table('vendor_payment_request')->addSelect('id', 'amount_requested', 'created_at', 'status', 'amount_paid','paid_at','payment_via')->where('vendor_id',auth()->guard('admin')->user()->id) ;

        $this->addFilter('amount_requested', 'amount_requested');
        $this->addFilter('created_at', 'created_at');

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
            'index'      => 'amount_requested',
            'label'      => 'Amount Requested',
            'type'       => 'price',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);
        
        $this->addColumn([
            'index'      => 'created_at',
            'label'      => 'Requested At',
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => false,
            'wrapper'    => function($data) {
                return date( 'M d, y H:i' , strtotime($data->created_at)) ;
            },
        ]);

        $this->addColumn([
            'index'      => 'amount_paid',
            'label'      => 'Amount Paid',
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'payment_via',
            'label'      => 'Payment Mode',
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => false,
            'filterable' => false,
            'wrapper'    => function($data) {
                return $data->payment_via == null ? 'TBD' : $data->payment_via ;
            }
        ]);
        
        $this->addColumn([
            'index'      => 'paid_at',
            'label'      => 'Paid At',
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => false,
            'wrapper'    => function($data) {
                return !is_null($data->paid_at) ? date( 'M d, y H:i' , strtotime($data->created_at)) : 'TBD' ;
            },
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => 'Status',
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => false,
            'filterable' => false,
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
            'title'  => trans('admin::app.datagrid.view'),
            'method' => 'GET',
            'route'  => 'admin.payment-request.cancel',
            'icon'   => 'fas fa-ban fa-24x text-grey',
            'condition' => function($data) {
                return $data->status == 'Pending' ? true : false ;
            },
        ]);

        $this->addAction([
            'title'  => trans('admin::app.datagrid.delete'),
            'method' => 'POST',
            'route'  => 'admin.payment-request.delete',
            'icon'   => 'icon trash-icon',
            'condition' => function($data) {
                return $data->status != 'Approved' ? true : false ;
            },
        ]);
    }
}
