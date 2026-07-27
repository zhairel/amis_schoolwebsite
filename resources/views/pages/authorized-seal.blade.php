<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Authorized AMIS Holographic Signature Seal — Tester</title>
    <style>
        :root { color-scheme: light; font-family: Inter, ui-sans-serif, system-ui, sans-serif; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; padding: 24px; color: #12332b; background: #f5f8f7; }
        main { width: min(100%, 760px); padding: 30px; border: 1px solid #d8e5e1; border-radius: 22px; background: rgba(255,255,255,.92); box-shadow: 0 18px 50px rgba(7,62,47,.09); text-align: center; }
        .tester { display: inline-block; margin-bottom: 12px; padding: 5px 10px; border-radius: 999px; color: #fff; background: #a16207; font-size: 11px; font-weight: 800; letter-spacing: .14em; }
        h1 { margin: 0; font-size: clamp(22px, 5vw, 32px); }
        .subtitle { margin: 9px auto 24px; max-width: 540px; color: #55706a; font-size: 14px; line-height: 1.55; }
        .seal-area { min-height: 270px; display: grid; place-items: center; border-radius: 18px; background-image: linear-gradient(45deg,#edf2f1 25%,transparent 25%),linear-gradient(-45deg,#edf2f1 25%,transparent 25%),linear-gradient(45deg,transparent 75%,#edf2f1 75%),linear-gradient(-45deg,transparent 75%,#edf2f1 75%); background-position: 0 0,0 8px,8px -8px,-8px 0; background-size: 16px 16px; overflow: hidden; }
        .seal { position: relative; width: min(52vw, 220px); aspect-ratio: 1; overflow: hidden; border-radius: 50%; isolation: isolate; opacity: .92; }
        .seal img { display: block; width: 100%; height: 100%; object-fit: contain; border-radius: 50%; }
        .seal::before { content: ""; position: absolute; inset: -45%; z-index: 2; pointer-events: none; background: linear-gradient(112deg,transparent 38%,rgba(90,255,224,.08) 43%,rgba(255,255,255,.42) 49%,rgba(200,140,255,.15) 54%,transparent 61%); transform: translateX(-48%) rotate(8deg); animation: light-sweep 6s ease-in-out infinite; mix-blend-mode: screen; }
        .seal::after { content: ""; position: absolute; inset: 0; z-index: 1; border-radius: 50%; pointer-events: none; background: conic-gradient(from 20deg,rgba(0,255,190,.08),rgba(90,120,255,.12),rgba(255,80,190,.09),rgba(255,215,70,.08),rgba(0,255,190,.08)); mix-blend-mode: color; animation: iridescence 10s linear infinite; }
        .notice { margin: 22px auto 0; padding: 12px 14px; border: 1px solid #f4d38b; border-radius: 12px; color: #754d05; background: #fffbeb; font-size: 12px; line-height: 1.5; text-align: left; }
        .authorization { margin-top: 22px; padding: 20px; border: 1px solid #cfe1dc; border-radius: 16px; background: #f8fbfa; text-align: left; }
        .authorization h2 { margin: 0 0 16px; color: #103c31; font-size: 16px; letter-spacing: .055em; text-align: center; }
        .record { display: grid; grid-template-columns: 150px 1fr; gap: 9px 15px; margin: 0; font-size: 13px; line-height: 1.45; }
        .record dt { color: #60766f; font-weight: 700; }
        .record dd { margin: 0; color: #173f35; font-weight: 750; }
        .verified { color: #08765c !important; }
        .confirmation { margin: 18px 0 0; padding-top: 16px; border-top: 1px solid #dbe8e4; color: #506a63; font-size: 13px; line-height: 1.55; }
        .url { margin-top: 16px; color: #20715e; font-size: 12px; font-weight: 700; }
        @keyframes light-sweep { 0%,18% { transform: translateX(-52%) rotate(8deg); } 70%,100% { transform: translateX(52%) rotate(8deg); } }
        @keyframes iridescence { to { transform: rotate(360deg); } }
        @media (prefers-reduced-motion: reduce) { .seal::before,.seal::after { animation: none; } }
        @media (max-width: 560px) { main { padding: 22px 16px; } .record { grid-template-columns: 1fr; gap: 2px; } .record dd { margin-bottom: 9px; } }
    </style>
</head>
<body>
<main>
    <span class="tester">TESTER</span>
    <h1>Authorized AMIS Holographic Signature Seal</h1>
    <p class="subtitle">Security-area preview with a slow holographic sweep, subtle iridescence, and print-safe proportions.</p>
    <section class="seal-area" aria-label="Transparent-background seal preview">
        <div class="seal" role="img" aria-label="Authorized AMIS holographic seal tester">
            <img src="{{ asset('images/authorized-amis-holographic-signature-seal.png') }}?v=2" alt="AMIS holographic seal preview">
        </div>
    </section>
    <section class="authorization" aria-labelledby="authorization-title">
        <h2 id="authorization-title">AUTHORIZED AMIS HOLOGRAPHIC SIGNATURE SEAL</h2>
        <dl class="record">
            <dt>Authorized Signatory</dt>
            <dd>CABEL BALAN NURHASAN, PhD<br>School Director</dd>
            <dt>Status</dt>
            <dd class="verified">Verified and Authorized</dd>
            <dt>Authorized Use</dt>
            <dd>Official AMIS Student Identification Cards Only</dd>
            <dt>Seal Reference No.</dt>
            <dd>AMIS-HSS-2026-001</dd>
            <dt>Effective Date</dt>
            <dd>July 2026</dd>
        </dl>
        <p class="confirmation">This holographic seal confirms that the signature displayed on authorized AMIS Student IDs was approved for official school use.</p>
    </section>
    <p class="notice"><strong>Tester asset only:</strong> this page does not claim a legally certified digital signature. Production use requires the original approved School Director signature source; it must not be redrawn or generated.</p>
    <div class="url">amis.edu.ph/authorized</div>
</main>
</body>
</html>
