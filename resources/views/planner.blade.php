@extends('layouts.app')

@section('title', 'AI Trip Planner — Travora')

@section('content')

<!-- Page Header -->
@include('components.page-header', [
    'subtitle' => 'AI-POWERED PLANNING',
    'title' => 'Build Your Perfect Trip',
    'description' => 'Tell us your preferences and our AI will craft a personalized itinerary tailored just for you.',
    'bgImage' => 'https://images.unsplash.com/photo-1502920917128-1aa500764cbd?q=80&w=2000&auto=format&fit=crop'
])

<!-- Planner Section -->
<section class="section-padding" id="plannerSection">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <div class="planner-wrapper glass-card rounded-4 p-4 p-md-5">
                    
                    <!-- Progress Bar -->
                    <div class="planner-progress mb-5">
                        <div class="progress-steps d-flex justify-content-between position-relative">
                            <div class="progress-line"></div>
                            <div class="progress-line-fill" id="progressFill"></div>
                            
                            <div class="progress-step active" data-step="1">
                                <div class="step-circle"><i class="fas fa-map-marker-alt"></i></div>
                                <p class="step-label">Destination</p>
                            </div>
                            <div class="progress-step" data-step="2">
                                <div class="step-circle"><i class="fas fa-calendar-alt"></i></div>
                                <p class="step-label">Dates</p>
                            </div>
                            <div class="progress-step" data-step="3">
                                <div class="step-circle"><i class="fas fa-wallet"></i></div>
                                <p class="step-label">Budget</p>
                            </div>
                            <div class="progress-step" data-step="4">
                                <div class="step-circle"><i class="fas fa-heart"></i></div>
                                <p class="step-label">Interests</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 1: Destination -->
                    <div class="planner-step active" data-step="1">
                        <h3 class="font-syne fw-bold mb-4">Where do you want to go?</h3>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="planner-label">Destination / Region</label>
                                <input type="text" class="form-control planner-input" placeholder="e.g. Japan, Europe, Anywhere..." id="destinationInput">
                            </div>
                            <div class="col-md-6">
                                <label class="planner-label">Travel Style</label>
                                <div class="travel-style-grid">
                                    @foreach($travelStyles as $style)
                                        <button type="button" class="style-chip" data-style="{{ $style['id'] }}">
                                            <i class="fas {{ $style['icon'] }}"></i>
                                            <span>{{ $style['label'] }}</span>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Dates -->
                    <div class="planner-step" data-step="2">
                        <h3 class="font-syne fw-bold mb-4">When are you traveling?</h3>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="planner-label">Start Date</label>
                                <input type="date" class="form-control planner-input" id="startDate">
                            </div>
                            <div class="col-md-6">
                                <label class="planner-label">End Date</label>
                                <input type="date" class="form-control planner-input" id="endDate">
                            </div>
                            <div class="col-12 mt-4">
                                <label class="planner-label">How many days?</label>
                                <div class="days-selector d-flex flex-wrap gap-2">
                                    @foreach([3, 5, 7, 10, 14, 21] as $day)
                                        <button type="button" class="day-chip" data-days="{{ $day }}">{{ $day }} Days</button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Budget -->
                    <div class="planner-step" data-step="3">
                        <h3 class="font-syne fw-bold mb-4">What's your budget?</h3>
                        <div class="budget-slider-wrapper">
                            <div class="budget-display text-center mb-4">
                                <span class="budget-currency">$</span>
                                <span class="budget-amount" id="budgetAmount">2000</span>
                                <span class="budget-label">USD per person</span>
                            </div>
                            <input type="range" 
                                   class="budget-slider" 
                                   min="500" 
                                   max="10000" 
                                   step="100" 
                                   value="2000" 
                                   id="budgetSlider">
                            <div class="d-flex justify-content-between mt-2 budget-range-labels">
                                <span>$500</span>
                                <span>$10,000+</span>
                            </div>
                            
                            <div class="budget-presets mt-4">
                                <button type="button" class="preset-chip" data-budget="800">Budget</button>
                                <button type="button" class="preset-chip active" data-budget="2000">Comfort</button>
                                <button type="button" class="preset-chip" data-budget="5000">Premium</button>
                                <button type="button" class="preset-chip" data-budget="8000">Luxury</button>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Interests -->
                    <div class="planner-step" data-step="4">
                        <h3 class="font-syne fw-bold mb-4">What interests you?</h3>
                        <p class="text-white-50 mb-4">Select as many as you like — we'll build your trip around them.</p>
                        <div class="interests-grid">
                            @foreach($interests as $interest)
                                <button type="button" class="interest-chip" data-interest="{{ $interest['id'] }}">
                                    <i class="fas {{ $interest['icon'] }}"></i>
                                    <span>{{ $interest['label'] }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="planner-nav d-flex justify-content-between mt-5 pt-4 border-top border-secondary">
                        <button type="button" class="btn travora-btn-outline" id="prevBtn" disabled>
                            <i class="fas fa-arrow-left me-2"></i> Previous
                        </button>
                        <button type="button" class="btn travora-btn-primary magnetic-btn" id="nextBtn">
                            Next <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<!-- ============ AI LOADING SECTION ============ -->
<section class="section-padding d-none" id="loadingSection">
    <div class="container">
        <div class="text-center">
            <div class="ai-loading-animation mx-auto mb-4">
                <div class="ai-pulse"></div>
                <i class="fas fa-wand-magic-sparkles"></i>
            </div>
            <h3 class="font-syne fw-bold mb-3">AI is crafting your journey...</h3>
            <p class="text-white-50 mb-0" id="loadingText">Analyzing your preferences</p>
        </div>
    </div>
</section>

<!-- ============ AI RESULT SECTION ============ -->
<section class="section-padding d-none" id="resultSection">
    <div class="container">
        
        <!-- Result Header -->
        <div class="text-center mb-5">
            <p class="travora-subtitle mb-2">YOUR PERSONALIZED TRIP</p>
            <h2 class="font-syne fw-bold display-5 mb-3">Here's Your AI-Crafted Journey</h2>
            <p class="text-white-50 mx-auto" style="max-width: 600px;">
                Powered by <span class="text-accent" id="aiSource">AI</span> — customized just for you
            </p>
        </div>

        <div class="row g-5">
            
            <!-- LEFT: Itinerary -->
            <div class="col-lg-8">
                <div class="itinerary-wrapper" id="itineraryWrapper">
                    <!-- Dynamically filled by JS -->
                </div>
            </div>

            <!-- RIGHT: Trip Summary -->
            <div class="col-lg-4">
                <div class="glass-card rounded-4 p-4 position-sticky" style="top: 100px;">
                    
                    <h4 class="font-syne fw-bold mb-4">Trip Summary</h4>
                    
                    <ul class="trip-summary mb-4">
                        <li><span>Destination:</span> <strong id="summaryDestination">—</strong></li>
                        <li><span>Duration:</span> <strong id="summaryDays">—</strong></li>
                        <li><span>Budget:</span> <strong id="summaryBudget">—</strong></li>
                        <li><span>Travel Style:</span> <strong id="summaryStyle">—</strong></li>
                        <li><span>Interests:</span> <strong id="summaryInterests">—</strong></li>
                    </ul>

                    <h5 class="font-syne fw-bold h6 mb-3">Cost Breakdown</h5>
                    <div class="cost-breakdown">
                        <div class="cost-item">
                            <span>Flights</span>
                            <strong id="costFlights">$0</strong>
                        </div>
                        <div class="cost-item">
                            <span>Accommodation</span>
                            <strong id="costStay">$0</strong>
                        </div>
                        <div class="cost-item">
                            <span>Food & Dining</span>
                            <strong id="costFood">$0</strong>
                        </div>
                        <div class="cost-item">
                            <span>Activities</span>
                            <strong id="costActivities">$0</strong>
                        </div>
                        <div class="cost-item total">
                            <span>Total</span>
                            <strong id="costTotal">$0</strong>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-grid gap-2 mt-4">
                        <button type="button" class="btn travora-btn-primary magnetic-btn" id="regenerateBtn">
                            <i class="fas fa-rotate me-2"></i> Regenerate
                        </button>
                        <button type="button" class="btn travora-btn-outline" id="resetPlannerBtn">
                            <i class="fas fa-redo me-2"></i> Start Over
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Pass route to JS
    window.travoraRoutes = window.travoraRoutes || {};
    window.travoraRoutes.plannerGenerate = "{{ route('planner.generate') }}";
</script>
@endpush