@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/message.css')}}">
@endsection
@section('link')
@endsection

@section('content')
<div class="message">
<div class="sidebar">
    <h3>その他の取引</h3>
    <ul>
        @foreach ($otherTransactions as $otherTransaction)
            @if ($otherTransaction->exhibition)
                <li class="product-sell-content">
                    <a href="/item/{{ $otherTransaction->id }}/message" class="product-link">
                        <div class="product-detail">
                            <p>{{ $otherTransaction->exhibition->product_name }}</p>
                        </div>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>
    
    <div class="transaction-main">
        <div class="transaction-username">
            @php
            $isSeller = $transaction->seller_id === auth()->id();
            $partner = $isSeller ? $transaction->buyer : $transaction->seller;
            @endphp

        @if ($partner)
        <div class="partner-and-complete">
            <div class="partner-info">
                <img src="{{ asset($partner->profile_image) }}" class="icon" style="width: 79px; height: 79px; border-radius: 50%; object-fit: cover;">
                
                <span>{{ $partner->name }}さんとの取引画面</span>
            </div>
        @endif
        
        <div class="complete">
            <script>
                function openRatingModal() {
                    document.getElementById('ratingModal').classList.remove('hidden');
                }

                function closeRatingModal() {
                    document.getElementById('ratingModal').classList.add('hidden');
                }
            </script>
            @php
                $isBuyer = auth()->id() === $transaction->buyer_id;
                $alreadyRated = $transaction->rating && $transaction->rating()->where('user_id', auth()->id())->get()->isNotEmpty();
                $buyerRated = $transaction->rating && $transaction->rating()->where('user_id', $transaction->buyer_id)->get()->isNotEmpty();
            @endphp

            @if (!$alreadyRated && ($isBuyer || $buyerRated))
                <button type="button" class="btn btn-success" onclick="openRatingModal()">取引を完了する</button>
            @endif
        </div>
            <div id="ratingModal" class="rating-modal hidden">
                <div class="rating-content">
                    <h4>取引が完了しました。</h4>
                    <p class="thank">今回の取引相手はどうでしたか?</p>
                    <form action="{{ route('transaction.complete', $transaction->id) }}" method="POST">
                        @csrf
                        <div id="rating-stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <label>
                                    <input type="radio" name="rating" value="{{ $i }}" required
                                    style="display: none;">

                                    <span class="star" data-value="{{ $i }}">☆</span>
                                </label>
                            @endfor
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                const stars = document.querySelectorAll('#rating-stars .star');

                                    stars.forEach(star => {
                                        star.addEventListener('click', () => {
                                            const rating = parseInt(star.dataset.value);

                                            stars.forEach((s, index) => {
                                            s.textContent = (index < rating) ? '⭐' : '☆';
                                            });

               
                                            stars.forEach(s => {
                                            const sValue = parseInt(s.getAttribute('data-value'));
                                            s.classList.toggle('selected', sValue <= rating);
                                            });

                
                                            const radio = document.querySelector(`input[name="rating"][value="${rating}"]`);
                                            if (radio) {
                                            radio.checked = true;}
                                        });
                                    });
                                });
                        </script>
                        <button type="submit" class="btn btn-primary mt-2">送信</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="transaction-item">
            @if ($transaction->exhibition)
            <div class="product-box">
                <img src="{{ asset('storage/' . $transaction->exhibition->product_image) }}" 
                     alt="商品画像" 
                     class="product-image" 
                     width="250" 
                     height="250">
                <div class="product-details">
                    <h3>{{ $transaction->exhibition->product_name }}</h3>
                    <p>価格: ¥{{ number_format((float)str_replace(',', '', $transaction->exhibition->product_price)) }}</p>
                </div>
            </div>
            @endif
        </div>
        <div class="transaction-message">
            <div class="chat-box" id="chat-box" style="height: 400px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px;">
                @foreach ($messages as $msg)
                     <div class="chat-message {{ $msg->user_id === auth()->id() ? 'own-message' : 'partner-message' }}">
                        <img 
                    src="{{ asset($msg->user->profile_image ?? 'storage/images/default.png') }}" 
                    alt="アイコン" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                        <strong>{{ $msg->user->name }}</strong><br>
                        <span id="message-content-{{ $msg->id }}">{{ $msg->content }}</span><br>
                        @if ($msg->image)
            <img src="{{ asset('storage/' . $msg->image) }}" alt="添付画像" style="max-width: 200px; margin-top: 5px;">
        @endif
                    @if ($msg->user_id === auth()->id())
                    <button onclick="editMessage({{ $msg->id }})">編集</button>
                    <button onclick="deleteMessage({{ $msg->id }})">削除</button>
                    @endif

                        <hr>
                    </div>
                @endforeach
            </div>

            <form id="message-form" method="post" enctype="multipart/form-data"  action="{{ route('message.post', ['transactionId' => $transaction->id]) }}">
                @csrf
                <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                <p class="error-message">
                    @error('content')
                    {{ $message }}
                    @enderror
                </p>
                <div class="message-input-row">
                    <textarea name="content" id="message-input" class="form-control" placeholder="取引メッセージを記入してください" rows="2">{{ old('content') }}</textarea>
                    <label class="image-label">
                        <input type="file" name="image" accept="image/*" class="form-control mt-2" style="display:none;">画像を追加
                    </label>
                    <p class="error-message">
                    @error('image')
                    {{ $message }}
                    @enderror
                    </p>
                    <button type="submit" class="image-submit-button">
                        <img src="{{ asset('img/inputbuttun.svg') }}" alt="送信" class="send-icon">
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/7.2.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>
<script>
    window.Pusher = Pusher;
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '{{ env('PUSHER_APP_KEY') }}',
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        forceTLS: true
    });
</script>
<script>
window.editMessage = function(messageId) {
    const currentContent = document.getElementById('message-content-' + messageId).innerText;
    const newContent = prompt("新しい内容を入力してください:", currentContent);

    if (newContent !== null) {
        fetch(`/messages/${messageId}/edit`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('[name=_token]').value
            },
            body: JSON.stringify({ content: newContent })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                document.getElementById('message-content-' + messageId).innerText = newContent;
            }
        });
    }
}

window.deleteMessage = function(messageId) {
    fetch(`/messages/${messageId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('[name=_token]').value
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'deleted') {
            document.getElementById('message-content-' + messageId).parentElement.remove();
        }
    });

}

    const transactionId = {{ $transaction->id }};
    const userId = {{ auth()->id() }};

    Echo.private('chat.' + transactionId)
        .listen('MessageSent', (e) => {
            const chat = document.querySelector('#chat-box');
            const message = document.createElement('div');
            message.className = e.user_id === userId ? 'text-right' : 'text-left';
            message.innerHTML = `<strong>${e.user_id === userId ? 'あなた' : '相手'}</strong><br><span>${e.content}</span><br><small>${e.created_at}</small><hr>`;
            chat.appendChild(message);
            chat.scrollTop = chat.scrollHeight;
        });

    document.getElementById('message-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('/messages/send', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('[name=_token]').value },
            body: formData
        }).then(res => res.json()).then(data => {
            document.getElementById('message-input').value = '';
        });
    });
    </script>
    <script>
    

    document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("message-input");
    const storageKey = "message_draft_{{ auth()->id() }}_{{ $transaction->id }}";

    
    const savedDraft = sessionStorage.getItem(storageKey);
    if (savedDraft !== null) {
        input.value = savedDraft;
    }

    
    input.addEventListener("input", () => {
        sessionStorage.setItem(storageKey, input.value);
    });

    
    input.form.addEventListener("submit", () => {
        sessionStorage.removeItem(storageKey);
    });
    });
</script>
@endsection