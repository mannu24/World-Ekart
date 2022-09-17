<?php

namespace Webkul\Admin\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Product\Repositories\ProductInventoryRepository;
use Webkul\Sales\Repositories\InvoiceRepository;
use Webkul\Sales\Repositories\OrderItemRepository;
use Webkul\Sales\Repositories\OrderRepository;

class AnalyticsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @var array
     */
    protected $_config;

    /**
     * Order repository instance.
     *
     * @var \Webkul\Sales\Repositories\OrderRepository
     */
    protected $orderRepository;

    /**
     * Order item repository instance.
     *
     * @var \Webkul\Sales\Repositories\OrderItemRepository
     */
    protected $orderItemRepository;

    /**
     * Invoice repository instance.
     *
     * @var \Webkul\Sales\Repositories\InvoiceRepository
     */
    protected $invoiceRepository;

    /**
     * Customer repository instance.
     *
     * @var \Webkul\Customer\Repositories\CustomerRepository
     */
    protected $customerRepository;

    /**
     * Product inventory repository instance.
     *
     * @var \Webkul\Product\Repositories\ProductInventoryRepository
     */
    protected $productInventoryRepository;

    /**
     * Start date.
     *
     * @var \Illuminate\Support\Carbon
     */
    protected $startDate;

    /**
     * Last start date.
     *
     * @var \Illuminate\Support\Carbon
     */
    protected $lastStartDate;

    /**
     * End date.
     *
     * @var \Illuminate\Support\Carbon
     */
    protected $endDate;

    /**
     * Last end date.
     *
     * @var \Illuminate\Support\Carbon
     */
    protected $lastEndDate;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Sales\Repositories\OrderRepository  $orderRepository
     * @param  \Webkul\Sales\Repositories\OrderItemRepository  $orderItemRepository
     * @param  \Webkul\Customer\Repositories\CustomerRepository  $customerRepository
     * @param  \Webkul\Product\Repositories\ProductInventoryRepository  $productInventoryRepository
     * @return void
     */
    public function __construct(
        OrderRepository $orderRepository,
        OrderItemRepository $orderItemRepository,
        InvoiceRepository $invoiceRepository,
        CustomerRepository $customerRepository,
        ProductInventoryRepository $productInventoryRepository
    ) {
        $this->_config = request('_config');

        $this->middleware('admin');

        $this->orderRepository = $orderRepository;

        $this->orderItemRepository = $orderItemRepository;

        $this->invoiceRepository = $invoiceRepository;

        $this->customerRepository = $customerRepository;

        $this->productInventoryRepository = $productInventoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->setStartEndDate();

        $statistics = [
            'total_sales'          => $this->total_sales(),
            'month_sales'          => $this->total_sales(date('m')),
            'total_commissions'    => ($this->total_sales() * 5)/100,
            'month_commissions'    => ($this->total_sales(date('m')) * 5)/100,
            'top_vendors'          => $this->getTopVendors(),
        ];

        foreach (core()->getTimeInterval($this->startDate, $this->endDate) as $interval) {
            $statistics['sale_graph']['label'][] = $interval['start']->format('d M');

            $total = $this->getOrdersBetweenDate($interval['start'], $interval['end'])->sum('base_grand_total_invoiced') - $this->getOrdersBetweenDate($interval['start'], $interval['end'])->sum('base_grand_total_refunded');

            $statistics['sale_graph']['total'][] = ($total *5)/100;
            $statistics['sale_graph']['formated_total'][] = core()->formatBasePrice(($total *5)/100);
        }

        return view($this->_config['view'], compact('statistics'))->with(['startDate' => $this->startDate, 'endDate' => $this->endDate]);
    }

    private function total_sales($m = null) {
        if($m)
        return $this->currentOrders($m)->sum('base_grand_total_invoiced') - $this->currentOrders($m)->sum('base_grand_total_refunded') ;
        else
        return $this->currentOrders()->sum('base_grand_total_invoiced') - $this->currentOrders()->sum('base_grand_total_refunded') ;
    }

    private function currentOrders($month = null) {
        $o_ids = DB::table('orders')->pluck('id');
        if($month) {
            return $this->orderRepository->whereIn('orders.id',$o_ids)->whereMonth('created_at','=',$month);
        }
        else {
            return $this->orderRepository->whereIn('orders.id',$o_ids);
        }
    }

    public function setStartEndDate(){

        $this->startDate = request()->get('start')
            ? Carbon::createFromTimeString(request()->get('start') . " 00:00:01")
            : Carbon::createFromTimeString(Carbon::now()->subDays(30)->format('Y-m-d') . " 00:00:01");

        $this->endDate = request()->get('end')
            ? Carbon::createFromTimeString(request()->get('end') . " 23:59:59")
            : Carbon::now();

        if ($this->endDate > Carbon::now()) {
            $this->endDate = Carbon::now();
        }

        $this->lastStartDate = clone $this->startDate;
        $this->lastEndDate = clone $this->startDate;

        $this->lastStartDate->subDays($this->startDate->diffInDays($this->endDate));
    }

    public function getTopVendors() {

        return $this->orderRepository->getModel()
            ->join('admins', 'admins.id', 'orders.user_id')
            ->where('orders.created_at', '>=', $this->startDate)
            ->where('orders.created_at', '<=', $this->endDate)
            ->addSelect(DB::raw('COUNT(orders.id) as total_orders'))
            ->addSelect('orders.id', 'admins.id as vendor_id', 'admins.name')
            ->orderBy('total_orders', 'DESC')
            ->limit(5)
            ->get();
    }

    private function getOrdersBetweenDate($start, $end) {

        $o_ids = DB::table('orders')->pluck('id');
        return $this->orderRepository->scopeQuery(function ($query) use ($start, $end,$o_ids) {
            return $query->whereIn('orders.id',$o_ids)->where('orders.created_at', '>=', $start)->where('orders.created_at', '<=', $end);
        });
    }

}
