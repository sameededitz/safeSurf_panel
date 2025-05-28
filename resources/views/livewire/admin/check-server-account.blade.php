<div>
    {{-- @dd($config) --}}
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="mb-0">VPN Server:{{ $vpsAccount->name }}</h3>
        </div>
        <div class="card-body">
            {{-- <p><strong>Image:</strong> {{ json_decode($config)->type ?? '' }}</p>
            @if (isset(json_decode($config)->config->qr_code))
                <div>
                    <strong>QR Code:</strong><br>
                    <img src="data:image/png;base64,{{ json_decode($config)->config->qr_code }}" alt="QR Code" style="max-width:200px;">
                </div>
            @endif --}}
            <h5><strong>Name:</strong>{{ $vpsAccount->name }} </h5>
            <h5><strong>IP:</strong> {{ $vpsAccount->vpsserver->ip_address }} </h5>
            <h5>Config Data:</h5>
                @if ($vpsAccount->type === 'wireguard')
                <pre>{{ $config['config'] }}</pre>
                @else
                <pre>{{ $config }}</pre>
                    
                @endif
            <p></p>
        </div>
    </div>
</div>
