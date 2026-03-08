@props(['book'])

<x-layout>
    <div class="max-w-6xl mx-auto p-6">

        {{-- header --}}
        <div class="flex flex-col sm:flex-row gap-6 mb-8">
            <div class="w-48 h-72 shadow">
                <img src="{{ $book->coverImage }}" class="w-full h-full rounded-xl object-cover">
            </div>
            <div class="flex-1">
                <h1 class="text-3xl font-bold">{{ $book->title }}</h1>
                <p class="text-sm text-text-muted mt-1">
                    {{ __('book.by') }}
                    @foreach($book->authors as $author)
                        <a href="{{ route('authors.show', $author) }}" class="text-sm text-text-muted mt-1 hover:underline">
                            {{ $author->display_name }}
                        </a>{{ !$loop->last ? ',' : '' }}
                    @endforeach
                </p>
                <p class="mt-4">{{ $book->description }}</p>
                <div class="flex flex-wrap gap-2 mt-2">
                    @foreach($book->categories as $category)
                        <a href="{{ route('categories.show', $category) }}">
                            <x-chip>{{ $category->name }}</x-chip>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- editions accordion --}}
        <div x-data="{ openEdition: {{ session('last_edition') ?? 'null' }} }" class="space-y-2">

            @foreach($book->publishedEditions as $edition)
                @php
                    $userReview = auth()->check()
                        ? $edition->reviews->firstWhere('user_id', auth()->id())
                        : null;
                @endphp
                <div class="border-b border-brand">
                    {{-- tab header --}}
                    <button 
                        @click="openEdition === {{ $edition->id }} ? openEdition = null : openEdition = {{ $edition->id }}"
                        class="w-full flex justify-between items-center px-4 py-3 transition duration-300 hover:bg-brand-hover/20 cursor-pointer"
                    >
                        <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-4">
                            <span class="font-semibold">{{ $edition->display_title }}</span>
                            <span class="text-sm text-text-muted">{{ $edition->published_at->format('M j, Y') }}</span>
                            <span class="text-sm text-text-muted text-uppercase">{{ $edition->language }}</span>
                            <span class="text-sm text-text-muted">{{ $edition->publishingHouse->name }}</span>  
                            <x-book-rating 
                                :rating="$edition->reviews_avg_rating ?? 0" 
                                :rating-count="$edition->reviews_count" 
                            />
                        </div>
                        <x-lucide-chevron-down 
                            ::class="{'rotate-180': openEdition === {{ $edition->id }}}"
                            class="w-5 h-5 transition-transform" 
                        />
                    </button>

                    <div x-show="openEdition === {{ $edition->id }}" x-cloak x-transition class="px-4 py-6 border-t border-brand">
                        
                        {{-- edition description --}}
                        @if($edition->edition_description)
                            <div class="mb-8">
                                <h4 class="text-xs font-bold uppercase tracking-widest text-text-muted mb-2">About this edition</h4>
                                <p class="text-sm text-text-main leading-relaxed italic border-l-4 border-brand/80 pl-4">
                                    {{ $edition->edition_description }}
                                </p>
                            </div>
                        @endif
 
                        {{-- formats --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($edition->formats as $format)
                                <div class="border border-brand shadow-sm dark:shadow-black/20 rounded-xl p-4 flex flex-col items-center text-center bg-bg-surface">
                                    <div class="w-32 h-48 rounded-xl shadow mb-2">
                                        <img src="{{ $format->cover_image }}" class="w-full h-full object-cover rounded-xl">
                                    </div>
                                    <h4 class="font-semibold">{{ ucfirst($format->format) }}</h4>
                                    @if($format->pages)
                                        <p class="text-sm">{{ trans_choice('book.pages', $format->pages, ['count' => $format->pages]) }}</p>
                                    @endif
                                    @if($format->stock !== null)
                                        <p class="text-sm text-text-muted">{{ $format->stock }} {{ __('book.in_stock') }}</p>
                                    @endif
                                    <p class="mt-1 font-bold text-brand-accent">
                                        @if($format->price > 0)
                                            ${{ number_format($format->price, 2) }}
                                        @else
                                            <span class="text-green-600 font-bold uppercase">{{ __('book.free') }}</span>
                                        @endif
                                    </p>
                                    <button class="mt-3 w-full py-2 bg-brand-hover text-white rounded-lg text-xs font-bold hover:bg-brand-accent transition">
                                        Buy / Download
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        
                        {{-- reviews section --}}
                        <div class="my-5 bg-bg-muted rounded-2xl p-6">
                            <div x-data="{ showForm: {{ old('rating') || $userReview ? 'true' : 'false' }}  }" class="mb-6">
                                <div class="flex items-center justify-between border-b border-border-soft pb-4 mb-4">
                                    <h3 class="text-lg font-bold">Reviews</h3>
                                    @auth
                                        <button @click="showForm = !showForm" class="text-sm font-bold text-brand-accent hover:underline cursor-pointer">
                                            <span x-text="showForm ? 'Close' : 'Add a Review'"></span>
                                        </button>
                                    @else
                                        <p class="text-xs text-text-muted italic">Login to review this edition</p>
                                    @endauth
                                </div>

                                {{-- review form --}}
                                @auth
                                    <div x-show="showForm" x-cloak x-transition class="mb-8 p-4 bg-bg-surface rounded-xl border border-brand shadow-sm">
                                        <form action="{{ route('edition-reviews.store', $edition) }}" method="POST">
                                            @csrf
                                            <div class="mb-4">
                                                <label class="block text-sm font-bold mb-2">Rating</label>
                                                <div x-data="{ hover: 0, rating: {{ old('rating', $userReview->rating ?? 0) }} }" class="flex gap-1 text-text-muted">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <label class="cursor-pointer">
                                                            <input type="radio" name="rating" value="{{ $i }}" class="hidden" x-model="rating" required>
                                                            <x-lucide-star 
                                                                class="w-6 h-6 transition-colors"
                                                                ::class="(hover >= {{ $i }} || rating >= {{ $i }}) ? 'fill-yellow-400 text-yellow-400' : ''"
                                                                @mouseenter="hover = {{ $i }}" @mouseleave="hover = 0" @click="rating = {{ $i }}"
                                                            />
                                                        </label>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <textarea 
                                                    name="review" 
                                                    rows="3" 
                                                    class="w-full rounded-lg border border-border-subtle text-sm focus:ring-1 focus:ring-brand focus:outline-none bg-bg-surface p-4" 
                                                    placeholder="Share your thoughts..."
                                                >{{ old('review', $userReview->review ?? '') }}</textarea>
                                            </div>
                                            <div class="flex justify-end">
                                                <x-forms.button>{{ $userReview ? 'Update Review' : 'Submit Review' }}</x-forms.button>
                                            </div>
                                        </form>
                                    </div>
                                @endauth

                                {{-- all reviews --}}
                                <div 
                                    x-data="reviewsComponent({{ $edition->id }})"
                                    x-init="loadReviews()"
                                    class="my-3 bg-bg-muted rounded-2xl p-2"
                                >
                                    <div x-show="loading" class="text-center py-4 text-sm text-text-muted">
                                        Loading reviews...
                                    </div>

                                    {{-- Reviews HTML --}}
                                    <div x-html="content"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>

<script>
    function reviewsComponent(editionId) {
        return {
            content: '',
            loading: false,

            async loadReviews(url=null) {
                this.loading = true;

                let endpoint = url ? url : `/editions/${editionId}/reviews`;

                let response = await fetch(endpoint, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });

                this.content = await response.text(); // html to string
                this.loading = false;

                this.bindLinks();
            },

            bindLinks() {
                this.$nextTick(() => { // only execute AFTER Alpine has made its reactive DOM updates
                    this.$el.querySelectorAll('a').forEach(link => {
                        if (link.href.includes('page=')) {
                            link.addEventListener('click', (e) => {
                                e.preventDefault();
                                this.loadReviews(link.href);
                            });
                        }
                    });
                });
            }
        }
    }
</script>