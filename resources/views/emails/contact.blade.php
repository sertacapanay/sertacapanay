<!DOCTYPE html>
<html lang="tr">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
  body { font-family: -apple-system, sans-serif; background: #f5f5f0; margin: 0; padding: 32px 16px; }
  .card { background: #fff; max-width: 560px; margin: 0 auto; border-radius: 6px; overflow: hidden; border: 1px solid #e8e8e0; }
  .header { background: #1a1a1a; color: #fff; padding: 28px 32px; }
  .header h1 { margin: 0; font-size: 18px; font-weight: 600; letter-spacing: -0.3px; }
  .header p { margin: 6px 0 0; font-size: 13px; color: #888; }
  .body { padding: 28px 32px; }
  .field { margin-bottom: 20px; }
  .label { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #999; margin-bottom: 4px; }
  .value { font-size: 15px; color: #1a1a1a; line-height: 1.6; }
  .message-box { background: #f8f8f5; border-left: 3px solid #c9a96e; padding: 14px 16px; border-radius: 0 4px 4px 0; }
  .footer { border-top: 1px solid #f0f0ec; padding: 16px 32px; font-size: 12px; color: #bbb; }
</style>
</head>
<body>
  <div class="card">
    <div class="header">
      <h1>Yeni İletişim Mesajı</h1>
      <p>sertacapanay.net üzerinden gönderildi</p>
    </div>
    <div class="body">
      <div class="field">
        <div class="label">Gönderen</div>
        <div class="value">{{ $senderName }}</div>
      </div>
      <div class="field">
        <div class="label">E-posta</div>
        <div class="value"><a href="mailto:{{ $senderEmail }}" style="color:#c9a96e">{{ $senderEmail }}</a></div>
      </div>
      <div class="field">
        <div class="label">Mesaj</div>
        <div class="value message-box">{{ $message }}</div>
      </div>
    </div>
    <div class="footer">
      Bu e-posta sertacapanay.net iletişim formu tarafından otomatik olarak gönderilmiştir.
    </div>
  </div>
</body>
</html>
