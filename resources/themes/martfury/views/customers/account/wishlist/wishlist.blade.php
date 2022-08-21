@extends('shop::customers.account.index')

@section('page_title')
    {{ __('shop::app.customer.account.wishlist.page-title') }}
@endsection
@section('account-breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/">{{ __('shop::app.home.home-title') }}</a></li>
        <li>{{ __('shop::app.customer.account.wishlist.title') }}</li>
    </ul>
@endsection
@section('account-content')
    @inject ('reviewHelper', 'Webkul\Product\Helpers\Review')
    <div class="col-lg-9">
        <div class="ps-section--account-setting">
            <div class="ps-section__content">
                <figure class="ps-block--address">
                    <figcaption class="d-flex justify-content-between">
                        {{ __('shop::app.customer.account.wishlist.title') }}
                        @if (count($items))
                            <form id="remove-all-wishlist" action="{{ route('customer.wishlist.removeall') }}" method="post">
                                @method('delete') @csrf
                            </form>
                            <div>
                                @if ($isSharingEnabled)
                                    <a href="javascript:void(0);" class="btn btn-warning" onclick="window.showShareWishlistModal();">
                                        {{ __('shop::app.customer.account.wishlist.share') }}
                                    </a>
                                @endif
                                <a href="javascript:void(0);" class="btn btn-warning" onclick="window.deleteAllWishlist()">
                                    {{ __('shop::app.customer.account.wishlist.deleteall') }}
                                </a>
                            </div>
                        @endif
                    </figcaption>
                    <div class="ps-block__content">
                        @if ($items->count())
                            @foreach ($items as $item)
                                @include('shop::customers.account.wishlist.wishlist-product', [
                                    'item' => $item,
                                    'visibility' => $isSharingEnabled
                                ])
                            @endforeach
                            <div class="bottom-toolbar"> {{ $items->links()  }} </div>
                        @else
                            <div class="empty"> {{ __('customer::app.wishlist.empty') }} </div>
                        @endif
                    </div>
                </figure>
            </div>
        </div>
    </div>
    @if ($isSharingEnabled)
        <div id="shareWishlistModal" class="d-none">
            <modal id="shareWishlist" :is-open="modalIds.shareWishlist">
                <h3 slot="header"> {{ __('shop::app.customer.account.wishlist.share-wishlist') }} </h3>
                <i class="rango-close" data-dismiss="modal"></i>
                <div slot="body">
                    <form method="POST" action="{{ route('customer.wishlist.share') }}">
                        @csrf
                        <div class="form-group">
                            <label for="shared" class="required">{{ __('shop::app.customer.account.wishlist.wishlist-sharing') }}</label>
                            <select name="shared" class="form-control">
                                <option value="0" {{ $isWishlistShared ? '' : 'selected="selected"' }}>{{ __('shop::app.customer.account.wishlist.disable') }}</option>
                                <option value="1" {{ $isWishlistShared ? 'selected="selected"' : '' }}>{{ __('shop::app.customer.account.wishlist.enable') }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="required">{{ __('shop::app.customer.account.wishlist.visibility') }}</label>

                            <div class="mt-2">
                                @if ($isWishlistShared)
                                    <span class="badge badge-sm badge-success">{{ __('shop::app.customer.account.wishlist.public') }}</span>
                                @else
                                    <span class="badge badge-sm badge-danger">{{ __('shop::app.customer.account.wishlist.private') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="required">{{ __('shop::app.customer.account.wishlist.shared-link') }}</label>

                            <div class="border p-3 shadow">
                                @if ($isWishlistShared)
                                    <a style="word-break:break-all;" href="{{ $wishlistSharedLink ?? 'javascript:void(0);' }}" target="_blank">{{ $wishlistSharedLink }}</a>
                                @else
                                    <p>{{ __('shop::app.customer.account.wishlist.enable-wishlist-info') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit"  class="btn btn-lg btn-success pull-right">
                                {{ __('shop::app.customer.account.wishlist.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </modal>
        </div>
    @endif
@endsection

@push('scripts')
    @if ($isSharingEnabled)
        <script>
            /**
            * Show share wishlist modal.
            */
            function showShareWishlistModal() {
                document.getElementById('shareWishlistModal').classList.remove('d-none');

                window.app.showModal('shareWishlist');
            }
        </script>
    @endif

    <script>
        /**
         * Delete all wishlist.
         */
        function deleteAllWishlist() {
            if (confirm('{{ __('shop::app.customer.account.wishlist.confirm-delete-all') }}')) document.getElementById('remove-all-wishlist').submit();

            return;
        }
    </script>
@endpush