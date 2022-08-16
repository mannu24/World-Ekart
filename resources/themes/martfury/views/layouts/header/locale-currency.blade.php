@php
    $searchQuery = request()->input();

    if ($searchQuery && ! empty($searchQuery)) {
        $searchQuery = implode('&', array_map(
            function ($v, $k) {
                if (is_array($v)) {
                    if (is_array($v)) {
                        $key = array_keys($v)[0];

                        return $k. "[$key]=" . implode('&' . $k . '[]=', $v);
                    } else {
                        return $k. '[]=' . implode('&' . $k . '[]=', $v);
                    }
                } else {
                    return $k . '=' . $v;
                }
            },
            $searchQuery,
            array_keys($searchQuery)
        ));
    } else {
        $searchQuery = false;
    }
    @endphp

    @if (core()->getCurrentChannel()->currencies->count() > 1)
        <li>
            <div class="dropdown">
                <select
                    class="bg-transparent border-0 text-uppercase"
                    onchange="window.location.href = this.value" aria-label="Locale">
                    @foreach (core()->getCurrentChannel()->currencies as $currency)
                        @if (isset($searchQuery) && $searchQuery)
                            <option value="?{{ $searchQuery }}&currency={{ $currency->code }}" {{ $currency->code == core()->getCurrentCurrencyCode() ? 'selected' : '' }}>{{ $currency->code }}</option>
                        @else
                            <option value="?currency={{ $currency->code }}" {{ $currency->code == core()->getCurrentCurrencyCode() ? 'selected' : '' }}>{{ $currency->code }}</option>
                        @endif
                    @endforeach

                </select>

                <div class="select-icon-container">
                    <span class="select-icon rango-arrow-down"></span>
                </div>
            </div>
        </li>
    @endif
    <li>
        <div class="dropdown">
            <div class="locale-icon">
                <img src="{{ core()->getCurrentLocale()->image_url }}" alt="" width="20" height="20" />
            </div>

            <select class="bg-transparent border-0" onchange="window.location.href = this.value" aria-label="Locale"
                @if (count(core()->getCurrentChannel()->locales) == 1)
                    disabled="disabled"
                @endif>

                @foreach (core()->getCurrentChannel()->locales()->orderBy('name')->get() as $locale)
                    @if (isset($searchQuery) && $searchQuery)
                        <option
                            value="?{{ $searchQuery }}&locale={{ $locale->code }}"
                            {{ $locale->code == app()->getLocale() ? 'selected' : '' }}>
                            {{ $locale->name }}
                        </option>
                    @else
                        <option value="?locale={{ $locale->code }}" {{ $locale->code == app()->getLocale() ? 'selected' : '' }}>{{ $locale->name }}</option>
                    @endif
                @endforeach
            </select>
            <div class="select-icon-container">
                <span class="select-icon rango-arrow-down"></span>
            </div>
        </div>
    </li>