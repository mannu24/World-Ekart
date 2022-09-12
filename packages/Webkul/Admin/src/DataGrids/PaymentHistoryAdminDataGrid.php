<?php

namespace Webkul\Admin\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\Ui\DataGrid\DataGrid;
use Illuminate\Support\Facades\Storage;

class PaymentHistoryAdminDataGrid extends DataGrid
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
        $queryBuilder = DB::table('vendor_payment_request as a')->join('admins as b','a.vendor_id','b.id')
            ->where('a.status','Approved')->orderBy('a.paid_at','DESC')
            ->addSelect('a.id', 'a.amount_requested', 'a.created_at', 'b.name', 'a.status', 'a.amount_paid','a.paid_at','a.payment_via','a.transaction_no');

        $this->addFilter('a.amount_requested', 'a.amount_requested');
        $this->addFilter('a.created_at', 'a.created_at');

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
            'index'      => 'name',
            'label'      => 'Name',
            'type'       => 'string',
            'searchable' => true,
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
            'type'       => 'price',
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
            'index'      => 'transaction_no',
            'label'      => 'Transaction No',
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => false,
            'filterable' => false,
            'wrapper'    => function($data) {
                return '#'.$data->transaction_no ;
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
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    // public function prepareActions()
    // {
    //     $this->addAction([
    //         'title'  => 'Cancel Request',
    //         'method' => 'GET',
    //         'route'  => 'admin.payment-request.cancel',
    //         'icon'   => 'fas fa-ban fa-24x text-grey',
    //     ]);

    //     $this->addAction([
    //         'title'  => 'Edit Request',
    //         'method' => 'GET',
    //         'route'  => 'admin.payment-request.edit',
    //         'icon'   => 'icon pencil-lg-icon',
    //     ]);
    // }
}
