<div id="comments" class="mb-5">
    <h2>{{ __('Reviews') }}</h2>
    <div class="card">
        <div class="card-body">
            @auth
                <div class="add-rating-form mb-4" wire:ignore.self>
                    @if (!$hasRated && Auth::user()->hasPurchasedProduct($product->id))
                        <h4>{{ __('Add Your Rating') }}</h4>
                        <form wire:submit.prevent="submitRating">
                            <div class="rating-stars mb-3">
                                @for ($i = 5; $i >= 1; $i--)
                                    <label>
                                        <input type="radio" wire:model="newRating.rate" value="{{ $i }}"
                                            class="d-none">
                                        <i class="fa-solid fa-star text-2xl cursor-pointer
                {{ $newRating['rate'] >= $i ? 'text-warning' : 'text-gray-300' }}"
                                            wire:click="$set('newRating.rate', {{ $i }})"></i>
                                    </label>
                                @endfor
                                @error('newRating.rate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <textarea wire:model="newRating.comment" class="form-control" rows="3"
                                    placeholder="{{ __('Share your experience with this product...') }}"></textarea>
                                @error('newRating.comment')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                <span wire:loading.remove>{{ __('Submit Rating') }}</span>
                                <span wire:loading>{{ __('Submitting...') }}</span>
                            </button>
                        </form>
                    @endif
                </div>
            @else
                <div class="alert alert-info mb-4">
                    {{ __('Please login to rate this product.') }}
                    <a href="{{ route('login') }}" class="text-primary">{{ __('Login') }}</a>
                </div>
            @endauth

            <!-- Average Rating Display -->
            <div class="average-rating mb-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="average-rate-display bg-light p-3 rounded text-center">
                        <div class="display-4 fw-bold">{{ number_format($averageRating, 1) }}</div>
                        <div class="rate-holder mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <i
                                    class="fa-solid fa-star 
                                    {{ $averageRating >= $i
                                        ? 'text-warning'
                                        : ($averageRating > $i - 0.5
                                            ? 'text-warning opacity-50'
                                            : 'text-secondary') }}"></i>
                            @endfor
                        </div>
                        <div class="text-muted small">{{ $totalRatings }} {{ __('Ratings') }}</div>
                    </div>

                    <div class="rating-distribution flex-grow-1">
                        @for ($i = 5; $i >= 1; $i--)
                            <div class="rating-bar mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="text-nowrap">{{ $i }} <i
                                            class="fa-solid fa-star text-warning"></i></span>
                                    <div class="progress flex-grow-1" style="height: 10px;">
                                        <div class="progress-bar bg-warning" role="progressbar"
                                            style="width: {{ $totalRatings > 0 ? ($ratingDistribution[$i] / $totalRatings) * 100 : 0 }}%"
                                            aria-valuenow="{{ $totalRatings > 0 ? ($ratingDistribution[$i] / $totalRatings) * 100 : 0 }}"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="text-muted small">{{ $ratingDistribution[$i] }}</span>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Reviews List -->
            <div class="comment-count text-secondary fw-bold fs-6">
                {{ $totalRatings }} {{ __('Ratings') }}
            </div>

            <div class="comments-pr-holder mt-3">
                @forelse ($rates as $rate)
                    <div class="single-comment mb-3" wire:key="rate-{{ $rate->id }}">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="name d-flex align-items-center gap-2 mb-0">
                                    <img src="{{ $rate->user?->image ? display_file($rate->user?->image) : asset('front-asset/img/image-preview.webp') }}"
                                        alt="{{ $rate->user?->name }}" class="img-user rounded-circle"
                                        style="width: 40px; height: 40px;">
                                    <div>
                                        <div class="d-flex gap-3 align-items-center">
                                            <span>{{ $rate->user?->name }}</span>
                                            <span class="fs-12px">
                                                <i class="fa-solid fa-circle-check"></i>
                                                {{ __('Purchased, Rated') }}
                                            </span>
                                        </div>
                                        <div class="rate-holder">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="fa-solid fa-star fs-10px
                                                    {{ $rate->rate >= $i ? 'text-warning' : 'text-secondary' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 align-items-center">
                                    {{-- @if ($rate->status == 'pending' && $rate->user_id == auth()->user()?->id)
                                        <span class="badge bg-warning">{{ __('Waiting for approval') }}</span>
                                    @endif --}}
                                    <span class="time text-secondary">{{ $rate->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <p class="content mb-2">{{ $rate->comment }}</p>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning">
                        {{ __('There are no reviews yet.') }}
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('rating-submitted', () => {
                // Scroll to reviews section after submission
                const element = document.getElementById('comments');
                element.scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
@endpush
