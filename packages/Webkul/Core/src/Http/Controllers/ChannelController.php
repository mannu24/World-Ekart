<?php

namespace Webkul\Core\Http\Controllers;

use Webkul\Admin\DataGrids\ChannelDataGrid ;
use Webkul\Core\Repositories\ChannelRepository ;
use Webkul\Velocity\Repositories\VelocityMetadataRepository ;
use Webkul\Velocity\Helpers\Helper ;
use Webkul\Velocity\Http\Controllers\Admin\ConfigurationController;

class ChannelController extends Controller
{
    /**
     * Contains route related configuration.
     *
     * @var array
     */
    protected $_config;

    /**
     * Channel repository instance.
     *
     * @var \Webkul\Core\Repositories\ChannelRepository
     */
    protected $velocityMetaDataRepository;
    protected $channelRepository;
    protected $velocityHelper;
    protected $configController;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Core\Repositories\ChannelRepository  $channelRepository
     * @return void
     */
    public function __construct(
        Helper $velocityHelper,
        ChannelRepository $channelRepository,
        ConfigurationController $configController,
        VelocityMetadataRepository $velocityMetadataRepository
    )
    {
        $this->channelRepository = $channelRepository;

        $this->_config = request('_config');

        $this->velocityHelper = $velocityHelper;

        $this->velocityMetaDataRepository = $velocityMetadataRepository;

        $this->configController = $configController ;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(ChannelDataGrid::class)->toJson();
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
        return view($this->_config['view']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = $this->validate(request(), [
            /* general */
            'code'              => ['required', 'unique:channels,code', new \Webkul\Core\Contracts\Validations\Code],
            'name'              => 'required',
            'description'       => 'nullable',
            'inventory_sources' => 'required|array|min:1',
            'root_category_id'  => 'required',
            'hostname'          => 'unique:channels,hostname',

            /* currencies and locales */
            'locales'           => 'required|array|min:1',
            'default_locale_id' => 'required|in_array:locales.*',
            'currencies'        => 'required|array|min:1',
            'base_currency_id'  => 'required|in_array:currencies.*',

            /* design */
            'theme'             => 'nullable',
            'home_page_content' => 'nullable',
            'footer_content'    => 'nullable',
            'logo.*'            => 'nullable|mimes:bmp,jpeg,jpg,png,webp',
            'favicon.*'         => 'nullable|mimes:bmp,jpeg,jpg,png,webp',

            /* seo */
            'seo_title'       => 'required|string',
            'seo_description' => 'required|string',
            'seo_keywords'    => 'required|string',

            /* maintenance mode */
            'is_maintenance_on'     => 'boolean',
            'maintenance_mode_text' => 'nullable',
            'allowed_ips'           => 'nullable',
        ]);

        $data = $this->setSEOContent($data);

        $this->channelRepository->create($data);

        session()->flash('success', trans('admin::app.settings.channels.create-success'));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {

        $locale = core()->checkRequestedLocaleCodeInRequestedChannel();

        $channel = core()->getRequestedChannelCode();

        $metaData = $this->velocityHelper->getVelocityMetaData($locale, $channel, false);
        
        $channel = $this->channelRepository->with(['locales', 'currencies'])->findOrFail($id);
        // return $channel;
        return view($this->_config['view'], compact('channel','metaData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $locale = core()->getRequestedLocaleCode();

        $data = $this->validate(request(), [
            /* general */
            'code'                   => ['required', 'unique:channels,code,' . $id, new \Webkul\Core\Contracts\Validations\Code],
            $locale . '.name'        => 'required',
            $locale . '.description' => 'nullable',
            'inventory_sources'      => 'required|array|min:1',
            'root_category_id'       => 'required',
            'hostname'               => 'unique:channels,hostname,' . $id,

            /* currencies and locales */
            'locales'           => 'required|array|min:1',
            'default_locale_id' => 'required|in_array:locales.*',
            'currencies'        => 'required|array|min:1',
            'base_currency_id'  => 'required|in_array:currencies.*',

            /* design */
            'theme'                        => 'nullable',
            $locale . '.home_page_content' => 'nullable',
            $locale . '.footer_content'    => 'nullable',
            $locale . '.site_name'         => 'nullable',
            $locale . '.email_address'     => 'nullable',
            $locale . '.phone_number'      => 'nullable',
            $locale . '.address'           => 'nullable',
            $locale . '.facebook_link'     => 'nullable',
            $locale . '.instagram_link'    => 'nullable',
            'logo.*'                       => 'nullable|mimes:bmp,jpeg,jpg,png,webp',
            'favicon.*'                    => 'nullable|mimes:bmp,jpeg,jpg,png,webp',

            /* seo */
            $locale . '.seo_title'       => 'nullable',
            $locale . '.seo_description' => 'nullable',
            $locale . '.seo_keywords'    => 'nullable',

            /* maintenance mode */
            'is_maintenance_on'                => 'boolean',
            $locale . '.maintenance_mode_text' => 'nullable',
            'allowed_ips'                      => 'nullable',

            'images'                           => 'array',
            'links'                           => 'array',
        ]);


        $velocityMetaData = $this->velocityMetaDataRepository->findOneWhere([ 'id' => 1 ]);

        $advertisement = json_decode($velocityMetaData->advertisement, true);

        $params['advertisement'] = [];

        if (isset($data['images'])) {
            foreach ($data['images'] as $index => $images) {
                $params['advertisement'][$index] =  $this->configController->uploadAdvertisementImages($images, $index, $advertisement);
            }

            if ($advertisement) {
                foreach ($advertisement as $key => $image_array) {
                    if (! isset($data['images'][$key])) {
                        foreach ($advertisement[$key] as $image) {
                            Storage::delete($image);
                        }
                    }
                }
            }
        }

        $params['advertisement'] = json_encode($params['advertisement']);
        $params['links'] = json_encode(($data['links'])) ;

        $this->velocityMetaDataRepository->update($params, $id);

        $data = $this->setSEOContent($data, $locale);

        $channel = $this->channelRepository->update($data, $id);

        if ($channel->base_currency->code !== session()->get('currency')) {
            session()->put('currency', $channel->base_currency->code);
        }

        session()->flash('success', trans('admin::app.settings.channels.update-success'));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $channel = $this->channelRepository->findOrFail($id);

        if ($channel->code == config('app.channel')) {
            return response()->json(['message' => trans('admin::app.settings.channels.last-delete-error')], 400);
        }

        try {
            $this->channelRepository->delete($id);

            return response()->json(['message' => trans('admin::app.settings.channels.delete-success')]);
        } catch (\Exception $e) {}

        return response()->json(['message' => trans('admin::app.response.delete-failed', ['name' => 'Channel'])], 400);
    }

    /**
     * Set the seo content and return back the updated array.
     *
     * @param  array  $data
     * @param  string  $locale
     * @return array
     */
    private function setSEOContent(array $data, $locale = null)
    {
        $editedData = $data;

        if ($locale) {
            $editedData = $data[$locale];
        }

        $editedData['home_seo']['meta_title'] = $editedData['seo_title'];
        $editedData['home_seo']['meta_description'] = $editedData['seo_description'];
        $editedData['home_seo']['meta_keywords'] = $editedData['seo_keywords'];
        $editedData['home_seo'] = json_encode($editedData['home_seo']);

        $editedData = $this->unsetKeys($editedData, ['seo_title', 'seo_description', 'seo_keywords']);

        if ($locale) {
            $data[$locale] = $editedData;
            $editedData = $data;
        }

        return $editedData;
    }

    /**
     * Unset keys.
     *
     * @param  array  $keys
     * @return array
     */
    private function unsetKeys($data, $keys)
    {
        foreach ($keys as $key) {
            unset($data[$key]);
        }

        return $data;
    }
}
