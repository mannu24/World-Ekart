<script type="text/javascript" src="{{ asset(mix('/js/manifest.js', 'themes/velocity/assets')) }}"></script>

<script type="text/javascript" src="{{ asset(mix('/js/velocity-core.js', 'themes/velocity/assets')) }}"></script>

<script type="text/javascript" src="{{ asset(mix('/js/components.js', 'themes/velocity/assets')) }}"></script>

<script type="text/javascript" src="{{ asset('vendor/webkul/ui/assets/js/ui.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/velocity/assets/js/jquery-ez-plus.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/js/bootstrap.min.js" integrity="sha512-8qmis31OQi6hIRgvkht0s6mCOittjMa9GMqtK9hes5iEQBQE/Ca6yGE5FsW36vyipGoWQswBj/QBm2JR086Rkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        $('body').on('click','ul.menu li a',function(e) {
            var ele = $(e)[0] ;
            var computedStyle = getComputedStyle(ele.target) ;
            var parent = ele.target.parentElement ;
            var li_s = $('ul.menu li') ;
            li_s.each((k,e) => {
                if(e!=parent)
                e.classList.remove('hover')
            });
            var padding = parseFloat(computedStyle.paddingRight) ;
            if (ele.offsetX > (ele.target.offsetWidth - padding)) {
                if(parent.classList.contains('has-mega-menu')) {
                    parent.classList.toggle('hover')
                    return false;
                }
            }
            return true ;
        });
    });
</script>

<script type="text/javascript">
    (() => {
        /* activate session messages */
        let message = @json($velocityHelper->getMessage());
        if (message.messageType && message.message !== '') {
            window.showAlert(message.messageType, message.messageLabel, message.message);
        }

        /* activate server error messages */
        window.serverErrors = [];
        @if (isset($errors))
            @if (count($errors))
                window.serverErrors = @json($errors->getMessages());
            @endif
        @endif

        /* add translations */
        window._translations = @json($velocityHelper->jsonTranslations());
    })();

    /**
     * Wishist form will dynamically create and execute.
     *
     * @param {!string} action
     * @param {!string} method
     * @param {!string} csrfToken
     */
    function submitWishlistForm(action, method, isConfirm, csrfToken) {
        if (isConfirm && ! confirm('{{ __('shop::app.checkout.cart.cart-remove-action') }}')) return;

        let form = document.createElement('form');
            form.method = 'POST';
            form.action = action;

        let _methodElement = document.createElement('input');
            _methodElement.type = 'hidden';
            _methodElement.name = '_method';
            _methodElement.value = method;
            form.appendChild(_methodElement);

        let _tokenElement = document.createElement('input');
            _tokenElement.type = 'hidden';
            _tokenElement.name ='_token';
            _tokenElement.value = csrfToken;
            form.appendChild(_tokenElement);

        document.body.appendChild(form);
        form.submit();
    }
</script>

@stack('scripts')

<script>
    {!! core()->getConfigData('general.content.custom_scripts.custom_javascript') !!}
</script>
