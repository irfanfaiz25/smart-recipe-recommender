<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Saran Baru Diterima</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .content {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
        }

        .field {
            margin-bottom: 15px;
        }

        .field-label {
            font-weight: bold;
            color: #495057;
        }

        .field-value {
            margin-top: 5px;
            padding: 8px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }

        .priority-high {
            color: #dc3545;
            font-weight: bold;
        }

        .priority-medium {
            color: #fd7e14;
            font-weight: bold;
        }

        .priority-low {
            color: #28a745;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>🔔 Saran Baru Diterima</h2>
        <p>Sebuah saran baru telah dikirim melalui form feedback website.</p>
    </div>

    <div class="content">
        <div class="field">
            <div class="field-label">Jenis Feedback:</div>
            <div class="field-value">{{ ucfirst($suggestion->feedback_type) }}</div>
        </div>

        <div class="field">
            <div class="field-label">Subjek:</div>
            <div class="field-value">{{ $suggestion->subject }}</div>
        </div>

        <div class="field">
            <div class="field-label">Prioritas:</div>
            <div class="field-value">
                <span class="priority-{{ $suggestion->priority }}">
                    {{ strtoupper($suggestion->priority) }}
                </span>
            </div>
        </div>

        <div class="field">
            <div class="field-label">Rating Kepuasan:</div>
            <div class="field-value">{{ $suggestion->rating }}/5 ⭐</div>
        </div>

        <div class="field">
            <div class="field-label">Area Spesifik:</div>
            <div class="field-value">{{ ucfirst($suggestion->specific_area) }}</div>
        </div>

        <div class="field">
            <div class="field-label">Pesan:</div>
            <div class="field-value">{{ $suggestion->feedback_message }}</div>
        </div>

        @if ($suggestion->additional_features)
            <div class="field">
                <div class="field-label">Fitur Tambahan yang Diinginkan:</div>
                <div class="field-value">{{ $suggestion->additional_features }}</div>
            </div>
        @endif

        <div class="field">
            <div class="field-label">Pengirim:</div>
            <div class="field-value">
                @if ($suggestion->name)
                    <strong>Nama:</strong> {{ $suggestion->name }}<br>
                @endif
                @if ($suggestion->email)
                    <strong>Email:</strong> {{ $suggestion->email }}<br>
                @endif
                @if ($suggestion->user_id)
                    <strong>User ID:</strong> {{ $suggestion->user_id }}
                @else
                    <em>Pengguna tidak login</em>
                @endif
            </div>
        </div>

        <div class="field">
            <div class="field-label">Detail Teknis:</div>
            <div class="field-value">
                <strong>IP Address:</strong> {{ $suggestion->ip_address }}<br>
                <strong>Waktu:</strong> {{ $suggestion->created_at->format('d/m/Y H:i:s') }}<br>
                <strong>Ease of Use:</strong> {{ $suggestion->ease_of_use }}/5<br>
                <strong>Performance:</strong> {{ $suggestion->performance }}/5<br>
                <strong>Design:</strong> {{ $suggestion->design }}/5<br>
                <strong>Would Recommend:</strong> {{ $suggestion->would_recommend ? 'Ya' : 'Tidak' }}
            </div>
        </div>
    </div>

    <div
        style="margin-top: 20px; padding: 15px; background-color: #e9ecef; border-radius: 8px; font-size: 12px; color: #6c757d;">
        <p>Email ini dikirim secara otomatis dari sistem feedback website. Silakan login ke admin panel untuk merespons
            saran ini.</p>
    </div>
</body>

</html>
