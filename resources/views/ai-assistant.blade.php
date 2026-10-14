@extends('layouts.app')

@section('title', 'AI Travel Concierge — Travora')

@section('content')

<section class="ai-assistant-section">
    <div class="container-fluid px-4 px-md-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">

                <!-- AI Header -->
                <div class="ai-header text-center mb-5">
                    <div class="ai-header-icon mx-auto mb-3">
                        <i class="fas fa-wand-magic-sparkles"></i>
                    </div>
                    <p class="travora-subtitle mb-2">YOUR PERSONAL TRAVEL CONCIERGE</p>
                    <h1 class="font-syne fw-bold display-4 mb-3">Travora AI</h1>
                    <p class="text-white-50 mx-auto" style="max-width: 600px;">
                        Tell me where you want to go. I'll handle the rest.
                    </p>
                </div>

                <!-- Quick Actions -->
                @if(count($conversations) === 0)
                <div class="ai-quick-actions mb-5">
                    <div class="row g-3">
                        <div class="col-md-6 col-lg-3">
                            <button class="ai-quick-btn" data-prompt="Plan my trip">
                                <i class="fas fa-plane"></i>
                                <span>Plan my trip</span>
                            </button>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <button class="ai-quick-btn" data-prompt="Budget my journey">
                                <i class="fas fa-dollar-sign"></i>
                                <span>Budget my journey</span>
                            </button>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <button class="ai-quick-btn" data-prompt="Where should I go?">
                                <i class="fas fa-globe"></i>
                                <span>Where should I go?</span>
                            </button>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <button class="ai-quick-btn" data-prompt="Packing list">
                                <i class="fas fa-suitcase"></i>
                                <span>Packing list</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Chat Container -->
                <div class="ai-chat-container glass-card rounded-4 overflow-hidden">

                    <!-- Chat Messages -->
                    <div class="ai-chat-messages" id="aiChatMessages">
                        @if(count($conversations) > 0)
                            @foreach($conversations as $conv)
                                <!-- User message -->
                                <div class="ai-message ai-message-user">
                                    <div class="ai-message-bubble">{{ $conv->user_message }}</div>
                                </div>
                                <!-- AI response -->
                                <div class="ai-message ai-message-bot">
                                    <div class="ai-message-avatar"><i class="fas fa-wand-magic-sparkles"></i></div>
                                    <div class="ai-message-bubble">{!! nl2br(e($conv->ai_response)) !!}</div>
                                </div>
                            @endforeach
                        @else
                            <!-- Welcome message -->
                            <div class="ai-message ai-message-bot">
                                <div class="ai-message-avatar"><i class="fas fa-wand-magic-sparkles"></i></div>
                                <div class="ai-message-bubble">
                                    Hello! 👋 I'm <strong>Travora AI</strong>, your personal travel concierge.<br><br>
                                    Ask me anything about travel — destinations, budgets, itineraries, packing lists, and more. Try one of the quick actions above, or just start typing!
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Typing Indicator -->
                    <div class="ai-typing d-none" id="aiTyping">
                        <div class="ai-message-avatar"><i class="fas fa-wand-magic-sparkles"></i></div>
                        <div class="ai-typing-dots">
                            <span></span><span></span><span></span>
                        </div>
                    </div>

                    <!-- Input -->
                    <div class="ai-chat-input-wrap">
                        <form id="aiChatForm" class="ai-chat-form">
                            @csrf
                            <input type="text"
                                   class="ai-chat-input"
                                   id="aiChatInput"
                                   placeholder="Ask Travora anything..."
                                   autocomplete="off"
                                   required>
                            <button type="submit" class="ai-chat-send">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>

                </div>

                <!-- Disclaimer -->
                <p class="text-center text-white-50 small mt-3 mb-0">
                    <i class="fas fa-info-circle me-1"></i>
                    Travora AI uses local travel knowledge. For full AI itineraries, visit the
                    <a href="{{ route('planner') }}" class="text-accent text-decoration-none">Trip Planner</a>.
                </p>

            </div>
        </div>
    </div>
</section>

@endsection