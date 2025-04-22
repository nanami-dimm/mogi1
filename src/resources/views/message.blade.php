@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/message.css')}}">
@endsection


@section('content')
<div class="message">
    <div class="other-transection">
        <label class="other">その他の取引</label>
        @if ($status === 'trading')
            @foreach ($transactions as $transaction)
                @if ($transaction->item)
                <div class="product-sell-content">
                    <a href="/item/{{ $transaction->item->id }}" class="product-link"></a>
                    <div class="product-detail">
                    <p>{{ $transaction->item->product_name }}</p>
                    </div>
                </div>
                @endif
            @endforeach
        @endif
    </div>
    <div class="transaction-main">
        <div class="transaction-username">
            @php
            $isSeller = $transaction->seller_id === auth()->id();
            $partner = $isSeller ? $transaction->buyer : $transaction->seller;
            @endphp

        @if ($partner)
            <div class="partner-info">
                <img src="{{ asset('storage/' . $partner->profile_image) }}" alt="アイコン" class="icon" width="50" height="50">
                <span>{{ $partner->name }}さんとの取引画面</span>
            </div>
        @endif
        </div>
        <div class="complete">
            <script>
                function openRatingModal() {
                    document.getElementById('ratingModal').classList.remove('hidden');
                }

                function closeRatingModal() {
                    document.getElementById('ratingModal').classList.add('hidden');
                }
            </script>
            <button type="button" class="btn btn-success" onclick="openRatingModal()">取引完了</button>
            <div id="ratingModal" class="rating-modal hidden">
                <div class="rating-content">
                    <h4>取引が完了しました。</h4>
                    <p class="thank">今回の取引相手はどうでしたか?</p>
                    <form action="{{ route('transaction.complete', $transaction->id) }}" method="POST">
                        @csrf
                        <div class="stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <label>
                                    <input type="radio" name="rating" value="{{ $i }}" required>
                                    ⭐
                                </label>
                            @endfor
                        </div>
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
                    <div class="{{ $msg->user_id === auth()->id() ? 'text-right' : 'text-left' }}">
                        <strong>{{ $msg->user->name }}</strong><br>
                        <span>{{ $msg->content }}</span><br>
                        <small>{{ $msg->created_at->format('H:i') }}
                            @if ($msg->user_id === auth()->id())
                                @if ($msg->is_read)
                                    <span style="color: green;">既読</span>
                                @else
                                    <span style="color: gray;">未読</span>
                                @endif
                            @endif
                        </small>
                        <hr>
                    </div>
                @endforeach
            </div>

            <form id="message-form" method="post">
                @csrf
                <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                <p class="error-message">
                    @error('content')
                    {{ $message }}
                    @enderror
                </p>
                <textarea name="content" id="message-input" class="form-control" placeholder="メッセージを入力" rows="2">{{ old('content', session('form_input.content')) }}</textarea>
                <label>
                    <input type="file" name="image" accept="image/*" class="form-control mt-2" style="display:none;">画像を選択
                </label>
                <p class="error-message">
                    @error('image')
                    {{ $message }}
                    @enderror
                </p>
                <button type="submit" class="btn btn-primary mt-2">送信</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
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

    const messageInput = document.getElementById('message-input');
    if (messageInput) {
        messageInput.addEventListener('input', function () {
            const content = this.value;

            fetch('/messages/save-draft', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('[name=_token]').value
                },
                body: JSON.stringify({ content: content })
            });
        });
    }
</script>
@endsection