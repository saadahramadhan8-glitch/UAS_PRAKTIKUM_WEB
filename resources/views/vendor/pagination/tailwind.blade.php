@if ($paginator->hasPages())

    <nav
        role="navigation"
        aria-label="{{ __('Pagination Navigation') }}"
        class="flex items-center justify-center"
    >

        <div class="flex items-center gap-2 flex-wrap">

            {{-- PREVIOUS --}}
            @if ($paginator->onFirstPage())

                <span
                    class="px-4 py-2 rounded-xl bg-slate-100 text-slate-400 cursor-not-allowed"
                >
                    Sebelumnya
                </span>

            @else

                <a
                    href="{{ $paginator->previousPageUrl() }}"
                    class="px-4 py-2 rounded-xl border border-slate-200 text-slate-700 hover:bg-emerald-500 hover:text-white transition"
                >
                    Sebelumnya
                </a>

            @endif

            {{-- PAGE NUMBERS --}}
            @foreach ($elements as $element)

                {{-- DOTS --}}
                @if (is_string($element))

                    <span
                        class="px-3 py-2 text-slate-500"
                    >
                        {{ $element }}
                    </span>

                @endif

                {{-- ARRAY OF LINKS --}}
                @if (is_array($element))

                    @foreach ($element as $page => $url)

                        {{-- CURRENT PAGE --}}
                        @if ($page == $paginator->currentPage())

                            <span
                                class="px-4 py-2 rounded-xl bg-emerald-500 text-white shadow"
                            >
                                {{ $page }}
                            </span>

                        @else

                            <a
                                href="{{ $url }}"
                                class="px-4 py-2 rounded-xl border border-slate-200 text-slate-700 hover:bg-emerald-500 hover:text-white transition"
                            >
                                {{ $page }}
                            </a>

                        @endif

                    @endforeach

                @endif

            @endforeach

            {{-- NEXT --}}
            @if ($paginator->hasMorePages())

                <a
                    href="{{ $paginator->nextPageUrl() }}"
                    class="px-4 py-2 rounded-xl border border-slate-200 text-slate-700 hover:bg-emerald-500 hover:text-white transition"
                >
                    Selanjutnya
                </a>

            @else

                <span
                    class="px-4 py-2 rounded-xl bg-slate-100 text-slate-400 cursor-not-allowed"
                >
                    Selanjutnya
                </span>

            @endif

        </div>

    </nav>

@endif